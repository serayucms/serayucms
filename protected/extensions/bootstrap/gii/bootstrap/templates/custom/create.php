<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
<?php echo "?>\n"; ?>

<?php
echo "<?php\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<h1>Create <?php echo $this->modelClass; ?></h1>
<div class="panel panel-info">
    <div class="panel-heading">
       <h3 class="panel-title">Create <?php echo $this->modelClass; ?></h3>
    </div>
    <div class="panel-body">
    <?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
    </div>
</div>