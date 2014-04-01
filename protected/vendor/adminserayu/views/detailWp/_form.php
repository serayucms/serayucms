<?php
/* @var $this DetailWpController */
/* @var $model DetailWp */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'detail-wp-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php  ?>
            <?php if($model->isNewRecord):  ?>
                <input type="hidden" name="DetailWp[id_widget_posisi]" value="<?php echo $posisi ?>">
                <input type="hidden" name="DetailWp[id_widget]" value="<?php echo $widget->id_widget ?>">
                <?php $this->widget("serayuWidget.".$widget->nama_widget.".".$widget->nama_widget, array('mode'=>true));  ?>
            <?php else: ?>
                <input type="hidden" name="DetailWp[id_widget_posisi]" value="<?php echo $model->id_widget_posisi ?>">
                <input type="hidden" name="DetailWp[id_widget]" value="<?php echo $model->id_widget ?>">
                <?php $this->widget("serayuWidget.".$widget->nama_widget.".".$widget->nama_widget, CMap::mergeArray(array("mode"=>true),unserialize($model->config)));  ?>
            <?php endif; ?>
   

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Simpan',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,		    
		)); ?>
    </div>
    
    

    <?php $this->endWidget(); ?>

</div><!-- form -->