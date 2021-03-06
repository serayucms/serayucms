<?php

class UserController extends Controller
{
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
        
        public function accessRules(){
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','update','profile'),
				'roles'=>array('member'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionIndex()
	{
		$this->render('index');
	}

	public function actionProfile()
	{
		$this->breadcrumbs=array(
                        'User'=>array('/user'),
                        'Profile',
                );
                $this->render('profile');
	}

	public function actionUpdate()
	{
		$this->render('update');
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