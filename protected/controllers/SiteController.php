<?php

class SiteController extends Controller
{
	
       

        /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xf5f5f5,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    $this->layout = "application.views.layouts.blank";
            if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
        
        
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		if(Menu::model()->checkRouteInMenu(array("/site/contact"))):
                $model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
                else:
                    throw new CHttpException(404,'Halaman yang anda cari tidak ditemukan.');
                endif;
	}
        
	public function actionIndex()
	{
                $front = Halaman::model()->getfrontP();
                if(empty($front)){
                    $this->blogRender();
                }else{
                    $this->frontPageRender($front->id);
                    //$route = "halaman/view/alias/".$front->slug;
                    //$this->forward($route);
                }
	}
        
	public function actionKomponen($controller, $action)
	{
                $this->forward("sk/".$controller."/".$action);
	}
        
        private function blogRender(){
                $this->layout = Yii::app()->params['layoutArtikel'];
		$criteria=new CDbCriteria(array(
			'condition'=>'status='.Post::STATUS_PUBLISHED." AND page IS NULL",
			'order'=>'update_time DESC',
			'with'=>'commentCount',
		));
		if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);

		$dataProvider=new CActiveDataProvider('Post', array(
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['postsPerPage'],
			),
			'criteria'=>$criteria,
		));

		$this->render('/artikel/index',array(
			'dataProvider'=>$dataProvider,
		));
        }
        
        private function frontPageRender($id){
            $this->layout = 'depan';
            $model = Halaman::model()->findByPk($id);
            $this->pageTitle=Yii::app()->params['title'];
            $this->metaDescription = $model->meta_description;
            $this->metaTitle = $model->meta_title;
            $this->metaKeyword = $model->meta_keyword;
            $this->render('/halaman/view',array(
			'data'=>$model,
			'front'=>true,
		));
        }
        
        public function actionTest(){
            if(Menu::model()->checkRouteInMenu(array("/artikel/index")))
                echo "benar";
            else{
                $jadi = serialize (array("artikel/index"));
                echo $jadi.' | a:1:{i:0;s:13:"artikel/index";}';
            }
        }   
        
        
        
	

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array("user/profile"));
		}
		
                if(Yii::app()->user->isGuest):
                    $this->render('login',array('model'=>$model));
                else:
                    $this->redirect(array("user/profile"));
                endif;
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionPerbaikan()
	{
            $this->layout = "application.views.layouts.blank";
            if(Yii::app()->params['mPaktif'] == "0" || isset(Yii::app()->session['level'])){
                $this->redirect(Yii::app()->request->getBaseUrl(true));
            }
            $this->render('perbaikan',array('pesan'=>Yii::app()->params['keteranganPerbaikan']));
	}
}
