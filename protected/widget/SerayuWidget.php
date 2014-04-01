<?php
class SerayuWidget extends CWidget{
    
    public $class;
    public $title = false;
    public $data;
    public $mode;
    
    public function run() {
        if($this->mode){
            $this->render("_form");
        }else{
            $this->render("index");
        }
    }

}