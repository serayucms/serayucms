<?php
$this->judul=Yii::t('app','app.halaman');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.buat'), 'url'=>array('create')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.lihat'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.manage'), 'url'=>array('admin')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.halaman.menu.ubah') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php if(Yii::app()->user->hasFlash('postBerhasil')): ?> 
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('postBerhasil'); ?>
    </div>
    <?php endif; ?>    
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>