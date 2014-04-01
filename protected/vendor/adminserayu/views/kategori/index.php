<?php
/* @var $this KategoriController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->judul=Yii::t('app','app.kategori');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.buat'),'url'=>array('create')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.manage'),'url'=>array('admin')),
);
?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.kategori.menu.daftar') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->widget('bootstrap.widgets.TbListView',array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
    )); ?>
    </div>
</div>