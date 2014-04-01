<?php

class DefaultController extends SkomponenController
{
	
        public function actionIndex()
	{
                if(Yii::app()->user->checkAccess("admin")){
                    $model=new Komponen('search');
                    $model->unsetAttributes();  // clear any default values
                    if (isset($_GET['Komponen'])) {
                            $model->attributes=$_GET['Komponen'];
                    }

                    $this->render('index',array(
                            'model'=>$model,
                    ));
                }
	}
}