<?php
$this->judul=Yii::t('app','app.theme');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.theme.menu.install'), 'url'=>array('create')),
);
?>
<?php if(isset($theme)): ?>
<div class="row">
    <div class="col-md-12">
        <!-- Success box -->
        <div class="box box-solid box-info">
            <div class="box-header">
                <h3 class="box-title">Active Theme</h3>
            </div>
            <div class="box-body">
                <div class="row">
                <div class="col-md-4">
                    <?php echo CHtml::image(Yii::app()->baseUrl."/themes/".$theme->nama_theme."/".$theme->gambar_theme,$theme->nama_theme, array("class"=>"img-thumbnail", "style"=>"width:100%")); ?>
                </div>
                <div class="col-md-8">
                    <h3><?php echo ucfirst($theme->nama_theme); ?><small><?php echo " by ". $theme->pembuat_theme; ?></small> </h3>
                    <hr/>
                    <div class="row">
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua" style="text-align: center">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $jmlLayout ?>
                                        </h3>
                                        <p>
                                            Layout
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">
                                        More info <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div><!-- ./col -->
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green" style="text-align: center">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $jmlWP ?>
                                        </h3>
                                        <p>
                                            Widget posisi
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">
                                        More info <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div><!-- ./col -->
                            <div class="col-lg-4 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow" style="text-align: center">
                                    <div class="inner">
                                        <h3>
                                            <?php echo $jmlW ?>
                                        </h3>
                                        <p>
                                            Include File
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">
                                        More info <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div><!-- ./col -->
                        </div><!-- /.row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-primary btn-lg btn-block">Documentation</button>
                            </div>
                            <div class="col-lg-6">
                                <?php 
                                    echo CHtml::link("Configuration",
                                    array("theme/view/id/".$theme->id_theme), 
                                    array('class'=>'btn btn-primary btn-lg btn-block')) 
                                ?>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-lg-6">
                                <?php echo CHtml::button('Delete Theme',
                                        array(
                                        'submit'=>array('theme/delete','id'=>$theme->id_theme),
                                        'confirm' => 'Are you sure?',
                                            'class'=>'btn btn-primary btn-lg btn-block'));
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?php 
                                    echo CHtml::link("Deactive Theme",
                                    array("theme/aktifkanTheme/id/".$theme->id_theme), 
                                    array('class'=>'btn btn-primary btn-lg btn-block')) 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>
<?php endif; ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.theme.menu.manage') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
            'id'=>'theme-grid',
            'dataProvider'=>$model->search(),
            'htmlOptions'=>array("class"=>"table table-hover"),
            'type' => TbHtml::GRID_TYPE_BORDERED,
            'filter'=>$model,
            'columns'=>array(
                    
                    'nama_theme',
                    'pembuat_theme',
                    array(
                        "header" => "Status",
                        "name" => "status_theme",
                        'type'=>'html',
                        'filter'=>false,
                        "value" => '$data->status_theme == "0" ? TbHtml::icon("remove-sign",array("rel"=>"tooltip","title"=>"Aktifkan","href"=>Yii::app()->createUrl(Yii::app()->controller->module->id."/theme/aktifkanTheme",array("id"=>$data->id_theme)) ),"a") : TbHtml::icon("ok-sign")  ',
                        'htmlOptions'=>array("style"=>"text-align:center;width:80px"),
                    ),
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'htmlOptions'=>array("style"=>"width:70px"),
                            'template' => '{view} | {delete}',
                    ),
            ),
    )); ?>

  </div>
</div>