<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	
	public $layout='//layouts/kolom1';
	
	public $menu=array();
        
        public $metaTitle;
        
        public $metaDescription ;
        
        public $metaKeyword;
	
	public $breadcrumbs=array();
        
        
        
        protected function beforeAction($action) {
            if(Yii::app()->params['mPaktif'] == 1 && $action->id != "perbaikan" && !isset( Yii::app()->session['level']) ){
                $this->redirect(Yii::app()->createUrl("site/perbaikan"));
            }else{
                Yii::app()->theme = Theme::model()->getActiveTheme();
                StatistikPengunjung::model()->updatePengunjung($_SERVER['REMOTE_ADDR']);
            }
            
            return parent::beforeAction($action);
        }
        
        
        
        protected function beforeRender($view) {
            Yii::app()->clientScript->registerMetaTag(Yii::app()->language, 'language');
            return parent::beforeRender($view);
        }
        
        protected function afterRender($view, &$output) {
            if(!empty($this->metaTitle)){
                Yii::app()->clientScript->registerMetaTag($this->metaTitle, 'title');
            }
            if(!empty($this->metaDescription)){
                Yii::app()->clientScript->registerMetaTag($this->metaDescription, 'description');
            }
            if(!empty($this->metaKeyword)){
                Yii::app()->clientScript->registerMetaTag($this->metaKeyword, 'keywords');
            }
            Yii::app()->clientScript->registerMetaTag('serayucms', 'generator');
            parent::afterRender($view, $output);
        }
        
        


}