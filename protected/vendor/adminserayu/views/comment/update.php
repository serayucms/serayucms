<?php
$this->judul=Yii::t('app','app.komentar');
$this->menu=array(
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.komentar.menu.pending'),'url'=>array('comment/index/pending')),
	array('label'=>'<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.komentar.menu.semua'),'url'=>array('comment/index')),
);
?>
<div class="box">
    <div class="box-body">
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>
