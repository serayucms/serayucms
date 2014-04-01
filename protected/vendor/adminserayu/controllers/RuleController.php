<?php

class RuleController extends Controller
{
	public function actionIndex()
	{
		
                $auth=Yii::app()->authManager;
                
                $auth->clearAll();
                
                $auth->createOperation('buatArtikel','Membuat Artikel');
                $auth->createOperation('bacaArtikel','Baca Artikel');
                $auth->createOperation('ubahArtikel','Ubah Artikel');
                $auth->createOperation('hapusArtikel','Hapus Artikel');
                
                //-----------user------
                $auth->createOperation('updateUser','Ubah User');
                $auth->createOperation('deleteUser','Hapus User');
                                
                $bizRule='return Yii::app()->user->id==Post::model()->findByPk($_GET["id"])->author_id;';
                $task=$auth->createTask('ubahArtikelSendiri','Mengubah Artikel Sendiri',$bizRule);
                $task->addChild('ubahArtikel');
                
                //-----------user------
                
                $bizRule='return Yii::app()->user->id==User::model()->findByPk($_GET["id"])->id;';
                $task=$auth->createTask('updateUserSendiri','Mengubah User Sendiri',$bizRule);
                $task->addChild('updateUser');

                $role=$auth->createRole('member');
                $role->addChild('bacaArtikel');
                
                $role=$auth->createRole('author');
                $role->addChild('member');
                $role->addChild('buatArtikel');
                $role->addChild('ubahArtikelSendiri');
                $role->addChild('updateUserSendiri');
                
                $role=$auth->createRole('editor');
                $role->addChild('member');
                $role->addChild('ubahArtikel');
                $role->addChild('updateUserSendiri');

                $role=$auth->createRole('admin');
                $role->addChild('editor');
                $role->addChild('author');
                $role->addChild('hapusArtikel');
                $role->addChild('deleteUser');
                
                $role=$auth->createRole('root');
                $role->addChild('admin');
                
                $auth->assign('author','3');
                $auth->assign('editor','2');
                $auth->assign('admin','1');
                $auth->assign('member','4');
                
                
                
                $this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}