<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm'); ?>

	<?php echo $form->errorSummary($model); ?>
    
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#konten" data-toggle="tab"><?php echo Yii::t('app','app.artikel.konten') ?></a></li>
          <li><a href="#meta" data-toggle="tab">Meta Data</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding: 10px;border-left: 1px solid #EEE;border-right: 1px solid #EEE; ">
          <div class="tab-pane active" id="konten">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <?php echo $form->textFieldControlGroup($model,'title',array('size'=>80,'maxlength'=>128)); ?>
                        </div>
                        <div class="col-lg-6">
                            <?php echo $form->textFieldControlGroup($model,'parent',array('size'=>80,'maxlength'=>128)); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php echo $form->dropDownListControlGroup($model,'layout',array("coloum1"=>"1 Kolom", "coloum2"=>"2 Kolom"),array("empty"=>"Pilih Layout")); ?>
                        </div>
                        <div class="col-lg-6">
                            <?php echo $form->dropDownListControlGroup($model,'status',Lookup::items('PostStatus')); ?>
                        </div>
                    </div>
                    <?php echo $form->labelEx($model,'content'); ?>
                    <?php 
                    if(Yii::app()->params['editor']=="tinymce"):
                    $this->widget('ext.tinymce.TinyMce', array(
                        'model' => $model,
                        'attribute' => 'content',
                        'fileManager' => array(
                            'class' => 'ext.elFinder.TinyMceElFinder',
                            'connectorRoute'=>'administrator/dokumen/connector',
                        ),
                        'htmlOptions' => array(
                            'rows' => 15,
                            'cols' => 60,
                        ),
                    ));    
                    else:
                    $this->widget(
                        'ext.redactor.ImperaviRedactorWidget',array(
                            // You can either use it for model attribute
                            'model' => $model,
                            'attribute' => 'content',

                            // or just for input field
                            'htmlOptions'=>array('style'=>'height:300px'),
                            // Some options, see http://imperavi.com/redactor/docs/
                            'options' => array(
                                'iframe' => true,
                            ),
                             'plugins' => array(
                                'fullscreen' => array(
                                    'js' => array('fullscreen.js',),
                                ),
                                'textdirection' => array(
                                    'js' => array('textdirection.js',),
                                ),
                                'fontsize' => array(
                                    'js' => array('fontsize.js',),
                                ),
                                'fontcolor' => array(
                                    'js' => array('fontcolor.js',),
                                ),
                            ),
                    ));    
                    endif;
                    ?>
                    <?php echo $form->error($model,'content'); ?>

                </div>
            </div>
                
          </div>
          <div class="tab-pane" id="meta">
            <div class="row">
                  <div class="col-md-12">
                    <?php echo $form->textFieldControlGroup($model,'meta_title',array('size'=>128,'maxlength'=>128)); ?>
                    <?php echo $form->textAreaControlGroup($model,'meta_description',array('size'=>160,'maxlength'=>128)); ?>
                    <?php echo $form->textFieldControlGroup($model,'meta_keyword',array('help' =>  Yii::t('app','app.artikel.ket',array("{name}"=>"Keyword")))); ?> 
                  </div>
            </div>
          </div>
        </div>
        
        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('app','app.halaman.menu.buat') : Yii::t('app','app.halaman.menu.simpan'),array(
                    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                )); ?>
        </div>
        
        
                    
<?php $this->endWidget(); ?>

</div><!-- form -->