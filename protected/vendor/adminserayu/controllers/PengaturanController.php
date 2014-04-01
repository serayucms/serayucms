<?php

class PengaturanController extends Controller
{
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
    
        public function actionIndex()
	{
		$model=new ConfigForm;

                // uncomment the following code to enable ajax-based validation
                /*
                if(isset($_POST['ajax']) && $_POST['ajax']==='config-form-index-form')
                {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }
                */

                $file = Yii::app()->basePath.'/config/params/globalParams.inc';
                $content = file_get_contents($file);
                $arr = unserialize(base64_decode($content));
                $model->setAttributes($arr);
                if(isset($_POST['ConfigForm']))
                {
                    $model->attributes=$_POST['ConfigForm'];
                    if($model->validate())
                    {
                        $str = base64_encode(serialize($model->attributes));
                        file_put_contents($file, $str);
                        Yii::app()->user->setFlash('berhasil', Yii::t('app','app.pengaturan.ket.sukses'));
                        $model->setAttributes($model->attributes);
                        $this->redirect(array("/".$this->module->id."/pengaturan"));
                        //return;
                    }
                }
                //print_r($model);
                $this->render('index',array('model'=>$model));
	}
}