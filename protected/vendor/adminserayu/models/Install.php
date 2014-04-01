<?php
/* name   : Install
*  author : serayucms.com
*  date   : 7 maret 2014 
*/
class Install extends CFormModel
{
        public $zipFile;
        public $type;
        public $HasilId;
        
        private $_zipFileTmpName;
        
        private $_dirTheme;
        private $_dirWidget;
        private $_dirAdminig;
        private $_dirModel;
        private $_dirController;
        private $_dirView;
        private $_dirTemp;
        
        private $pathKomponen;
        private $pathTheme;
        private $pathWidget;
        private $pathTmp;

        private $namaTmp;
        private $nama;
        private $config;
        private $id_theme;
        
        public function rules()
	{
		return array(
			array('zipFile', 'required'),
			array('zipFile', 'file','types'=>"zip"),
                        array('zipFile', 'safe'),
		);
	}
        
        public function attributeLabels()
	{
		return array(
			'zipFile'=>'Zip File Installer',
		);
	}
        
        
        public function init() {
            $this->pathKomponen = Yii::getPathOfAlias('application.modules.komponen');
            $this->pathTheme = Yii::app()->themeManager->basePath;
            $this->pathWidget = Yii::getPathOfAlias("application.widget");
            $this->pathTmp = Yii::getPathOfAlias("webroot.tmp");
            $this->createDirTmp(); 
        }
        
        public function getName() {
            return $this->nama;
        }
        
        /* createDirTmp() -> untuk membuat direktori sementara
         * return boolean
         */
        public function createDirTmp(){
            if(is_dir($this->pathTmp)){
                $this->delete_directory($this->pathTmp);
            }
            if(mkdir($this->pathTmp)){
                chmod($this->pathTmp, 0777);
                return true;
            }else{
                $this->addError("zipFile","Tidak bisa membuat direktori tmp");
                return false;
            }
        }
        
        /* uploadFile() -> untuk upload file zip ke direktori sementara
         * params $file -> zipFile
         * return boolean
         */
        public function uploadFile($file){
            $this->namaTmp = $file->getName();
            $nama = explode(".", $this->namaTmp);
            $this->nama = $nama[0];
            return $file->saveAs($this->pathTmp."/".$this->namaTmp);
        }
        
        /* delete_directory() -> untuk direktori beserta isinya
         * param $dirname -> direktori yang akan dihapus
         * return boolean
         */
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
        
        /* zipExtract() -> untuk ektrak file zip dari direktori sementara
         * return boolean
         */
        public function zipExtract(){
            $zip = new ZipArchive;
            if($zip->open($this->pathTmp."/".$this->namaTmp) === TRUE){
                $zip->extractTo($this->pathTmp."/".$this->nama);
                $zip->close();
                return true;
            }else{
                $this->addError("zipFile","file ".$this->namaTmp." tidak bisa diextract");
                return false;
            }
        }
        
        
        /* copyDirectory() -> untuk copy direcktori
         * params $sourceDir -> direktori awal
         * params $targetDir -> direktori tujuan
         * return boolean
         */
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

        /* 
         * ----------------------------Komponen-------------------------------------
         */
        
