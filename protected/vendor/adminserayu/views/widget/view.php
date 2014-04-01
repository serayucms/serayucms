<?php
/* @var $this WidgetController */
/* @var $model Widget */
?>

<?php
$this->breadcrumbs=array(
	'Widgets'=>array('index'),
	$model->id_widget,
);

$this->menu=array(
	array('label'=>'List Widget', 'url'=>array('index')),
	array('label'=>'Create Widget', 'url'=>array('create')),
	array('label'=>'Update Widget', 'url'=>array('update', 'id'=>$model->id_widget)),
	array('label'=>'Delete Widget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_widget),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Widget', 'url'=>array('admin')),
);
?>

<h1>View Widget #<?php echo $model->id_widget; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id_widget',
		'nama_widget',
		'keterangan',
	),
)); ?>