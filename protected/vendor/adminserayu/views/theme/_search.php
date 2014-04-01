<?php
/* @var $this ThemeController */
/* @var $model Theme */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_theme',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'nama_theme',array('maxlength'=>128)); ?>

                    <?php echo $form->textFieldControlGroup($model,'gambar_theme',array('maxlength'=>128)); ?>

                    <?php echo $form->textFieldControlGroup($model,'pembuat_theme',array('maxlength'=>128)); ?>

                    <?php echo $form->textAreaControlGroup($model,'keterangan_theme',array('rows'=>6)); ?>

                    <?php echo $form->textFieldControlGroup($model,'status_theme',array('maxlength'=>1)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->