        /* installKomponen() -> untuk install komponen
         * params $file -> zipFile
         * return boolean
         */
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
                        return true;
                    }else{
                        $this->delete_directory($this->pathTmp);
                        $this->addError("zipFile","Komponen tidak bisa diinstall");
                        return false;
                    }
                }else{
                    $this->delete_directory($this->pathTmp);
                    $this->addError("zipFile","Komponen tidak bisa diinstall");
                    return false;
                }
            }else{
                $this->delete_directory($this->pathTmp);
                $this->addError("zipFile","Komponen tidak bisa diinstall");
                return false;
            }
            
        }
        
        /* uninstallKomponen() -> untuk Uninstall komponen
         * params $komponen -> Komponen (object)
         * return boolean
         */
        public function uninstallKomponen($komponen){
            unlink($this->pathKomponen."/controllers/".ucfirst(strtolower($komponen->nama_komponen))."Controller.php");
            $this->delete_directory($this->pathKomponen."/views/".strtolower($komponen->nama_komponen));
            if(is_dir($this->pathKomponen."/assets/".strtolower($komponen->nama_komponen))){
                $this->delete_directory($this->pathKomponen."/assets/".strtolower($komponen->nama_komponen));    
            }
            $table = unserialize($komponen->table_komponen);
            if(is_array($table)){
                foreach ($table as $Tmodel => $TTable){
                    unlink($this->pathKomponen."/models/".$Tmodel.".php");
                    Yii::app()->db->createCommand()->dropTable($TTable);
                }
            }
            $this->delete_directory($this->pathTmp);
            $komponen->delete();
        }

        /* checkTable() -> untuk cek pada file konfigurasi
         * return boolean
         */    
        public function checkTable(){
            $error = 0;
            if(array_key_exists("table",$this->config)){
                foreach ($this->config['table'] as $TModel => $table){
                    if(!is_file($this->pathKomponen."/models/".ucfirst(strtolower($TModel)).".php") && 
                            is_file($this->pathTmp."/".$this->nama."/models/".ucfirst(strtolower($TModel)).".php") &&
                            is_file($this->pathTmp."/".$this->nama."/data/".$table.".sql")
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

        /* simpanKomponen() -> untuk menyimpan ke tabel komponen
         * return boolean
         */   
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

        /* checkKelengkapanKomponen() -> untuk cek kelengkapan komponen
         * return boolean
         */ 
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

        /* checkKomponen() -> untuk cek komponen dari tabel komponen
         * return boolean
         */ 
        public function checkKomponen(){
            if(Komponen::model()->count("nama_komponen = :nama", array(":nama"=>$this->nama)) == 0){
                return true;
            }else{
                $this->addError("zipFile","Komponen ".$this->nama." sudah ada");
                return false;
            }
        }
        
        /* 
         * ----------------------------Instalasi Widget-------------------------------------
         */
        
        /* checkKomponen() -> untuk cek Widget dari tabel widget
         * return boolean
         */ 
        public function checkWidget(){
            if(Widget::model()->count("nama_widget = :nama", array(":nama"=>$this->nama)) == 0){
                return true;
            }else{
                $this->addError("zipFile","Widget ".$this->nama." sudah ada");
                return false;
            }
        }
        
        /* simpanWidget() -> untuk menyimpan ke tabel Widget
         * return boolean
         */  
        public function simpanWidget(){
            $Widget['nama_widget'] = $this->nama;
            $Widget['pembuat_widget'] = array_key_exists("pembuat",$this->config) ? $this->config["pembuat"] : "Tidak di cantumkan" ;
            $Widget['keterangan'] = array_key_exists("keterangan",$this->config) ? $this->config["keterangan"] : "Tidak di cantumkan" ;
            $model = new Widget;
            $model->attributes = $Widget;
            return $model->save();
        }
        
        /* checkKelengkapanWidget() -> untuk cek kelengkapan Widget
         * return boolean
         */ 
        public function checkKelengkapanWidget(){
            if(is_file($this->pathTmp."/".$this->nama."/".$this->nama.".php") && is_file($this->pathTmp."/".$this->nama."/widget.php") ){
                $this->config = include $this->pathTmp."/".$this->nama."/widget.php";
                if(is_array($this->config)){
                    if(array_key_exists("nama",$this->config)){
                        if($this->config["nama"] == $this->nama){
                            return true;
                        }else{
                            $this->addError("zipFile","Nama pada config tidak sama dengan nama file");
                            return false;
                        }
                    }else{
                        $this->addError("zipFile","Nama Widget pada config tidak ditemukan");
                        return false;
                    }
                }else{
                    $this->addError("zipFile","File config tidak valid");
                    return false;
                }
            }else{
                $this->addError("zipFile","File Widget tidak lengkap");
                return false;
            }
        }
        
        /* installWidget() -> untuk install Widget
         * params $file -> zipFile
         * return boolean
         */
        public function installWidget($file){
            if($this->uploadFile($file) && $this->zipExtract() && $this->checkWidget() && $this->checkKelengkapanWidget()){
                if($this->simpanWidget()){
                    $this->copyDirectory($this->pathTmp."/".$this->nama,
                                $this->pathWidget."/".$this->nama);
                    unlink($this->pathWidget."/".$this->nama."/widget.php");
                    $this->delete_directory($this->pathTmp);
                    return true;
                }else{
                    $this->delete_directory($this->pathTmp);
                    $this->addError("zipFile","Widget tidak bisa diinstall");
                    return false;
                }
            }else{
                $this->delete_directory($this->pathTmp);
                $this->addError("zipFile","Widget tidak bisa diinstall");
                return false;
            }
        }
        
        /* uninstallWidget() -> untuk Uninstall Widget
         * params $widget -> widget (object)
         * return boolean
         */
        public function uninstallWidget($widget){
            $this->delete_directory($this->pathWidget."/".$widget->nama_widget);
            $this->delete_directory($this->pathTmp);
            $widget->delete();
        }


        /* 
         * ----------------------------Instalasi Theme-------------------------------------
         */
        
        /* installWidget() -> untuk install Widget
         * params $file -> zipFile
         * return boolean
         */
        public function installTheme($file){
            if($this->uploadFile($file) && $this->zipExtract() && $this->checkTheme() && $this->checkKelengkapanTheme()){
                if($this->simpanTheme()){
                    if($this->simpanLayout()){
                        $this->copyDirectory($this->pathTmp."/".$this->nama,
                                $this->pathTheme."/".$this->nama);
                        unlink($this->pathTheme."/".$this->nama."/theme.php");
                        $this->delete_directory($this->pathTmp);
                        return true;
                    }
                }else{
                    $this->delete_directory($this->pathTmp);
                    $this->addError("zipFile","Theme tidak bisa diinstall");
                    return false;
                }
            }else{
                $this->delete_directory($this->pathTmp);
                $this->addError("zipFile","Theme tidak bisa diinstall");
                return false;
            }
        }
        
        public function checkTheme(){
            if(Theme::model()->count("nama_theme = :nama", array(":nama"=>$this->nama)) == 0){
                return true;
            }else{
                $this->addError("zipFile","Theme ".$this->nama." sudah ada");
                return false;
            }
        }
        
        public function simpanLayout(){
            if(array_key_exists("layout",$this->config)){
                foreach ($this->config['layout'] as $value) {
                    if(array_key_exists("name",$value) &&
                            array_key_exists("file",$value) &&
                            array_key_exists("tipe",$value) &&
                            array_key_exists("dir",$value)
                            ){
                        $layout["name"] = $value["name"];
                        $layout["file_name"] = $value["file"];
                        $layout["id_theme"] = $this->id_theme;
                        $layout["tipe"] = $value["tipe"];
                        $layout["folder"] = $value["dir"];
                        $model = new Layouts;
                        $model->attributes = $layout;
                        $hasil = $model->save();
                        if(array_key_exists("widgetPosisi",$value) && $hasil){
                            if(is_array($value['widgetPosisi'])){
                                foreach ($value['widgetPosisi'] as $data) {
                                    $wp['nama_wp'] = $data;
                                    $wp['id_layouts'] = $model->id;
                                    $wp['id_theme'] = $this->id_theme;
                                    $wpModel = new WidgetPosisi;
                                    $wpModel->attributes = $wp;
                                    $wpModel->save();
                                }
                            }
                        }
                    }else{
                        break; 
                        $this->addError("zipFile","Layout di theme tidak valid");
                        return false;
                    }
                }
                return true;
            }else{
                return true;
            }
        }
        
        public function simpanTheme(){
            $theme['nama_theme'] = $this->nama;
            $theme['pembuat_theme'] = array_key_exists("pembuat",$this->config) ? $this->config["pembuat"] : "Tidak di cantumkan" ;
            $theme['gambar_theme'] = array_key_exists("gambar",$this->config) ? $this->config["gambar"] : "gambar.png" ;
            $theme['keterangan_theme'] = array_key_exists("dokumentasi",$this->config) ? $this->config["dokumentasi"] : "Tidak di cantumkan" ;
            $theme['status_theme'] = "0";
            $model = new Theme;
            $model->attributes = $theme;
            $hasil = $model->save();
            $this->id_theme = $model->id_theme;
            return $hasil;
           
        }
        
        public function checkKelengkapanTheme(){
            if(is_file($this->pathTmp."/".$this->nama."/gambar.png") && 
                    is_file($this->pathTmp."/".$this->nama."/theme.php") &&  
                    is_dir($this->pathTmp."/".$this->nama."/views/layouts") &&  
                    is_file($this->pathTmp."/".$this->nama."/views/.htaccess")
                    ){
                $this->config = include $this->pathTmp."/".$this->nama."/theme.php";
                if(is_array($this->config)){
                    if(array_key_exists("nama",$this->config) &&
                            array_key_exists("pembuat",$this->config)
                            ){
                        if($this->config["nama"] == $this->nama){
                            return true;
                        }else{
                            $this->addError("zipFile","Nama pada config tidak sama dengan nama file");
                            return false;
                        }
                    }else{
                        $this->addError("zipFile","Nama Theme pada config tidak ditemukan");
                        return false;
                    }
                }else{
                    $this->addError("zipFile","File Theme tidak valid");
                    return false;
                }
            }else{
                $this->addError("zipFile","File Theme tidak lengkap");
                return false;
            }
        }
        
        public function uninstallTheme($theme){
            $this->delete_directory($this->pathTheme."/".$theme->nama_theme);
            $this->delete_directory($this->pathTmp);
            $theme->delete();
        }
        
        
        /*
        public function init() {
            $this->_dirAdminig = Yii::app()->getModule(Yii::app()->controller->module->id)->getBasePath();
            $this->_dirTheme = Yii::app()->themeManager->basePath;
            $this->_dirWidget = Yii::app()->basePath.'/components/'; 
        }
        
        public function uploadFile(){
            $this->_zipFileTmpName = $this->zipFile->getName();
            if(is_dir(Yii::app()->basePath.'/../tmp/')){
                $this->delete_directory(Yii::app()->basePath.'/../tmp/');
            }
            mkdir(Yii::app()->basePath.'/../tmp/');
            $this->_dirTemp = Yii::app()->basePath.'/../tmp/';
            $this->zipFile->saveAs($this->_dirTemp.$this->_zipFileTmpName);
            $this->prosesInstall();
        }
        
        public function cobaInstalllKomponen(){
            $komponen = new SerayuInstall();
            if(!$komponen->installKomponen($this->zipFile)){
                $this->addErrors($komponen->error);
            }else{
                return "berhasil";
            }
            ;
        }


        private function prosesInstall(){
            switch ($this->type) {
                case "theme":
                    $this->installTheme();
                    break;
                case "komponen":
                    $this->installKomponen();
                    break;
                case "widget":
                    $this->installWidget();
                    break;

                default:
                    $this->delete_directory($tmp);
                    break;
            }
        }


        private function delete_directory($dirname) {
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
       
       /*
        * ------------Instalasi Theme--------------------
        */
       /*
       public function unInstallTheme($theme){
           $this->delete_directory($this->_dirTheme."/".$theme->nama_theme);
           WidgetPosisi::model()->deleteAll("id_theme = '".$theme->id_theme."'");
           $theme->delete();
       }
       
       public function installTheme(){ 
            $tmp = $this->_dirTemp;
            $zip = new ZipArchive;
            if ($zip->open($tmp.$this->_zipFileTmpName) === TRUE) {
                $nama = explode(".", $this->_zipFileTmpName);
                if(is_dir($this->_dirTheme."/".$nama[0])){
                    $this->addError("zipFile", "Theme Telah Terinstall");
                }else{
                    mkdir($this->_dirTheme."/".$nama[0]);
                    $zip->extractTo($this->_dirTheme."/".$nama[0]);
                    if(is_file($this->_dirTheme."/".$nama[0]."/theme.php")){
                        $config = include $this->_dirTheme."/".$nama[0]."/theme.php";
                        if( !empty($config['gambar']) &&
                            !empty($config['pembuat']) &&
                            !empty($config['keterangan'])
                            ){
                            $theme['nama_theme'] = $nama[0];
                            $theme['pembuat_theme'] = $config['pembuat'];
                            $theme['gambar_theme'] = Yii::app()->baseUrl."/themes/".$nama[0]."/".$config['gambar'];
                            $theme['keterangan_theme'] = $config['keterangan'];
                            $theme['status_theme'] = "0";
                            $model = new Theme;
                            $model->attributes = $theme;
                            if($model->save()){
                                if(is_array($config['posisi'])){
                                    foreach ($config['posisi'] as $data){
                                        $posisi = new WidgetPosisi;
                                        $value['nama_wp'] = str_replace(" ", "-", strtolower($data));
                                        $value['id_theme'] = $model->primaryKey;
                                        $posisi->attributes = $value;
                                        $posisi->save();
                                    }
                                }
                                unlink($this->_dirTheme."/".$nama[0]."/theme.php");
                                $this->HasilId = $model->primaryKey;
                            }else{
                                $this->delete_directory($this->_dirTheme."/".$nama[0]);
                                $this->addError("zipFile", "Theme Tidak bisa diinstall, terjadi kesalahan dalam file config");
                            }
                        }else{
                            $this->delete_directory($this->_dirTheme."/".$nama[0]);
                            $this->addError("zipFile", "Theme Tidak bisa diinstall, file config error");
                        }
                    }else{
                        $this->delete_directory($this->_dirTheme."/".$nama[0]);
                        $this->addError("zipFile", "Theme Tidak bisa diinstall, tidak ditemukan file config");
                    }
                }
                $zip->close();
                unlink($tmp.$this->_zipFileTmpName);
                $this->delete_directory($tmp);
            } else {
                $this->addError("zipFile", "Theme Tidak bisa diinstall");
                $this->delete_directory($tmp);
            } 
        }
        
        /*
        * ------------Instalasi Komponen--------------------
        */
        /*
        public function unInstallKomponen($komponen){
            unlink(Yii::app()->basePath."/modules/komponen/controllers/".ucfirst(strtolower($komponen->nama_komponen))."Controller.php");
            //unlink($this->_dirAdminig."/controllers/".ucfirst(strtolower($komponen->nama_komponen))."Controller.php");
            $this->delete_directory($this->_dirAdminig."/views/".strtolower($komponen->nama_komponen));
            $this->delete_directory(Yii::app()->basePath."/views/".strtolower($komponen->nama_komponen));
            $table = unserialize($komponen->table_komponen);
            if(is_array($table)){
                foreach ($table as $Tmodel => $TTable){
                    unlink(Yii::app()->basePath."/models/".$Tmodel.".php");
                    Yii::app()->db->createCommand()->dropTable($TTable);
                }
            }
            Komponen::model()->deleteAll("id_komponen = '".$komponen->id_komponen."'");
            $komponen->delete();
       }
        
        public function installKomponen(){
            $tmp = $this->_dirTemp;
            $zip = new ZipArchive;
            if ($zip->open($tmp.$this->_zipFileTmpName) === TRUE) {
                $nama = explode(".", $this->_zipFileTmpName);
                if($this->checkKomponen($nama[0])){
                    $this->addError("zipFile", "Komponen Telah Terinstall ");
                }else{
                    $zip->extractTo($this->_dirTemp);
                    if(is_file($this->_dirTemp."/komponen.php") 
                            && is_dir($this->_dirTemp."/controllers")
                            && is_dir($this->_dirTemp."/views")
                            ){
                        $config = include $this->_dirTemp."/komponen.php";
                        if( !empty($config['pembuat']) &&
                            !empty($config['keterangan'])
                            ){
                            $komponen['nama_komponen'] = $nama[0];
                            $komponen['pembuat_komponen'] = $config['pembuat'];
                            $komponen['keterangan_komponen'] = $config['keterangan'];
                            $komponen['pengguna_komponen'] = $config['pengguna'];
                            if(is_dir($this->_dirTemp."/admin/".$nama[0]) 
                                    && is_dir($this->_dirTemp."/client/".$nama[0]) 
                                    && !is_dir($this->_dirAdminig."/views/".$nama[0]) 
                                    && !is_dir(Yii::app()->basePath."/views/".$nama[0]) 
                                    && !is_file($this->_dirAdminig."/models/".$nama[0].".php") 
                                    ){
                                    if(isset($config['table'])){
                                        foreach ($config['table'] as $TModel => $table){
                                            if(!is_file($this->_dirAdminig."/models/".$TModel.".php")){
                                                DLDatabaseHelper::import($this->_dirTemp."/data/".$table.".sql");
                                            }else{
                                                $this->addError("zipFile", "Komponen Tidak bisa diinstall 2");
                                                $this->delete_directory($tmp);
                                                exit; 
                                            }
                                        }
                                        $komponen['table_komponen'] = serialize($config['table']);
                                    }
                                    $model = new Komponen;
                                    $model->attributes = $komponen;
                                    if($model->save()){   
                                        rename($this->_dirTemp."/client/".$nama[0]."Controller.php", Yii::app()->basePath."/controllers/".ucfirst(strtolower($nama[0]))."Controller.php");
                                        rename($this->_dirTemp."/admin/".$nama[0]."Controller.php", $this->_dirAdminig."/controllers/".ucfirst(strtolower($nama[0]))."Controller.php");
                                        rename($this->_dirTemp."/data/".$nama[0].".php", Yii::app()->basePath."/models/".$nama[0].".php");
                                        $this->copyDirectory($this->_dirTemp."/admin/".$nama[0],$this->_dirAdminig."/views/".strtolower($nama[0]));
                                        $this->copyDirectory($this->_dirTemp."/client/".$nama[0],Yii::app()->basePath."/views/".strtolower($nama[0]));
                                        $this->HasilId = $model->primaryKey;
                                        $this->delete_directory($tmp);
                                    }else{
                                        $this->addError("zipFile", "Komponen Tidak bisa diinstall ");
                                        $this->delete_directory($tmp);
                                    }
                            }else{
                                $this->addError("zipFile", "Komponen sudah terinsatall ");
                                $this->delete_directory($tmp);
                            }
                        }else{
                            $this->addError("zipFile", "Komponen Tidak bisa diinstall ");
                            $this->delete_directory($tmp);
                        }
                    }else{
                        $this->addError("zipFile", "Komponen Tidak bisa diinstall ");
                        $this->delete_directory($tmp);
                    }
                }
            }
        }
        
        private function checkKomponen($nama){
            $jml = Komponen::model()->count("nama_komponen = :nama", array(":nama"=>$nama));
            if($jml != 0){
                return true;
            }else{
                return false;
            }
        }




        /*
        * ------------Instalasi Widget--------------------
        */
        /*public function createDirTmp(){
        if(is_dir($this->pathTmp)){
            $this->delete_directory($this->pathTmp);
        }
        if(mkdir($this->pathTmp)){
            chmod($this->pathTmp, 0777);
            return true;
        }else{
            $this->addError("zipFile","Tidak bisa membuat direktori tmp");
            return false;
        }
    }
        public function unInstallWidget($widget){
           $this->delete_directory($this->_dirWidget."/".$widget->nama_widget);
           $widget->delete();
        }
       
        public function installWidget(){
            $tmp = $this->_dirTemp;
            $zip = new ZipArchive;
            if ($zip->open($tmp.$this->_zipFileTmpName) === TRUE) {
                $nama = explode(".", $this->_zipFileTmpName);
                if(is_dir($this->_dirWidget."/".$nama[0])){
                    $this->addError("zipFile", "Widget Telah Terinstall");
                }else{
                    mkdir($this->_dirWidget."/".$nama[0]);
                    $zip->extractTo($this->_dirWidget."/".$nama[0]);
                    if(is_file($this->_dirWidget."/".$nama[0]."/widget.php")){
                        $config = include $this->_dirWidget."/".$nama[0]."/widget.php";
                        if( !empty($config['pembuat']) &&
                            !empty($config['keterangan'])
                            ){
                            $widget['nama_widget'] = $nama[0];
                            $widget['pembuat_widget'] = $config['pembuat'];
                            $widget['keterangan'] = $config['keterangan'];
                            $model = new Widget;
                            $model->attributes = $widget;
                            if($model->save()){
                                unlink($this->_dirWidget."/".$nama[0]."/widget.php");
                                $this->HasilId = $model->primaryKey;
                            }else{
                                $this->delete_directory($this->_dirWidget."/".$nama[0]);
                                $this->addError("zipFile", "Widget Tidak bisa diinstall");
                            }
                        }
                    }
                }
                $zip->close();
                unlink($tmp.$this->_zipFileTmpName);
                $this->delete_directory($tmp);
            }else {
                $this->addError("zipFile", "Widget Tidak bisa diinstall");
                $this->delete_directory($tmp);
            } 
        }*/
        
    
        
    
    
}
?>
