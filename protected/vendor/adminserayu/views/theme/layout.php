<?php
$this->judul=Yii::t('app','app.theme');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.menu.menu.kembali'), 'url'=>array('theme/view','id'=>$_GET['theme'])),
);
?>
<?php if(Yii::app()->user->hasFlash('berhasil')): ?> 
<div class="alert alert-success">
    <?php echo Yii::app()->user->getFlash('berhasil'); ?>
</div>
<?php endif; ?>  
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                                        'id'=>'fileLayout-form',
                                        'enableAjaxValidation'=>false,
    )); ?>
<div class="box box-solid box-info">
    <div class="box-header">
        <h3 class="box-title">Layout : <?php echo $layoutName ?></h3>
        <div class="box-tools pull-right">
            <?php echo TbHtml::submitButton("Save",array(
                    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                )); ?>
        </div>
    </div>
    <div class="box-body">
        <?php $this->widget('yiiwheels.widgets.ace.WhAceEditor',
        array(
            'name'=>"ace",
            'value'=>$model->file,
            'mode'=>$tipe,
            'htmlOptions'=> array('style' => 'width:100%;height:540px')
        ));?>
        <?php echo $form->textArea($model,"file", array("style"=>"display:none")) ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<?php Yii::app()->clientScript->registerScript('someScript', "
$('#fileLayout-form').submit(function() {
    $('#FileLayout_file').html(aceEditor_ace.getValue());        
});
");
?>
