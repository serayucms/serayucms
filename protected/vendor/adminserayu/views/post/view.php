<?php
$this->judul=Yii::t('app','app.artikel');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.buat'), 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess("buatArtikel")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.ubah'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.hapus'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Apakah anda yang akan menghapus artikel ini?'),'visible'=>Yii::app()->user->checkAccess("admin")),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.manage'), 'url'=>array('admin')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.artikel.menu.lihat') ?> #<?php echo $model->id; ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->renderPartial('_view', array(
            'data'=>$model,
    )); ?>
    </div>
</div>
