<?php
$this->judul=Yii::t('app','app.user');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.buat'), 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.manage'),'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess("admin")),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.user.menu.daftar') ?> </h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->widget('bootstrap.widgets.TbListView',array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
    )); ?>
    </div>
</div>