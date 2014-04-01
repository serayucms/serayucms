<?php
/* @var $this WidgetController */
/* @var $data Widget */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id_widget')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_widget),array('view','id'=>$data->id_widget)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_widget')); ?>:</b>
	<?php echo CHtml::encode($data->nama_widget); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />


</div>