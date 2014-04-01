<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */


$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
);
?>
<div class="panel panel-info">
    <div class="panel-heading">
       <h3 class="panel-title">Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h3>
    </div>
    <div class="panel-body">
    <?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'type' => TbHtml::GRID_TYPE_BORDERED,
            'columns'=>array(
    <?php
    $count = 0;
    foreach ($this->tableSchema->columns as $column) {
        if (++$count == 7) {
                    echo "\t\t/*\n";
            }
        echo "\t\t'" . $column->name . "',\n";
    }
    if ($count >= 7) {
            echo "\t\t*/\n";
    }
    ?>
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                    ),
            ),
    )); ?>
    </div>
</div>