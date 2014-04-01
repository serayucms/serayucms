<?php
$this->judul=Yii::t('app','app.pengaturan');
?>
<div class="box box-solid box-info">
            <div class="box-header">
                <h3 class="box-title"><?php echo Yii::t('app','app.pengaturan') ?></h3>
            </div>
            <div class="box-body">
        <?php if(Yii::app()->user->hasFlash('berhasil')):?>
        <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('berhasil'); ?></div>
        <?php endif; ?>
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>
