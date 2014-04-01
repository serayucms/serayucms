<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-lg-3" style="text-align: center; ">
            <?php if($model->isNewRecord): ?>
                <?php echo $form->fileFieldControlGroup($model, 'image'); ?>
            <?php else:?>    
                <?php echo CHtml::image(Yii::app()->baseUrl."/".$model->image,$model->name,array('class'=>'thumbnail','style'=>'display: block; margin-left: auto;margin-right: auto')) ?><br/>
                
                <?php echo $form->fileField($model, 'image_update',array("style"=>"display:none")); ?>
                <input type="text" disabled="disabled" placeholder="<?php echo $model->image ?>" id="file" class="form-control">
                <div class="input-group" style="margin-top: 20px">
                    <div class="input-group-btn">
                      <button type="button" onclick="$('input[id=User_image_update]').click();" class="btn btn-default">Pilih Foto Profile</button>
                    </div><!-- /btn-group -->
                </div><!-- /input-group -->
                <?php echo TbHtml::button("Ganti Password", array("style"=>"margin-top:40px", "class"=>"btn btn-succes btn-primary", "data-toggle"=>"modal", "data-target"=>"#passwordChange")) ?>
                <br/>Login Terakhir <br/>
                <?php echo date('F j, Y',$model->lastvisit); ?>
            <?php endif; ?>
        </div>
        <div class="col-lg-9">
            <?php if($model->isNewRecord): ?>
            <div class="row">            
                <div class="col-lg-6">
                    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>128)); ?>
                </div>
                <div class="col-lg-6">
                    <?php echo $form->passwordFieldControlGroup($model,'password',array('maxlength'=>128)); ?>
                </div>
            </div>
            <?php else: ?>
            <div class="row">            
                <div class="col-lg-12">
                    <?php echo $form->textFieldControlGroup($model,'username',array('maxlength'=>128)); ?>
                </div>
            </div>
            <?php endif; ?>
            <?php echo $form->textFieldControlGroup($model,'email',array('maxlength'=>128)); ?>

            <?php echo $form->textFieldControlGroup($model,'name',array('maxlength'=>128)); ?>
            
            <?php if(Yii::app()->user->checkAccess("admin")): ?>
            <?php echo $form->hiddenField($model,'tmp_level',array('maxlength'=>6,'value'=>$model->level)); ?>

            <?php echo $form->dropDownListControlGroup($model, 'level', array('member'=>"Member", 'editor'=>"Editor", 'author'=>"Penulis", 'admin'=>"Admin"), array('empty' => 'Pilih Level ....')); ?>
            <?php endif; ?>
            
            <?php echo $form->textAreaControlGroup($model,'profile',array('rows'=>6)); ?>
            
            <div class="form-actions">
            <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
                        'color'=>TbHtml::BUTTON_COLOR_PRIMARY,		    
                    )); ?>
            </div>
            <div class="modal fade" id="passwordChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                      <?php echo $form->passwordFieldControlGroup($model,'new_password',array('maxlength'=>128)); ?>
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
                                    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,		    
                                )); ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<?php Yii::app()->clientScript->registerScript('pilihFile', <<<JS
    $('input[id=User_image_update]').change(function() {
        $('#file').val($(this).val());
    });
JS
, CClientScript::POS_READY);?>
