<?php

class ThemeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';
        private $_theme;
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
			array('allow', 
				'actions'=>array('layout','admin','aktifkanTheme','delete','detailWidget','create','update','index','view'),
				'roles'=>array('admin'),
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
			'layout'=>Layouts::model()->findAll("id_theme = :id AND tipe = 'file'",array(":id"=>$id)),
			'cssFile'=>Layouts::model()->findAll("id_theme = :id AND tipe = 'css'",array(":id"=>$id)),
                        'widget'=>WidgetPosisi::model(),
		));
	}
        
	public function actionLayout($theme, $layout)
	{
                $theme = $this->loadModel($theme);
                $layout= Layouts::model()->find("id = :id",array(":id"=>$layout));
                $model = new FileLayout;
                switch ($layout->tipe) {
                    case "file":
                        $ext = "php";
                        break;
                    case "css":
                        $ext = "css";
                        break;

                    default:
                        $ext = "php";
                        break;
                }
                $files  =  array($layout->file_name.".".$ext);  
                if(!in_array($layout->file_name.".".$ext,  $files)) {
                   throw new CHttpException(400,'Invalid open file');  
                }else{
                    $file = Yii::app()->themeManager->basePath."/".$theme->nama_theme."/".$layout->folder."/".$layout->file_name.".".$ext;
                }
                if(isset($_POST['FileLayout'])){
                    file_put_contents($file, $_POST['FileLayout']['file']);
                    Yii::app()->user->setFlash('berhasil','File '.$layout->name." berhasil di Ubah");
                }    
                if(is_file($file)){
                    $content = file_get_contents($file);
                    $arr['file'] = $content;
                    $model->setAttributes($arr);
                    $this->render('layout',array(
                            'model'=>$model,
                            'layoutName'=>$layout->name,
                            'tipe'=>$ext,
                    ));
                }else{
                    throw new CHttpException(400,'Invalid open file'); 
                }                
	}
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Install;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Install'])) {
			$model->setAttributes($_POST['Install']['zipFile']);
                        $model->zipFile = CUploadedFile::getInstance($model, "zipFile");
                        if($model->validate()){
                            if($model->installTheme($model->zipFile))
                                Yii::app()->user->setFlash('berhasil','Theme '.$model->getName()." berhasil di Install");
                        }
                        
		}

		$this->render('create',array(
			'model'=>$model,
			'theme'=>$this->_theme,
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

		if (isset($_POST['Theme'])) {
			$model->attributes=$_POST['Theme'];
			if ($model->save()) {
				$this->redirect(array('view','id'=>$model->id_theme));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
	public function actionAktifkanTheme($id)
	{
		$model=$this->loadModel($id);
                if( $model->status_theme == "1"){
                    Theme::model()->nonActiveTheme();
                    $model->status_theme = "0";
                }else{
                    Theme::model()->nonActiveTheme();
                    $model->status_theme = "1";
                }
                $model->save();
                $this->redirect(array('admin'));
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
                        $intall = new Install;
                        $intall->unInstallTheme($model);

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
		$dataProvider=new CActiveDataProvider('Theme');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Theme('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Theme'])) {
			$model->attributes=$_GET['Theme'];
		}
                $tmpTheme = Theme::model()->find("status_theme = '1'");
                if(isset($tmpTheme)){
                    $this->_theme= $tmpTheme;
                }

		$this->render('admin',array(
			'model'=>$model,
			'theme'=>$this->_theme,
                        'jmlLayout'=>count(Layouts::model()->findAll("id_theme = :id and tipe = :tipe",array(":id"=>Serayu::getThemeActive(),":tipe"=>"file"))),
                        'jmlWP'=>count(WidgetPosisi::model()->findAll("id_theme = :id",array(":id"=>Serayu::getThemeActive()))),
                        'jmlW'=>count(Layouts::model()->findAll("id_theme = :id",array(":id"=>Serayu::getThemeActive()))),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Theme the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Theme::model()->findByPk($id);
		if ($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Theme $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='theme-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}