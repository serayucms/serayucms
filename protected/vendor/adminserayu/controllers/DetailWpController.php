<?php

class DetailWpController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','view','create','update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($theme,$widget,$wd)
	{
		$model=new DetailWp;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
		if (isset($_POST['DetailWp'])) {
			$model->attributes=$_POST['DetailWp'];
                        $config = serialize($_POST['config']);
                        $model->config = $config;
			if ($model->save()) {
				$this->redirect(array('admin',"theme"=>$theme,'widget'=>$widget));
			}
		}

		$this->render('create',array(
			'model'=>$model,
                        'widget'=>Widget::model()->findByPk($wd),
                        'theme'=>$theme,
                        'posisi'=>$widget,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($theme,$widget,$wd,$id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                if(isset($model->config)){
                    $data = unserialize($model->config);
                }
		if (isset($_POST['DetailWp'])) {
			$model->attributes=$_POST['DetailWp'];
                        $config = serialize($_POST['config']);
                        $model->config = $config;
			if ($model->save()) {
				$this->redirect(array('admin',"theme"=>$theme,'widget'=>$widget));
			}
		}

		$this->render('update',array(
			'model'=>$model,
                        'widget'=>Widget::model()->findByPk($wd),
                        'theme'=>$theme,
                        'posisi'=>$widget,
                        'data'=>$data,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DetailWp');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($theme,$widget)
	{
		$model=new DetailWp('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['DetailWp'])) {
			$model->attributes=$_GET['DetailWp'];
		}

		$this->render('admin',array(
			'model'=>$model,
			'widget'=>$widget,
			'theme'=>$theme,
			'wd'=>Widget::model()->findAll(),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DetailWp the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DetailWp::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DetailWp $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='detail-wp-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}