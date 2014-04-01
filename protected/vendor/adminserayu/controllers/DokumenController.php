<?php

class DokumenController extends Controller
{
	/*
        public function actions()
        {
            return array(
                'konektor' => "ext.ezzeelfinder.ElFinderConnectorAction",
            );
        }*/
        public function actions()
        {
            return array(
                'connector' => array(
                    'class' => 'ext.elFinder.ElFinderConnectorAction',
                    'settings' => array(
                        'root' => $this->pathRootElfinder(),
                        'URL' => $this->getUrlElfinder(),
                        'rootAlias' => 'Home',
                        'mimeDetect' => 'none',
                        'defaults' => array('read' => true, 'write' => true, 'rm' => true),
                        
                    )
                ),
            );
        }
        
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionUpload()
	{
                $this->layout = "/layouts/login";
                $this->render('upload');
	}
        
        private function pathRootElfinder(){
            switch (Yii::app()->session['level']) {
                case "admin":
                    return Yii::getPathOfAlias('webroot') . '/images/upload/';
                    break;

                default:
                    return Yii::getPathOfAlias('webroot') . '/images/upload/'.User::model()->getPathUser(Yii::app()->user->getId());
                    break;
            }
        }
        
        private function getUrlElfinder(){
            switch (Yii::app()->session['level']) {
                case "admin":
                    return Yii::app()->baseUrl . '/images/upload/';
                    break;

                default:
                    return Yii::app()->baseUrl . '/images/upload/'.User::model()->getPathUser(Yii::app()->user->getId());
                    break;
            }
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