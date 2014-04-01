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
	array('label'=>'Update <?php echo $this->modelClass; ?>', 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Delete <?php echo $this->modelClass; ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Apakah Anda yakin akan menghapus ini?')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>
<div class="panel panel-info">
    <div class="panel-heading">
       <h3 class="panel-title">Update <?php echo $this->modelClass . " <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h3>
    </div>
    <div class="panel-body">
    <?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView',array(
        'htmlOptions' => array(
            'class' => 'table table-striped table-condensed table-hover',
        ),
        'data'=>$model,
        'attributes'=>array(
    <?php
    foreach ($this->tableSchema->columns as $column) {
        echo "\t\t'" . $column->name . "',\n";
    }
    ?>
            ),
    )); ?>
    </div>
</div>