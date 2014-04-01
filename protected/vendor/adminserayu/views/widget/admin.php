<?php
$this->judul=Yii::t('app','app.widget');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.widget.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.widget.menu.install'), 'url'=>array('create')),
);
?>
<div class="box">
    <div class="box-body">
        <?php $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'widget-grid',
                'dataProvider'=>$model->search(),
                'htmlOptions'=>array("class"=>"table table-hover"),
                'type' => TbHtml::GRID_TYPE_BORDERED,
                'filter'=>$model,
                'columns'=>array(
                        'nama_widget',
                        'keterangan',  
                        array(
                                'class'=>'bootstrap.widgets.TbButtonColumn',
                        ),
                ),
        )); ?>
    </div>
</div>