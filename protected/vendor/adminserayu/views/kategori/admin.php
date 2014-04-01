<?php
/* @var $this KategoriController */
/* @var $model Kategori */
$this->judul=Yii::t('app','app.kategori');

$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.buat'), 'url'=>array('create')),
);

?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.kategori.menu.manage') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'kategori-grid',
            'dataProvider'=>$model->search(),
        'htmlOptions'=>array("class"=>"table table-hover"),
            'type' => TbHtml::GRID_TYPE_BORDERED,
            'filter'=>$model,
            'columns'=>array(
                    'nama_kategori',
                    'keterangan_kategori',
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'htmlOptions'=>array('style'=>'text-align:center'),
                    ),
            ),
    )); ?>
    </div>
</div>