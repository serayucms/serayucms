<?php

class HalamanController extends Controller
{
	private $_model;
        public function actionView()
	{
                $post=$this->loadModel();
                $this->breadcrumbs=array(
                        $post->title,
                );
                $this->pageTitle= Yii::app()->params['title'] ." | ". $post->title;
                $this->metaDescription = $post->meta_description;
                $this->metaTitle = $post->meta_title;
                $this->metaKeyword = $post->meta_keyword;
                
		$this->render('view',array(
			'data'=>$post,
		));
	}
        
        public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['alias']))
			{
                                $this->_model=Post::model()->find('slug = :sl AND status ='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED, array(":sl"=>$_GET['alias']));
                                if(!empty($this->_model->parent) && !isset($_GET['parent'])){
                                    throw new CHttpException(404,'Halaman yang anda cari tidak ditemukan.');
                                }
                                
                                if(!empty($this->_model)){
                                    $this->_model->hit = $this->_model->hit + 1;
                                    $this->_model->update();
                                }
                                
			}
			if($this->_model===null)
				throw new CHttpException(404,'Halaman yang anda cari tidak ditemukan.');
		}
		return $this->_model;
	}

}