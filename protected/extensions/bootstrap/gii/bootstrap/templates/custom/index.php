<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $dataProvider CActiveDataProvider */
<?php echo "?>\n"; ?>

<?php
echo "<?php\n";
?>

$this->menu=array(
	array('label'=>'Create <?php echo $this->modelClass; ?>','url'=>array('create')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>','url'=>array('admin')),
);
?>
<div class="panel panel-info">
    <div class="panel-heading">
       <h3 class="panel-title">Create <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h3>
    </div>
    <div class="panel-body">
<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>