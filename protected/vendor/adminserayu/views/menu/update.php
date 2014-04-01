<?php
$this->judul=Yii::t('app','app.menu');

$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.menu.menu.kembali'), 'url'=>array('admin',"id"=>$model->id_menu_parent)),
);
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Ubah Menu #<?php echo $model->id ?></h3>
    </div>
    <div class="panel-body">
    <?php 
    $this->renderPartial('_form', array(
            'model'=>$model,            
            'halaman'=>$halaman,
            'kategori'=>$kategori,
            'komponen'=>$komponen,
            )); 
    ?>
    </div>
</div>