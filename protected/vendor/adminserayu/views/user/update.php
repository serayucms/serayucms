<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php

$this->menu=array(
	array('label'=>'Daftar User', 'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'Buat User','url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'Lihat User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess("admin")),
);
?>
<?php
$this->judul=Yii::t('app','app.user');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.daftar'), 'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.buat'), 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.lihat'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.manage'), 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess("admin")),
);
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.user.menu.ubah') ?> #<?php echo $model->id ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>    
    </div>
</div>