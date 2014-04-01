<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
Yii::import("application.vendor.adminserayu.components.Controller"); 
class SkomponenController extends Controller
{

	public $layout='//layouts/kolom1';
	
	public $adminRule=array();
	
	public $breadcrumbs=array();
        
        protected function beforeAction($action) {
            $this->menu = array(
                        array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Kembali', 'url'=>array("/{$this->getIdAdminserayu()}/komponen/admin")),
                );
            return parent::beforeAction($action);
        }

        
        
        
        protected function beforeRender($view) {
            $this->judul = $this->id;
            if(!$this->checkAccessRule()){
                throw new CHttpException(404,'halaman yang anda cari tidak ditemukan');
            }
            return parent::beforeRender($view);
        }
        
        protected function checkAccessRule(){
            $aturan = $this->aturan();
            if(array_key_exists($this->action->id,$aturan)){
                if(Yii::app()->user->isGuest){
                    return false;
                }else{
                    if($this->getLevelUser() != "admin"){
                        return in_array($this->getLevelUser(), $aturan[$this->action->id]);
                    }else{
                        return true;
                    }
                }
            }else{
                return true;
            }
        }
         
        protected function aturan(){
            return array();
        }

}