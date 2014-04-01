<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_komponen')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->nama_komponen),array('view','id'=>$data->id_komponen)); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('pembuat_komponen')); ?>:</b>
	<?php echo CHtml::encode($data->pembuat_komponen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan_komponen')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan_komponen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gambar_komponen')); ?>:</b>
	<?php echo CHtml::encode($data->gambar_komponen); ?>
	<br />

</div>