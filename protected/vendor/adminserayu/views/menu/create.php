<?php
/* @var $this MenuController */
/* @var $model Menu */
?>

<?php
$this->judul=Yii::t('app','app.menu');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.menu.menu.kembali'), 'url'=>array('admin',"id"=>$_GET["id"])),
);
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Buat Menu</h3>
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