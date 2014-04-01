<?php
/* @var $this WidgetController */
/* @var $model Widget */
?>

<?php
$this->breadcrumbs=array(
	'Widgets'=>array('index'),
	$model->id_widget=>array('view','id'=>$model->id_widget),
	'Update',
);

$this->menu=array(
	array('label'=>'List Widget', 'url'=>array('index')),
	array('label'=>'Create Widget', 'url'=>array('create')),
	array('label'=>'View Widget', 'url'=>array('view', 'id'=>$model->id_widget)),
	array('label'=>'Manage Widget', 'url'=>array('admin')),
);
?>

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Update Widget</h3>
  </div>
    <div class="panel-body">    
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>
    