<?php
/* @var $this ThemeController */
/* @var $model Theme */
?>

<?php
$this->breadcrumbs=array(
	'Themes'=>array('index'),
	$model->id_theme=>array('view','id'=>$model->id_theme),
	'Update',
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'View Theme', 'url'=>array('view', 'id'=>$model->id_theme)),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

    <h1>Update Theme <?php echo $model->id_theme; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>