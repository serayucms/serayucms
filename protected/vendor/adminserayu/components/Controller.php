<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
	public $judul="";
        
        public function pKomentar(){
            //return Komentar::model()->jumlahKomentarPending();
        }
        
        protected function getNamaUser(){
            return User::model()->findByPk(Yii::app()->user->getId())->name;
        }
        
        protected function getLevelUser(){
            return User::model()->findByPk(Yii::app()->user->getId())->level;
        }
        
        public function getIdAdminserayu(){
            $idParentModule = count(Yii::app()->controller->module->parentModule) != 0 ? Yii::app()->controller->module->parentModule->id  : Yii::app()->controller->module->id;
            return $idParentModule;
        }
}