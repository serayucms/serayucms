<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
<?php echo "?>\n"; ?>

<?php
echo "<?php\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'View <?php echo $this->modelClass; ?>', 'url'=>array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>
<div class="panel panel-info">
    <div class="panel-heading">
       <h3 class="panel-title">Update <?php echo $this->modelClass . " <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h3>
    </div>
    <div class="panel-body">
    <?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
    </div>
</div>