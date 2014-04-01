<?php

class AdminserayuModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			$this->getId().'.models.*',
			$this->getId().'.components.*',
			'application.modules.komponen.components.*',
		));
                
                $this->setComponents(array(
                    'user' => array(
                        'class' => 'CWebUser',             
                        'loginUrl' => Yii::app()->createUrl($this->getId().'/default/login'),
                    )
                ));
                
                $this->setAliases(array(
                    'kontrol'=> Yii::getPathOfAlias($this->getId().'.controllers'),
                    'komponen'=> Yii::getPathOfAlias($this->getId().'.components'),
                    'adminLayout'=> Yii::getPathOfAlias($this->getId().'.views.layouts'),
                ));
                
                $this->layoutPath = Yii::getPathOfAlias($this->getId().'.views.layouts');
                
                Yii::app()->user->setStateKeyPrefix('_admin');
                
                Yii::app()->language = Yii::app()->params['bahasa'];
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			Yii::app()->errorHandler->errorAction=$this->getId().'/default/error';
                        $route = $controller->id . '/' . $action->id;
                        $publicPages = array(
                            'default/login',
                            'default/error',
                        );
                        if (Yii::app()->user->isGuest && !in_array($route, $publicPages)){            
                            Yii::app()->getModule($this->getId())->user->loginRequired();                
                        }else{
                            return true;
                        }
			return true;
		}
		else
			return false;
	}
}
