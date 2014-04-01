<?php
$this->pageTitle=Yii::app()->name . ' | Login';

?>

    <div class="row">
        <div class="col-md-12">
            <div class="account-wall">
                <h1 class="text-center login-title">Login Member</h1>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'login-form',
                        'htmlOptions'=>array("class"=>"form-signin"),
                        'enableAjaxValidation'=>true,
                )); ?>    
                <?php echo $form->textFieldControlGroup($model,'username'); ?>
                <?php echo $form->passwordFieldControlGroup($model,'password'); ?>
                
                <?php echo TbHtml::submitButton("Sign In",array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                            "block"=>true,
                            'size'=>  TbHtml::BUTTON_SIZE_LARGE
                    
                        )); ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <?php echo $form->checkBoxControlGroup($model,'rememberMe',array('class'=>" checkbox pull-left")); ?>
                        </div>
                        <div class="col-lg-4">
                            <a href="#" class="pull-right need-help">Need help? </a>
                        </div>
                            
                    </div>
                
                
                <span class="clearfix"></span>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        
    </div>
