<?php
$this->judul=Yii::t('app','app.komponen');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.komponen.menu.install'), 'url'=>array('create')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.komponen.menu.manage'), 'url'=>array('admin')),
);
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.komponen.menu.daftar') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?php $this->widget('bootstrap.widgets.TbListView',array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_view',
        )); ?>
    </div>
</div>
