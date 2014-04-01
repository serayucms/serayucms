<?php
/* @var $this ConfigFormController */
/* @var $model ConfigForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'config-form-index-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <?php echo $form->errorSummary($model); ?>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Global</a></li>
                <li><a href="#artikel" data-toggle="tab"><?php echo Yii::t("app",'app.artikel') ?></a></li>
                <li><a href="#perbaikan" data-toggle="tab"><?php echo Yii::t("app",'model.pengaturan.mPaktif') ?></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="padding: 10px;border-left: 1px solid #EEE;border-right: 1px solid #EEE; ">
              <!-- Pengaturan Global -->  
              <div class="tab-pane active" id="home">
                  <div class="row">
                      <div class="col-lg-12">
                            <?php echo $form->textFieldControlGroup($model,'title',array('span'=>5)); ?>
                            <?php echo $form->textFieldControlGroup($model,'adminEmail',array('span'=>5)); ?>  
                            <?php echo $form->dropDownListControlGroup($model,'bahasa',array("id"=>"Indonesia","en"=>"English"),array('span'=>5)); ?>    
                            <div class="clearfix"></div>
                            <?php echo $form->label($model,'kontakKeterangan'); ?>  
                            <?php $this->widget(
                                    'ext.redactor.ImperaviRedactorWidget',array(
                                        // You can either use it for model attribute
                                        'model' => $model,
                                        'attribute' => 'kontakKeterangan',

                                        // or just for input field
                                        'htmlOptions'=>array('style'=>'height:400px'),
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
                            ?>
                      </div>
                  </div>
              </div>
              <!-- Pengaturan Artikel -->  
              <div class="tab-pane" id="artikel">
                  <div class="row">
                      <div class="col-lg-12">
                          <!---
                          <div class="onoffswitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <div class="onoffswitch-inner">
                                    <div class="onoffswitch-active"><div class="onoffswitch-switch">True</div></div>
                                    <div class="onoffswitch-inactive"><div class="onoffswitch-switch">False</div></div>
                                </div>
                            </label>
                        </div>
                          ----->
                        <?php echo $form->textFieldControlGroup($model,'postsPerPage',array('span'=>5)); ?>
                        <?php echo $form->dropDownListControlGroup($model,'editor',array("redactor"=>"Redactor","tinymce"=>"TinyMCE"),array('span'=>5)); ?>
                        <?php echo $form->dropDownListControlGroup($model,'artikelTerkait',array("1"=>Yii::t("app",'app.pengaturan.ket.tampilan'),"0"=>Yii::t("app",'app.pengaturan.ket.tidakTampilkan')),array('span'=>5)); ?>
                        <?php echo $form->dropDownListControlGroup($model,'profilePembuat',array("1"=>Yii::t("app",'app.pengaturan.ket.tampilan'),"0"=>Yii::t("app",'app.pengaturan.ket.tidakTampilkan')),array('span'=>5)); ?>    
                        <?php echo $form->dropDownListControlGroup($model,'commentNeedApproval',array(true=>Yii::t("app",'app.pengaturan.ket.true'),false=>Yii::t("app",'app.pengaturan.ket.false')),array('span'=>5)); ?>    
                        <?php echo $form->dropDownListControlGroup($model,'layoutArtikel',
                                array(
                                    'kolom1'=>"1 Kolom",
                                    'kolom2'=>"2 Kolom",
                                    'kolom3'=>"3 Kolom",
                                    ),
                                array(
                                    'span'=>5
                                    )
                                ); ?>    
                      </div>
                  </div>
              </div>
              <!-- Pengaturan Mode Perbaikan -->  
              <div class="tab-pane" id="perbaikan">
                  <div class="row">
                      <div class="col-lg-12">
                            <?php echo $form->dropDownListControlGroup($model,'mPaktif',array("0"=>Yii::t("app",'app.pengaturan.ket.tidakAktif'),"1"=>Yii::t("app",'app.pengaturan.ket.aktif')),array('span'=>5)); ?>
                            <div class="clearfix"></div>
                            <?php echo $form->label($model,'keteranganPerbaikan'); ?>  
                            <?php $this->widget(
                                    'ext.redactor.ImperaviRedactorWidget',array(
                                        // You can either use it for model attribute
                                        'model' => $model,
                                        'attribute' => 'keteranganPerbaikan',

                                        // or just for input field
                                        'htmlOptions'=>array('style'=>'height:400px'),
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
                            ?>
                      </div>
                  </div>
              </div>
            </div>
            
            <div class="form-actions">
                <?php echo TbHtml::submitButton(Yii::t("app",'app.pengaturan.menu.simpan'),array(
                            'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                        )); ?>
            </div>
	

<?php $this->endWidget(); ?>
           
</div><!-- form -->