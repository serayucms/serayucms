<?php
class nestableWidget extends CWidget{
    public $assetsDir;
    public $htmlOptions = array();
    public $model;
    public $url;
    public $idMenuParent;
    
    public function init() {
            $dir = dirname(__FILE__) . '/assets';
            $asset = Yii::app()->assetManager;
            $this->assetsDir = $asset->publish($dir);
    }

    public function run() {
            $cs = Yii::app()->getClientScript();
            $cs->registerCssFile($this->assetsDir .'/nestable.css');
            $cs->registerScriptFile($this->assetsDir . '/jquery.nestable.js');
            $this->buatJs();
            echo CHtml::openTag('div', $this->htmlOptions);
            $this->buatIsi();
            echo CHtml::closeTag('div') . "\n";
    }
    
    

    public function buatIsi(){
        echo '<ol class="dd-list">';
        foreach ($this->model->findAll("parent_id = '0' AND id_menu_parent = '".$this->idMenuParent."' order by position") as $value){
            echo '  <li class="dd-item" data-id="'.$value->position.'" data-valid = "'.$value->id.'">';
            echo '  <div class="dd-handle">'.$value->label.'</div>';
            echo '  <div class="dd-detail"> Label : '.$value->label.' <span><a rel="tooltip" title="update" href="'.Yii::app()->createUrl($this->url."/update", array('id'=>$value->id)).'"><i class="glyphicon glyphicon-pencil"></i></a> '.CHtml::link('<i class="glyphicon glyphicon-trash"></i>',Yii::app()->createUrl($this->url."/delete", array('id'=>$value->id)), array('rel'=>'tooltip','title'=>'Delete',"submit"=>array('delete', 'id'=>$value->id), 'confirm' => 'Apakah anda yakin akan menghapus menu ini?')).'</span></div>';
            $this->checkAnakan($value->id);
            echo '  </li>';
        }
        echo '</ol>';   
    }
    
    private function checkAnakan($data){
        if(count($this->model->findAll("parent_id = '".$data."'")) != "0" ){
            echo '<ol class="dd-list">';
            foreach ($this->model->findAll("parent_id = '".$data."' AND id_menu_parent = '".$this->idMenuParent."' order by position") as $value){
                echo '  <li class="dd-item" data-id="'.$value->position.'" data-valid = "'.$value->id.'">';
                echo '  <div class="dd-handle">'.$value->label.'</div>';
                echo '  <div class="dd-detail">'.$value->label.'<span><a rel="tooltip" title="update" href="'.Yii::app()->createUrl($this->url."/update", array('id'=>$value->id)).'"><i class="glyphicon glyphicon-pencil"></i></a> '.CHtml::link('<i class="glyphicon glyphicon-trash"></i>',Yii::app()->createUrl($this->url."/delete", array('id'=>$value->id)), array('rel'=>'tooltip','title'=>'Delete',"submit"=>array('delete', 'id'=>$value->id), 'confirm' => 'Apakah anda yakin akan menghapus menu ini?')).'</span></div>';
                $this->checkAnakan($value->id);
                echo '  </li>';
            }
            echo '</ol>'; 
        }
    }
    
    public function buatJs(){
        Yii::app()->clientScript->registerScript("nestable",
                        "
                        $('#nestable').nestable({
                            group: 1
                        })
                        .on('change', updateOutput);

                        function updateOutput(){
                            $.ajax({
                            type: \"POST\",
                            url: \" ".Yii::app()->createUrl($this->url."/repost")." \",
                            data: { name: $('#nestable').nestable('serialize'), location: \"Boston\" }
                          })
                            .done(function( msg ) {
                              
                            });
                        }
                        
                        ",
                        CClientScript::POS_END
                        );
    }
    
    

}
?>
