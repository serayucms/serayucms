<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=  Serayu::data()->params['title'] . ' | Kontak Kami';
$this->breadcrumbs=array(
	'Kontak Kami',
);
?>

<h1>Kontak <small><?php echo Serayu::data()->params['title'] ?></small></h1>
<hr/>
<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>


<div class="row">
    <div class="col-lg-4">
    <?php
        $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
        echo Serayu::data()->params['kontakKeterangan'];
        $this->endWidget();
    ?>    
    </div>
    <div class="col-lg-8">
        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'contact-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
        )); ?>
        <?php echo $form->errorSummary($model); ?>
        <div class="row" style="border-left: 1px #EEE solid">
                <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                <?php echo $form->textFieldControlGroup($model,'name'); ?>

                <?php echo $form->textFieldControlGroup($model,'email'); ?>

                <?php echo $form->textFieldControlGroup($model,'subject',array('size'=>60,'maxlength'=>128)); ?>    
                </div>
                <div class="col-lg-6">
                <?php echo $form->textAreaControlGroup($model,'body',array('rows'=>9, 'cols'=>50)); ?>    
                </div>
            </div>
            <div class="form-actions">
                <?php if(CCaptcha::checkRequirements()): ?>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-6"><?php echo $form->labelEx($model,'verifyCode',array("style"=>'margin-right:70px;')); ?>
                        <?php $this->widget('CCaptcha',array('showRefreshButton'=>false, 'clickableImage'=>true)); ?>
                    </div>
                    <div class="col-lg-6">
                        <?php echo $form->textField($model,'verifyCode'); ?>
                        <?php echo $form->error($model,'verifyCode'); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php echo TbHtml::submitButton('Kirim Pesan',array(
                        'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        'block' =>true
                    )); ?>
            </div>    
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->

<?php endif; ?>