<?php
/* @var $this WidgetController */
/* @var $model Widget */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'widget-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>
        <?php echo $form->fileField($model, 'zipFile',array("style"=>"display:none")); ?>
        <div class="input-group">
            <input type="text" placeholder="Zip File Installer" id="file" class="form-control">
            <div class="input-group-btn">
              <button type="button" onclick="$('input[id=Install_zipFile]').click();" class="btn btn-default">Pilih File</button>
              <button type="submit"  class="btn btn-primary">Install</button>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php Yii::app()->clientScript->registerScript('pilihFile', <<<JS
    $('input[id=Install_zipFile]').change(function() {
        $('#file').val($(this).val());
    });
JS
, CClientScript::POS_READY);?>

