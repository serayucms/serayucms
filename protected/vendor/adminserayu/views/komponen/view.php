<?php
/* @var $this KomponenController */
/* @var $model Komponen */
?>

<?php
$this->breadcrumbs=array(
	'Komponens'=>array('index'),
	$model->id_komponen,
);

$this->menu=array(
	array('label'=>'Daftar Komponen', 'url'=>array('index')),
	array('label'=>'Buat Komponen', 'url'=>array('create')),
	array('label'=>'Hapus Komponen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_komponen),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Komponen', 'url'=>array('admin')),
);
?>

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Detial Komponen #<?php echo $model->id_komponen; ?></h3>
  </div>
    <div class="panel-body">
        <?php $this->widget('zii.widgets.CDetailView',array(
            'htmlOptions' => array(
                'class' => 'table table-striped table-condensed table-hover',
            ),
            'data'=>$model,
            'attributes'=>array(
                        'nama_komponen',
                        'pembuat_komponen',
                        'keterangan_komponen',
                        'gambar_komponen',
                ),
        )); ?>
    </div>
</div>
