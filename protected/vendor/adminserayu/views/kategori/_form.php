<?php
/* @var $this KategoriController */
/* @var $model Kategori */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'kategori-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12">
            <?php echo $form->textFieldControlGroup($model,'nama_kategori',array('span'=>5,'maxlength'=>128)); ?>
            <?php echo $form->textAreaControlGroup($model,'keterangan_kategori',array('rows'=>6,'span'=>8)); ?>
            <?php echo $form->textFieldControlGroup($model,'id_parent',array('span'=>5)); ?>
        </div>
    </div>
    
    <div class="form-actions">
    <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('app','app.kategori.menu.buat') : Yii::t('app','app.kategori.menu.simpan'),array(
                'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
            )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->