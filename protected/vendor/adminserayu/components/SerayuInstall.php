<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SerayuInstall
 *
 * @author serayucms
 */
class SerayuInstall {
    private $pathKomponen;
    private $pathTheme;
    private $pathWidget;
    private $pathTmp;
    
    private $namaTmp;
    private $nama;
    private $config;
    
    public $error = array();
            
    function __construct() {
        $this->pathKomponen = Yii::getPathOfAlias('application.modules.komponen');
        $this->pathTheme = Yii::app()->themeManager->basePath;
        $this->pathWidget = Yii::getPathOfAlias("application.widget");
        $this->pathTmp = Yii::getPathOfAlias("webroot.tmp");
        $this->createDirTmp();
    }
    
    public function createDirTmp(){
        if(is_dir($this->pathTmp)){
            $this->delete_directory($this->pathTmp);
        }
        if(mkdir($this->pathTmp))
            return true;
        else
            $this->addError("zipFile","Tidak bisa membuat direktori tmp");
            return false;
    }
    
    public function addError($pesan){
        array_push($this->error, $pesan);
    }
    
    public function uploadFile($file){
        $this->namaTmp = $file->getName();
        $nama = explode(".", $this->namaTmp);
        $this->nama = $nama[0];
        return $file->saveAs($this->pathTmp.$this->namaTmp);
    }
    
    public function delete_directory($dirname) {
            if (is_dir($dirname))
              $dir_handle = opendir($dirname);
            if (!$dir_handle)
                 return false;
            while($file = readdir($dir_handle)) {
                  if ($file != "." && $file != "..") {
                       $isFile = $dirname."/".$file;
                       if (!is_dir($dirname."/".$file)){
                           unlink(str_replace('//', '/',$isFile));
                       } 
                       else{
                           $this->delete_directory($dirname.'/'.$file);
                       }
                  }
            }
            closedir($dir_handle);
            rmdir($dirname);
            return true;
    }
        
    public function zipExtract(){
        $zip = new ZipArchive;
        if($zip->open($this->pathTmp.$this->namaTmp) === TRUE){
            $zip->extractTo($this->pathTmp."/".$this->nama);
            $zip->close();
            return true;
        }else{
            $this->addError("zipFile","file ".$this->namaTmp." tidak bisa diextract");
            return false;
        }
    }


    public function installKomponen($file){
        if($this->uploadFile($file) && $this->zipExtract() && $this->checkKomponen() && $this->checkKelengkapanKomponen()){
            if($this->simpanKomponen()){
                if($this->checkTable()){
                    rename($this->pathTmp."/".$this->nama."/controllers/".ucfirst(strtolower($this->nama))."Controller.php", 
                        $this->pathKomponen."/controllers/".ucfirst(strtolower($this->nama))."Controller.php");
                    $this->copyDirectory($this->pathTmp."/".$this->nama."/views/".$this->nama,
                            $this->pathKomponen."/views/".$this->nama);
                    if(is_dir($this->pathTmp."/".$this->nama."/assets/".$this->nama)){
                        $this->copyDirectory($this->pathTmp."/".$this->nama."/assets/".$this->nama,
                            $this->pathKomponen."/assets/".$this->nama);
                    }
                    $this->delete_directory($this->pathTmp);
                }else{
                    $this->addError("zipFile","Komponen tidak bisa diinstall");
                    return false;
                }
            }else{
                $this->addError("zipFile","Komponen tidak bisa diinstall");
                return false;
            }
        }else{
            $this->addError("zipFile","Komponen tidak bisa diinstall");
            return false;
        }
    }
    
    public function checkTable(){
        $error = 0;
        if(array_key_exists("table",$this->config)){
            foreach ($this->config['table'] as $TModel => $table){
                if(!is_file($this->pathKomponen."/models/".ucfirst(strtolower($TModel)).".php") && 
                        is_file($this->pathTmp."/".$this->nama."/models/".ucfirst(strtolower($TModel)).".php") &&
                        is_file($this->pathTmp."/".$this->nama."/data/".ucfirst(strtolower($table)).".sql")
                        ){
                    DLDatabaseHelper::import($this->pathTmp."/".$this->nama."/data/".$table.".sql");
                    rename($this->pathTmp."/".$this->nama."/models/".$TModel.".php", $this->pathKomponen."/models/".$TModel.".php");
                }else{
                    $error = $error + 1;
                    $this->addError("zipFile","Tabel ".$TModel." Komponen tidak valid");
                    exit; 
                }
            }
            if($error == 0){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
    
    public function simpanKomponen(){
        $komponen['nama_komponen'] = $this->nama;
        $komponen['pembuat_komponen'] = array_key_exists("pembuat",$this->config) ? $this->config["pembuat"] : "Tidak di cantumkan" ;
        $komponen['keterangan_komponen'] = array_key_exists("keterangan",$this->config) ? $this->config["keterangan"] : "Tidak di cantumkan" ;
        $komponen['pengguna_komponen'] = array_key_exists("pengguna",$this->config) ? serialize($this->config["pengguna"]) : NULL ;
        $komponen['table_komponen'] = array_key_exists("table",$this->config) ? serialize($this->config["table"]) : NULL ;
        $model = new Komponen;
        $model->attributes = $komponen;
        return $model->save();
    }

    private function copyDirectory($sourceDir, $targetDir)
    {
      if (!file_exists($sourceDir)) return false;
      if (!is_dir($sourceDir)) return copy($sourceDir, $targetDir);
      if (!mkdir($targetDir)) return false;
      foreach (scandir($sourceDir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!self::copyDirectory($sourceDir.DIRECTORY_SEPARATOR.$item, $targetDir.DIRECTORY_SEPARATOR.$item)) return false;
      }
      return true;
    }
    
    public function checkKelengkapanKomponen(){
        if(is_file($this->pathTmp."/".$this->nama."/controllers/".ucfirst(strtolower($this->nama))."Controller.php") && is_dir($this->pathTmp."/".$this->nama."/views/".$this->nama) && is_file($this->pathTmp."/".$this->nama."/komponen.php") ){
            $this->config = include $this->pathTmp."/".$this->nama."/komponen.php";
            if(is_array($this->config)){
                if(array_key_exists("nama",$this->config)){
                    if($this->config["nama"] == $this->nama){
                        return true;
                    }else{
                        $this->addError("zipFile","Nama pada config tidak sama dengan nama file");
                        return false;
                    }
                }else{
                    $this->addError("zipFile","Nama Komponen pada config tidak ditemukan");
                    return false;
                }
            }else{
                $this->addError("zipFile","File config tidak valid");
                return false;
            }
        }else{
            $this->addError("zipFile","File komponen tidak lengkap");
            return false;
        }
    }
    
    public function checkKomponen(){
        if(Komponen::model()->count("nama_komponen = :nama", array(":nama"=>$this->nama)) == 0){
            return true;
        }else{
            $this->addError("zipFile","File sudah terinstall");
            return false;
        }
    }
    
    

}

?>
