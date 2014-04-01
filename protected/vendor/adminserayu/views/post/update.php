<?php
$this->judul=Yii::t('app','app.artikel');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.buat'), 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("buatArtikel")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.lihat'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.manage'), 'url'=>array('admin')),
);
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.artikel.menu.ubah') ?> #<?php echo $model->id ?></h3>
         
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