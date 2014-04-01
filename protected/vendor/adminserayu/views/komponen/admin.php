<?php
$this->judul=Yii::t('app','app.komponen');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.komponen.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.komponen.menu.install'), 'url'=>array('create')),
);
?>
<div class="box">
    <div class="box-body">
        <?php $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'komponen-grid',
                'dataProvider'=>$model->search(),
                'htmlOptions'=>array("class"=>"table table-hover"),
                'type' => TbHtml::GRID_TYPE_BORDERED,
                'filter'=>$model,
                'columns'=>array(
                        'nama_komponen',
                        'pembuat_komponen',
                        'gambar_komponen',
                        array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'template'=>'{meneg} | {delete}',
                            'buttons'=>array
                                            (
                                                'meneg' => array
                                                (
                                                    'label'=>'Manage Komponen',
                                                    'url'=>'Yii::app()->createUrl(Yii::app()->controller->getIdAdminserayu()."/kom/".strtolower($data->nama_komponen)."/admin")',
                                                ),
                                            ),
                    ),
                ),
        )); ?>
    </div>
</div>
