<?php
$this->judul=Yii::t('app','app.user');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.daftar'), 'url'=>array('index') , 'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.buat'), 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("admin")),
);
?>
<div class="box box-solid box-info">
            <div class="box-header">
                <h3 class="box-title"><?php echo Yii::t('app','app.user.menu.manage') ?></h3>
            </div>
            <div class="box-body">
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'user-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'htmlOptions'=>array("class"=>"table table-hover"),
            'type' => TbHtml::GRID_TYPE_BORDERED,
            'columns'=>array(
                array(
                    "header"=>"Foto Profil",
                    "name"=>'image',
                    "type"=>"html",
                    "value"=>'
                        Chtml::Image($data->image != NULL ? Yii::app()->baseUrl."/".$data->image : Yii::app()->baseUrl."/images/user/default.png",$data->name,array("style"=>"width:75px;"))
                        ',
                    'filter'=>false,
                    ),
                'username',
		'email',
		'name',
                array(
                    "header"=>"Level",
                    "name"=>'level',
                    "value"=>'$data->level',
                    'filter'=>array('admin'=>'Admin','author'=>'Penulis','editor'=>'Editor','member'=>'Member'),
                    ),
                array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'htmlOptions'=>array('style'=>'width:70px;')
                ),
            ),
    )); ?>
    </div>
</div>