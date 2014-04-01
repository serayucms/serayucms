<div class="row">
    <div class="col-lg-12">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'comment-form',
            'enableAjaxValidation'=>false,
    )); ?>

            <?php echo $form->textFieldControlGroup($model,'author',array('size'=>60,'maxlength'=>128)); ?>
        
            <div class="row">
                <div class="col-lg-6">
                    <?php echo $form->textFieldControlGroup($model,'email',array('size'=>60,'maxlength'=>128)); ?>
                </div>
                <div class="col-lg-6">
                    <?php echo $form->textFieldControlGroup($model,'url',array('size'=>60,'maxlength'=>128)); ?>
                </div>
            </div>
            
            <?php echo $form->textAreaControlGroup($model,'content',array('rows'=>6, 'cols'=>50)); ?>

            <div class="form-actions">
                    <?php echo TbHtml::submitButton(Yii::t('app','app.komentar.menu.simpan'),array(
                        'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                    )); ?>
            </div>

    <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->