<?php
$this->judul=Yii::t('app','app.menu');

$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.menu.menu.kembali'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.menu.menu.buatItem'), 'url'=>array('create',"id"=>$_GET['id'])),
);
?>
<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-lg-7 border-kanan">
                <?php
                $this->widget('ext.nestable.nestableWidget',array(
                    'htmlOptions'=>array(
                        "class"=>"dd",
                        "id"=>"nestable",
                    ),
                    "idMenuParent"=>$_GET["id"],
                    "model"=>Menu::model(),
                    "url"=>$this->module->id."/menu",
                ));
                ?>
            </div>
            <div class="col-lg-5">
                <?php echo Yii::t('app','app.menu.ket.keterangan1'); ?>    
            </div>
        </div>
    </div>
</div>



