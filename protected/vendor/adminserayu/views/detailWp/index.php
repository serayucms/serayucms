<?php
/* @var $this DetailWpController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	'Detail Wps',
);

$this->menu=array(
	array('label'=>'Create DetailWp','url'=>array('create')),
	array('label'=>'Manage DetailWp','url'=>array('admin')),
);
?>

<h1>Detail Wps</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>