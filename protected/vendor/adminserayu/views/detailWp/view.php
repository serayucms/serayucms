<?php
/* @var $this DetailWpController */
/* @var $model DetailWp */
?>

<?php
$this->breadcrumbs=array(
	'Detail Wps'=>array('index'),
	$model->id_detail_wp,
);

$this->menu=array(
	array('label'=>'Kembali', 'url'=>Yii::app()->createUrl($this->module->id."/theme/view",array("id"=>$theme))),
);
?>

<h1>View DetailWp #<?php echo $model->id_detail_wp; ?></h1>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
		'id_detail_wp',
		'id_widget_posisi',
		'id_widget',
		'config',
	),
)); ?>