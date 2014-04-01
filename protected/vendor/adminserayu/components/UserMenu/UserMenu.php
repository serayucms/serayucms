<?php
class UserMenu extends CWidget{
    public function run() { 
        $this->render("index",array('jmlKomentar'=>Comment::model()->getPendingCommentCount()));
    }
    
    public function KomponenUser($level){
        $komponen = Komponen::model()->findAll();
        foreach ($komponen as $value) {
            $pengguna = unserialize($value->pengguna_komponen);
            if(is_array($pengguna)){
                if(in_array($level, $pengguna)){
                    echo '<li class="fa">';
                    echo TbHtml::link('<i class="glyphicon glyphicon-chevron-right"></i> '.ucfirst($value->nama_komponen), array("/".Yii::app()->controller->getIdAdminserayu()."/kom/".$value->nama_komponen."/admin"));
                    echo '</li>';
                }
            }
            
        }
    }
}
?>
