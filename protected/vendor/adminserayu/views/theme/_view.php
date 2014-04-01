<?php
/* @var $this ThemeController */
/* @var $data Theme */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id_theme')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_theme),array('view','id'=>$data->id_theme)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_theme')); ?>:</b>
	<?php echo CHtml::encode($data->nama_theme); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gambar_theme')); ?>:</b>
	<?php echo CHtml::encode($data->gambar_theme); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pembuat_theme')); ?>:</b>
	<?php echo CHtml::encode($data->pembuat_theme); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan_theme')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan_theme); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_theme')); ?>:</b>
	<?php echo CHtml::encode($data->status_theme); ?>
	<br />


</div>