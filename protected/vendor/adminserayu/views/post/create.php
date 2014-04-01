<?php
$this->judul=Yii::t('app','app.artikel');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.daftar'), 'url'=>array('index')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.artikel.menu.manage'), 'url'=>array('admin')),
);
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?php echo Yii::t('app','app.artikel.menu.buat') ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>