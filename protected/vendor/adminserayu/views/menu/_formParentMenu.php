<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'menu-parent-form',
	'enableAjaxValidation'=>false,
)); ?>

    
    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <div class="col-lg-8">
            <?php echo $form->textField($model,'name'); ?>
        </div>
        <div class="col-lg-4">
            <?php echo TbHtml::submitButton("Tambah",array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY));
                    ?>
        </div>
    </div>
    
        
    <?php $this->endWidget(); ?>

</div><!-- form -->