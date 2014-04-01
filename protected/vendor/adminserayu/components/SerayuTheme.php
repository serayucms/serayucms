<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SerayuTheme
 *
 * @author serayucms
 *  $theme['nama_theme'] = $nama[0];
                            $theme['pembuat_theme'] = $config['pembuat'];
                            $theme['gambar_theme'] = Yii::app()->baseUrl."/themes/".$nama[0]."/".$config['gambar'];
                            $theme['keterangan_theme'] = $config['keterangan'];
                            $theme['status_theme'] = "0";
 */
class SerayuTheme {
    public $nama;
    public $pembuat;
    public $gambar;
    public $keterangan;
    
    protected function install(){
        $install = new SerayuInstall();
    }
}

?>
