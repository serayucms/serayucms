<?php
$this->judul=Yii::t('app','app.theme');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.theme.menu.install'), 'url'=>array('create')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.theme.menu.hapus'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_theme),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.theme.menu.manage'), 'url'=>array('admin')),
);
?>

<div class="box box-solid box-info">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($model->nama_theme); ?> Theme</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="row">
          <div class="col-md-5">
              <?php echo CHtml::image(Yii::app()->baseUrl."/themes/".$model->nama_theme."/".$model->gambar_theme,$model->nama_theme, array("class"=>"img-thumbnail", "style"=>"width:100%")); ?>
              <?php $this->widget('zii.widgets.CDetailView',array(
                    'htmlOptions' => array(
                        'class' => 'table table-striped table-condensed table-hover',
                    ),
                    'data'=>$model,
                    'attributes'=>array(
                                'nama_theme',
                                'pembuat_theme',
                                array(               
                                    'label'=>'Status',
                                    'type'=>'raw',
                                    'value'=>$model->status_theme == 0 ? TbHtml::icon("remove-sign") : TbHtml::icon("ok-sign"),
                                ),
                        ),
                )); ?>
          </div>
          <div class="col-md-7">
              <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#layout" data-toggle="tab">Layout</a></li>
                  <li><a href="#file" data-toggle="tab">File</a></li>
                  <li><a href="#dokumentasi" data-toggle="tab">Documentation</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="layout">
                    <?php foreach ($layout as $data): ?>
                    <div class="panel-group" id="layoutTheme">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#layoutTheme" href="#<?php echo $data->id; ?>">
                                <?php echo $data->name; ?>
                              </a>
                            </h4>
                          </div>
                          <div id="<?php echo $data->id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                              <table class="table table-bordered">
                                    <thead>
                                        <thead>
                                            <tr>
                                              <th>
                                                Widget Posisi
                                              </th>
                                              <th style="width: 50px;">
                                                  &nbsp;
                                              </th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php foreach ($widget->findAll("id_layouts = :layout",array(":layout"=>$data->id)) as $data1): ?>
                                            <tr>
                                              <td><?php echo $data1->nama_wp ?></td>
                                              <td>
                                                  <a href="
                                                        <?php 
                                                            echo Yii::app()->createUrl($this->module->id."/detailWp/admin", 
                                                            array("theme"=>$model->id_theme,"widget"=>$data1->id_wp)) 
                                                        ?>" 
                                                        class="btn btn-primary btn-sm" 
                                                        data-dismiss="modal">
                                                    Edit
                                                  </a>
                                              </td>
                                            </tr>
                                            <?php endforeach; ?>
                                          </tbody>
                                    </thead>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="tab-pane" id="file">
                      <h3>Layout File</h3>
                      <table class="table table-bordered">
                            <thead>
                                <thead>
                                    <tr>
                                      <th>
                                       Name
                                      </th>
                                      <th>
                                       File Name
                                      </th>
                                      <th style="width: 50px;">
                                          &nbsp;
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($layout as $data2): ?>
                                    <tr>
                                      <td><?php echo $data2->name ?></td>
                                      <td><?php echo $data2->file_name ?></td>
                                      <td>
                                          <a href="
                                                <?php 
                                                    echo Yii::app()->createUrl($this->module->id."/theme/layout", 
                                                    array("theme"=>$model->id_theme,"layout"=>$data2->id)) 
                                                ?>" 
                                                class="btn btn-primary btn-sm" 
                                                data-dismiss="modal">
                                            Edit
                                          </a>
                                      </td>
                                    </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                        </table>
                      <h3>Css File</h3>
                      <table class="table table-bordered">
                            <thead>
                                <thead>
                                    <tr>
                                      <th>
                                       Name
                                      </th>
                                      <th>
                                       File Name
                                      </th>
                                      <th style="width: 50px;">
                                          &nbsp;
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($cssFile as $css): ?>
                                    <tr>
                                      <td><?php echo $css->name ?></td>
                                      <td><?php echo $css->file_name ?></td>
                                      <td>
                                          <a href="
                                                <?php 
                                                    echo Yii::app()->createUrl($this->module->id."/theme/layout", 
                                                    array("theme"=>$model->id_theme,"layout"=>$css->id)) 
                                                ?>" 
                                                class="btn btn-primary btn-sm" 
                                                data-dismiss="modal">
                                            Edit
                                          </a>
                                      </td>
                                    </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                        </table>
                  </div>
                  <div class="tab-pane" id="dokumentasi">
                      <?php echo $model->keterangan_theme ?>
                  </div>
                </div>
              
          </div>
      </div>

  </div>
</div>