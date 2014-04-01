<?php
$this->judul=Yii::t('app','app.halaman');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.buat'), 'url'=>array('create')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.halaman.menu.manage') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'htmlOptions'=>array("class"=>"table table-hover"),
            'type' => TbHtml::GRID_TYPE_BORDERED,
            'columns'=>array(
                    array(
                            'name'=>'title',
                            'type'=>'raw',
                            'value'=>'CHtml::link(CHtml::encode($data->title), $data->url)'
                    ),
                    array(
                            'name'=>'status',
                            'value'=>'Lookup::item("PostStatus",$data->status)',
                            'filter'=>Lookup::items('PostStatus'),
                    ),
                    array(
                            'name'=>'create_time',
                            'type'=>'datetime',
                            'filter'=>false,
                    ),
                    array(
                        "name" => "frontpage",
                        'type'=>'html',
                        'filter'=>false,
                        "value" => '$data->frontpage == "0" | $data->frontpage == NULL ? TbHtml::icon("remove-sign",array("rel"=>"tooltip","title"=>"Aktifkan","href"=>Yii::app()->createUrl(Yii::app()->controller->module->id."/halaman/frontpage",array("id"=>$data->id)) ),"a") : TbHtml::icon("ok-sign")  ',
                        'htmlOptions'=>array("style"=>"text-align:center;width:150px"),
                    ),
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'htmlOptions'=>array('style'=>'text-align:center'),
                    ),
            ),
    )); ?> 
    </div>
</div>