<?php
$this->judul=Yii::t('app','app.artikel');
$this->breadcrumbs=array(
	'Manage Posts',
);
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.buat'), 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("buatArtikel")),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.artikel.menu.manage') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'htmlOptions'=>array("class"=>"table table-hover"),
            'type' => TbHtml::GRID_TYPE_BORDERED,
            'columns'=>array(
                    array(
                            'name'=>'title',
                            'type'=>'raw',
                            'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
                    ),
                    array(
                            'name'=>'status',
                            'value'=>'Lookup::item("PostStatus",$data->status)',
                            'filter'=>Lookup::items('PostStatus'),
                    ),
                    array(
                            'name'=>'create_time',
                            'type'=>'datetime',
                            'filter'=>false,
                    ),
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'htmlOptions'=>array('style'=>'text-align:center'),
                            'buttons'=>array
                            (
                                'delete' => array
                                (
                                    'visible'=>'Yii::app()->user->checkAccess("author") || !Yii::app()->user->checkAccess("admin")',
                                ),
                            ),
                    ),
            ),
    )); ?> 
    </div>
</div>