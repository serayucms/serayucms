<?php
/* @var $this DetailWpController */
/* @var $model DetailWp */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_detail_wp',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_widget_posisi',array()); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_widget',array()); ?>

                    <?php echo $form->textAreaControlGroup($model,'config',array('rows'=>6)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->