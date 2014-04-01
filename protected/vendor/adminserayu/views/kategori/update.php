<?php
$this->judul=Yii::t('app','app.kategori');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.buat'), 'url'=>array('create')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.lihat'), 'url'=>array('view', 'id'=>$model->id_kategori)),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.manage'), 'url'=>array('admin')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.kategori.menu.ubah') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>