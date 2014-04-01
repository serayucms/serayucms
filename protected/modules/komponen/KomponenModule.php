<?php

class KomponenModule extends CWebModule
{
        public $admin;
        private $_assetsUrl;
        
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
                
                    $this->setImport(array(
                            'sk.models.*',
                            'sk.components.*',
                    ));
                
		
	}
        
       
 
        public function getAssetsUrl($name = null){
            
            if ($this->_assetsUrl === null && $name == null)
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias('sk.assets') );
            else 
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias('application.modules.komponen.assets.'.$name) );
            
            return $this->_assetsUrl;
        }

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
                        if($this->admin){
                            $controller->layout = 'application.vendor.adminserayu.views.layouts.column2';
                        }else{
                            Yii::app()->theme = Theme::model()->getActiveTheme();
                        }
			return true;
		}
		else
			return false;
	}
}
