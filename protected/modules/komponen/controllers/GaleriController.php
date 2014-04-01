<?php

class GaleriController extends SkomponenController
{
	//public $layout = "//layouts/kolom1";


        public function actionIndex()
	{
		$this->render('index');
	}
        
        public function aturan(){
            return array(
                'admin'=>array("author"),
            );
        }
  
        
        public function actionView()
	{
                $this->render('view');           
	}
        //--------------default------ yang bisa mengakses hanya admin
	public function actionAdmin()
	{
                $this->render('admin');
	}

}