<?php
/* @var $this KomponenController */
/* @var $model Komponen */


$this->breadcrumbs=array(
	'Komponens'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Daftar Komponen', 'url'=>array('index')),
	array('label'=>'Install Komponen', 'url'=>array('create')),
);

?>

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Manag Komponen</h3>
  </div>
    <div class="panel-body">
        <?php $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'komponen-grid',
                'dataProvider'=>$model->search(),
                'type' => TbHtml::GRID_TYPE_BORDERED,
                'filter'=>$model,
                'columns'=>array(
                        array(
                            "name"=>"nama_komponen",
                            'htmlOptions'=>array("style"=>"width:20%;")
                        ),
                        'pembuat_komponen',
                        
                        array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'template'=>'{meneg} | {delete}',
                            'htmlOptions'=>array("style"=>"width:15%;text-align:center"),
                            'buttons'=>array
                                            (
                                                'meneg' => array
                                                (
                                                    'label'=>'Manage',
                                                    'url'=>'Yii::app()->createUrl(Yii::app()->controller->getIdAdminserayu()."/kom/".strtolower($data->nama_komponen)."/admin")',
                                                ),
                                            ),
                    ),
                ),
        )); ?>
    </div>
</div>
