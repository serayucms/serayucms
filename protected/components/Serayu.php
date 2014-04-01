<?php
class Serayu {
   
    public static function data(){
        return Yii::app();
    }
    
    public static function themePosisi($controller, $nama){
        $posisi = WidgetPosisi::model()->find("id_theme = '".self::getThemeActive()."' and nama_wp = '".$nama."'");
        if($posisi != NULL):
        foreach (DetailWp::model()->findAll("id_widget_posisi = '".$posisi->id_wp."'") as $data){
            $controller->widget("serayuWidget.".$data->idWidget->nama_widget.".".$data->idWidget->nama_widget, unserialize($data->config));
        }
        endif;
    }
    
    public static function getThemeActive(){
        $id = Theme::model()->find("status_theme = '1'");
        return $id != null ? $id->id_theme : NULL;
    }
    
    public static function registerCss($file){
        return Yii::app()->getClientScript()->registerCssFile($file);
    }
    
    public static function getMenuItem($name = null){
        return Menu::model()->getMenuItem($name == null ? "main-menu" :$name);
    }
    
}
?>
