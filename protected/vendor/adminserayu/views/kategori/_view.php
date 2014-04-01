<?php
/* @var $this KategoriController */
/* @var $data Kategori */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_kategori')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->nama_kategori),array('view','id'=>$data->id_kategori)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan_kategori')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan_kategori); ?>
	<br />

</div>
<hr/>