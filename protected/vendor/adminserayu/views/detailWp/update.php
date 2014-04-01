<?php
/* @var $this DetailWpController */
/* @var $model DetailWp */
?>

<?php
$this->breadcrumbs=array(
	'Detail Wps'=>array('index'),
	$model->id_detail_wp=>array('view','id'=>$model->id_detail_wp),
	'Update',
);

$this->menu=array(
	array('label'=>'Kembali', 'url'=>Yii::app()->createUrl($this->module->id."/theme/view",array("id"=>$theme))),
);
?>

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Update Widget</h3>
  </div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', array(
                                        'model'=>$model,
                                        'widget'=>$widget,
                                        'theme'=>$theme,
                                        'posisi'=>$posisi,
                                        'data'=>$data,
        )); ?>
    </div>
</div>
    