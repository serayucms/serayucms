<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="row" style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: solid #EEE 1px">
    <div class="col-lg-3" style="text-align: center">
        <?php echo CHtml::link(TbHtml::image(Yii::app()->baseUrl."/".$data->image,$data->name),array('view','id'=>$data->id),array('class'=>'thumbnail')); ?>
    </div>
    <div class="col-lg-9" style="margin-top: 10px">
	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->username),array('view','id'=>$data->id)); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('lastvisit')); ?>:</b>
	<?php echo date('F j, Y',CHtml::encode($data->lastvisit)); ?>
	<br />
	
    </div>
</div>