<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
         public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
        
        public function actionLogout() {
            Yii::app()->user->logout(false);
            unset(Yii::app()->session['level']);
            $this->redirect(Yii::app()->getModule($this->module->id)->user->loginUrl);
        }
        
        public function actionLogin() {
            //Yii::app()->request->redirect(Yii::app()->createUrl(Yii::app()->user->returnUrl));
                $model=new LoginAdmin;
                $this->layout = "login";
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-admin')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginAdmin']))
		{
			$model->attributes=$_POST['LoginAdmin'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                            $this->redirect(Yii::app()->baseUrl."/".$this->module->id."/default");
                            //print_r($model);
                        }
			
		}
		// display the login form
		$this->render('login',array('model'=>$model));
       }
}