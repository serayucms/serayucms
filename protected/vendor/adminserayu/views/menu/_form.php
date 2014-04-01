<?php
/* @var $this MenuController */
/* @var $model Menu */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'menu-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    
    <?php echo $form->errorSummary($model); ?>


            <?php echo $form->textFieldControlGroup($model,'label',array('span'=>5,'maxlength'=>256)); ?>
            <?php
                if($model->isNewRecord){
                  echo $form->hiddenField($model, 'id_menu_parent', array("value"=>$_GET["id"]))  ;
                }else{
                  echo $form->hiddenField($model, 'id_menu_parent')  ;
                }
            ?>
            <?php echo $form->dropDownListControlGroup($model, 'parent_id', CHtml::listData(Menu::model()->findAll(), 'id', 'label'), array('empty' => 'Menu Utama')); ?>
            
            <?php echo $form->textFieldControlGroup($model,'url',array('span'=>5,'maxlength'=>256,
                                                                        'value'=>$model->tampilMenuUrl(),
                                                                        'append' => '<a href="#" data-toggle="modal" data-target=".bs-modal-lg">Pilih Url</a>'
                                                                    )); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		)); ?>
        </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Default</a></li>
        <li><a href="#messages" data-toggle="tab">Halaman</a></li>
        <li><a href="#settings" data-toggle="tab">Kategori</a></li>
        <li><a href="#komPte" data-toggle="tab">Komponen</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="home">
            <table class="table table-bordered">
                <thead>
                    <thead>
                        <tr>
                          <th style="width: 50px;">
                            #
                          </th>
                          <th>
                            Halaman
                          </th>
                          <th style="width: 50px;">
                            &nbsp;
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Beranda</td>
                          <td><a href="#" id="<?php echo "site/index" ?>" onclick="pilihUrl(this);return false;" class="btn btn-primary" data-dismiss="modal">Pilih</a></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Blog</td>
                          <td><a href="#" id="<?php echo "artikel/index" ?>" onclick="pilihUrl(this);return false;" class="btn btn-primary" data-dismiss="modal">Pilih</a></td>
                        </tr>
                        <tr >
                          <td>3</td>
                          <td>Kontak</td>
                          <td><a href="#" id="<?php echo "site/contact" ?>" onclick="pilihUrl(this);return false;" class="btn btn-primary" data-dismiss="modal">Pilih</a></td>
                        </tr>
                      </tbody>
                </thead>
            </table>
        </div>
        <div class="tab-pane" id="messages">
            <table class="table table-bordered">
                <thead>
                    <thead>
                        <tr>
                          <th style="width: 50px;">
                            #
                          </th>
                          <th>
                            Halaman
                          </th>
                          <th style="width: 50px;">
                            &nbsp;
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($halaman as $value): ?>
                        <tr>
                          <td><?php echo $value->id ?></td>
                          <td><?php echo $value->title ?></td>
                          <td><a href="#" name="halaman" id="<?php echo "halaman/view/alias/".$value->slug ?>" onclick="pilihUrl(this);return false;" class="btn btn-primary" data-dismiss="modal">Pilih</a></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                </thead>
            </table>
        </div>
        <div class="tab-pane" id="settings">
            <table class="table table-bordered">
                <thead>
                    <thead>
                        <tr>
                          <th style="width: 50px;">
                            #
                          </th>
                          <th>
                            Kategori
                          </th>
                          <th style="width: 50px;">
                              &nbsp;
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($kategori as $data): ?>
                        <tr>
                          <td><?php echo $data->id_kategori ?></td>
                          <td><?php echo $data->nama_kategori ?></td>
                          <td><a href="#" id="<?php echo "artikel/index/kategori/".$data->alias_kategori ?>" onclick="pilihUrl(this);return false;" class="btn btn-primary" data-dismiss="modal">Pilih</a></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                </thead>
            </table>
        </div>
        <div class="tab-pane" id="komPte">
            <table class="table table-bordered">
                <thead>
                    <thead>
                        <tr>
                          <th style="width: 50px;">
                            #
                          </th>
                          <th>
                            Komponen
                          </th>
                          <th style="width: 50px;">
                              &nbsp;
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($komponen as $data): ?>
                        <tr>
                          <td><?php echo $data->id_komponen ?></td>
                          <td><?php echo $data->nama_komponen ?></td>
                          <td><a href="#" id="sk/<?php echo $data->nama_komponen."/index" ?>" onclick="pilihUrl(this);return false;" class="btn btn-primary" data-dismiss="modal">Pilih</a></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                </thead>
            </table>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php Yii::app()->clientScript->registerScript('pilihUrl', <<<JS
    function pilihUrl(pil){
        $("#Menu_url").val(pil.id) ;
    }
JS
, CClientScript::POS_END);?>


