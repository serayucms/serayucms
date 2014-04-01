<?php

class InstallationModule extends CWebModule
{
	private $_assetsUrl;
        public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'installation.models.*',
			'installation.components.*',
		));
                
                //$this->layoutPath = Yii::getPathOfAlias('application.modules.installation.views.layouts');
	}
        
        public function getAssetsUrl(){
        if ($this->_assetsUrl === null)
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias('application.modules.installation.assets') );
            return $this->_assetsUrl;
        }

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
