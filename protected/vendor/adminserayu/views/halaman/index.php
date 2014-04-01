<?php
$this->judul=Yii::t('app','app.halaman');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.buat'),'url'=>array('create')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.halaman.menu.manage'),'url'=>array('admin')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.halaman.menu.daftar') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_list',
                'template'=>"{items}\n{pager}",
        )); ?>
    </div>
</div>

