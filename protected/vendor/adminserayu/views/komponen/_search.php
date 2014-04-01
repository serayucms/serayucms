<?php
/* @var $this KomponenController */
/* @var $model Komponen */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_komponen',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'pembuat_komponen',array('maxlength'=>128)); ?>

                    <?php echo $form->textAreaControlGroup($model,'keterangan_komponen',array('rows'=>6)); ?>

                    <?php echo $form->textFieldControlGroup($model,'gambar_komponen',array('maxlength'=>128)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->