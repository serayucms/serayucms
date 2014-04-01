<?php
/* @var $this KategoriController */
/* @var $model Kategori */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_kategori',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'nama_kategori',array('span'=>5,'maxlength'=>128)); ?>

                    <?php echo $form->textAreaControlGroup($model,'keterangan_kategori',array('rows'=>6,'span'=>8)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id_parent',array('span'=>5)); ?>

                    <?php echo $form->textFieldControlGroup($model,'jenis',array('span'=>5,'maxlength'=>1)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->