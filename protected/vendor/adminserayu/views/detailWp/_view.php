<?php
/* @var $this DetailWpController */
/* @var $data DetailWp */
?>

<div class="view">

    	<b><?php echo CHtml::encode($data->getAttributeLabel('id_detail_wp')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_detail_wp),array('view','id'=>$data->id_detail_wp)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_widget_posisi')); ?>:</b>
	<?php echo CHtml::encode($data->id_widget_posisi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_widget')); ?>:</b>
	<?php echo CHtml::encode($data->id_widget); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('config')); ?>:</b>
	<?php echo CHtml::encode($data->config); ?>
	<br />


</div>