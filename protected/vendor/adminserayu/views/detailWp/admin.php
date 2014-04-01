<?php
$this->judul=Yii::t('app','app.theme');

$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t("app",'app.menu.menu.kembali'), 'url'=>Yii::app()->createUrl($this->module->id."/theme/view",array("id"=>$theme))),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t("app",'app.theme.menu.pasangWidget'),  'url'=>"#", 'linkOptions'=>array("data-toggle"=>"modal","data-target"=>"#myModal")),
);

?>

<div class="box box-solid box-info">
            <div class="box-header">
                <h3 class="box-title">Manag Widget</h3>
            </div>
            <div class="box-body">
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'detail-wp-grid',
	'dataProvider'=>$model->searchBy($widget),
        'type' => TbHtml::GRID_TYPE_BORDERED,
	'filter'=>$model,
	'columns'=>array(
                array(
                    "header"=>"#",
                    "name"=>"id_detail_wp",
                    "value"=>'$data->id_detail_wp',
                    "htmlOptions"=>array("style"=>"width:50px"),
                ),
		'idWidget.nama_widget',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{ubah} | {delete}',
                        'buttons'=>array
                                        (
                                            'ubah' => array
                                            (
                                                'label'=>'Edit',
                                                'url'=>'Yii::app()->createUrl(Yii::app()->controller->module->id."/detailWp/update", array("id"=>$data->id_detail_wp,"wd"=>$data->id_widget,"widget"=>$data->id_widget_posisi,"theme"=>'.$theme.'))',
                                            ),
                                        ),
		),
	),
)); ?>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo Yii::t("app",'app.theme.ket.pasangWidget') ?></h4>
      </div>
      <div class="modal-body">
          <table class="table table-bordered">
            <thead>
                <thead>
                    <tr>
                      <th>
                        Widget
                      </th>
                      <th style="width: 50px;">
                          &nbsp;
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($wd as $data): ?>
                    <tr>
                      <td><?php echo $data->nama_widget ?></td>
                      <td><a href="<?php echo Yii::app()->createUrl($this->module->id."/detailWp/create", array("theme"=>$theme,"widget"=>$widget,"wd"=>$data->id_widget)) ?>" class="btn btn-primary" ><?php echo Yii::t("app",'app.theme.menu.pasangWidget') ?></a></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
            </thead>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->