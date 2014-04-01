<?php
/* @var $this KomponenController */
/* @var $model Komponen */
?>

<?php
$this->breadcrumbs=array(
	'Komponens'=>array('index'),
	$model->id_komponen=>array('view','id'=>$model->id_komponen),
	'Update',
);

$this->menu=array(
	array('label'=>'List Komponen', 'url'=>array('index')),
	array('label'=>'Create Komponen', 'url'=>array('create')),
	array('label'=>'View Komponen', 'url'=>array('view', 'id'=>$model->id_komponen)),
	array('label'=>'Manage Komponen', 'url'=>array('admin')),
);
?>

    <h1>Update Komponen <?php echo $model->id_komponen; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>