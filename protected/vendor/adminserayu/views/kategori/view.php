<?php
/* @var $this KategoriController */
/* @var $model Kategori */
?>

<?php
$this->judul=Yii::t('app','app.kategori');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.buat'), 'url'=>array('create')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.ubah'), 'url'=>array('update', 'id'=>$model->id_kategori)),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.hapus'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_kategori),'confirm'=>'Apakah anda yakin akan menghapus kategori ini?')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.kategori.menu.manage'), 'url'=>array('admin')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.kategori.menu.lihat')." #". $model->id_kategori ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php $this->widget('zii.widgets.CDetailView',array(
        'htmlOptions' => array(
            'class' => 'table table-striped table-condensed table-hover',
        ),
        'data'=>$model,
        'attributes'=>array(
                    'id_kategori',
                    'nama_kategori',
                    'id_parent',
                    'alias_kategori',
                    'keterangan_kategori',
            ),
    )); ?>
    </div>
</div>