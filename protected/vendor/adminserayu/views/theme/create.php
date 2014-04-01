<?php
$this->judul=Yii::t('app','app.theme');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.theme.menu.manage'), 'url'=>array('admin')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.theme.menu.install'); ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php if(Yii::app()->user->hasFlash('berhasil')): ?> 
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('berhasil'); ?>
    </div>
    <?php endif; ?>  
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    <?php if(isset($theme)): ?>  
      <br/>
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">Detail Theme #<?php echo ucfirst($theme->nama_theme); ?></h3>
        </div>
        <div class="panel-body">
           <div class="row">
                <div class="col-md-4">
                    <?php echo CHtml::image($theme->gambar_theme,$theme->nama_theme,array("class"=>"img img-thumbnail img-responsive")); ?>
                </div>
                <div class="col-md-8">
                    <h3><?php echo ucfirst($theme->nama_theme); ?><small><?php echo " by ". $theme->pembuat_theme; ?></small></h3>
                    <hr/>
                    <?php echo $theme->keterangan_theme; ?>
                </div>
            </div>
        </div>
      </div>
     
    <?php endif; ?>
  </div>
</div>