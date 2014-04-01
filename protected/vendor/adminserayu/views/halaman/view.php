<?php
$this->judul=Yii::t('app','app.halaman');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.buat'), 'url'=>array('create')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.ubah'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.hapus'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Apakah anda yakin akan menghapus kategori ini?')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.manage'), 'url'=>array('admin')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.halaman.menu.lihat')." #". $model->id ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">    
    <?php $this->renderPartial('_view', array(
            'data'=>$model,
    )); ?>
    </div>
</div>
