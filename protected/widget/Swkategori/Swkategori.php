<?php
class Swkategori extends SerayuWidget{
    
    public $urutan = "ASC";
    
    public function findAllCategory(){
      $posts = Kategori::model()->findAll(array('order'=>'nama_kategori '.$this->urutan));
      return $posts;
    }
    
}