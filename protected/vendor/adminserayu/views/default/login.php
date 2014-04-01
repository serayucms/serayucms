<div class="row-fluid">
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4 login">
        <div class="logo"  >
            <?php // echo CHtml::image(Yii::app()->baseUrl."/images/logo.png", "Serayu CMS") ?>
        </div>
        <div class="row">
        <div class="page-header"><h2><?php echo Yii::app()->name ?> </h2></div>
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'layout' => TbHtml::FORM_LAYOUT_VERTICAL,
        )); ?>
        <div class="body" style="margin-top: -20px;">
            <?php echo $form->textFieldControlGroup($model, 'username', array("placeholder"=>"Username")); ?>
            <?php echo $form->passwordFieldControlGroup($model, 'password', array("placeholder"=>"Paswword")); ?>
        </div>
        <div class="footer">
            <?php echo TbHtml::submitButton('Login', array('color' => TbHtml::BUTTON_COLOR_SUCCESS,"block"=>true, 'class'=>'btn-lg', 'style'=>'margin-bottom:20px')); ?>
        </div>
            

        <?php $this->endWidget(); ?>
        </div>
    </div>
    <div class="col-md-4">
        
    </div>
</div>
<div class="clearfix"></div>
<div class="row-fluid">
    <div class="col-md-12" style="color: #fff; text-align: center;margin-top: 20px;">
        Copyright &copy; 2014 <?php echo Yii::app()->name ?><br/>
        All Right Reserved
    </div>
</div>
