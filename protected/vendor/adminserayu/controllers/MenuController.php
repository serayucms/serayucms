<?php

class MenuController extends Controller
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
			'postOnly + delete, deleteParent', // we only allow deletion via POST request
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
				'actions'=>array('admin','repost','delete','index','view','create','update','deleteParent'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model=new Menu;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Menu'])) {
			$model->attributes=$_POST['Menu'];
			if ($model->save()) {
				$this->redirect(array('admin',"id"=>$model->id_menu_parent));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'halaman'=>Halaman::model()->findAll('id_kategori is null'),
			'kategori'=>Kategori::model()->findAll(),
			'komponen'=>Komponen::model()->findAll(),
			'parent'=>$id,
		));
	}
        
	public function actionIndex()
	{
		$model=new ParentMenu;
                
                if (isset($_POST['ParentMenu'])) {
			$model->attributes=$_POST['ParentMenu'];
			$model->save();
		}
                
                $dataProvider=new CActiveDataProvider('ParentMenu');

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Menu'])) {
			$model->attributes=$_POST['Menu'];
                        if($_POST['Menu']['url'][0] == "/"){
                            $model->url = substr($_POST['Menu']['url'],1);
                        }
			if ($model->save()) {
				$this->redirect(array('admin',"id"=>$model->id_menu_parent));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'halaman'=>Halaman::model()->findAll('id_kategori is null'),
			'kategori'=>Kategori::model()->findAll(),
                        'komponen'=>Komponen::model()->findAll(),
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
			$model = $this->loadModel($id);
                        $id = $model->id_menu_parent;
                        $model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(array('admin',"id"=>$id));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}
        
	public function actionDeleteParent($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			ParentMenu::model()->findByPk($id)->delete();
                        
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax'])) {
				$this->redirect(array('index'));
			}
		} else {
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	        
	public function actionRepost()
	{
                foreach ($_POST['name'] as $key => $value) {
                    $this->checkChildren($value);
                    Menu::model()->updateByPk(
                            $value['valid'], 
                            array(
                                "parent_id" => "0",
                                "position" => $key,
                                )
                            );
                }
	}
        
        private function checkChildren($data){
            if(isset($data['children'])){
                foreach ($data['children'] as $key => $value) {
                    Menu::model()->updateByPk(
                            $value['valid'], 
                            array(
                                "parent_id" => $data['valid'],
                                "position" => $key,
                                )
                            );
                    $this->checkChildren($value);
                }
            }
        }

        /**
	 * Manages all models.
	 */
	public function actionAdmin($id)
	{
		//$model=new Menu('search');
		//$model->unsetAttributes();  // clear any default values
		//if (isset($_GET['Menu'])) {
		//	$model->attributes=$_GET['Menu'];
		//}
                
                $criteria=new CDbCriteria;
                $criteria->condition = "id_menu_parent = 2";
                $criteria->params = array(":idParent"=>$id);
                
                $model=new CActiveDataProvider('Menu', array(
			'criteria'=>$criteria,
		));
                
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Menu the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Menu::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Menu $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='menu-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}