<?php
$this->judul=Yii::t('app','app.widget');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.widget.menu.daftar'),'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.widget.menu.install'),'url'=>array('create')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.widget.menu.install') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?php if(Yii::app()->user->hasFlash('berhasil')): ?> 
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('berhasil'); ?>
        </div>
        <?php endif; ?>  
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>