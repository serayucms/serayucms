<?php
/* @var $this UserController */
/* @var $model User */
?>

<?php
$this->judul=Yii::t('app','app.user');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.daftar'), 'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.buat'), 'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.ubah'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.hapus'), 'url'=>'#', 'visible'=>Yii::app()->user->checkAccess("admin"), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Apakah Anda yakin akan menghapus ini?')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.user.menu.manage'), 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess("admin")),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.user.menu.lihat') ?> #<?php echo $model->id; ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-lg-3" style="text-align: center">
                <?php echo CHtml::image(Yii::app()->baseUrl."/".$model->image,$model->name,array('class'=>'thumbnail','style'=>'display: block;margin: 0 auto;')) ?><br/>
                <div style="font-weight: bold;margin-top: 20px"><?php echo $model->name; ?></div><br/>
                <div style="font-size: 12px;"><?php echo nl2br($model->profile); ?></div>
            </div>
            <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <h4 class="panel-title">Detail</h4>
                    </div>
                    <div class="panel-body">
                        <?php $this->widget('zii.widgets.CDetailView',array(
                            'htmlOptions' => array(
                                'class' => 'table table-striped table-condensed table-hover',
                            ),
                            'data'=>$model,
                            'attributes'=>array(
                                    'username',
                                    'email',
                                    'level',
                                    array(               // related city displayed as a link
                                        'label'=>'Last Visit',
                                        'type'=>'raw',
                                        'value'=>date('F j, Y',$model->lastvisit),
                                    ),
                                ),
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>