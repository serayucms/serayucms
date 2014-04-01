<?php
$this->pageTitle=Yii::app()->name . ' | Error '.$code;
?>
<div style="text-align: center;margin-top: 300px;">
    <h2><i class="glyphicon glyphicon-info-sign"></i> Oops! Error <?php echo $code; ?></h2>

    <div class="error">
        <?php if($code == "404"): ?>
            Halaman yang Anda cari tidak dapat ditemukan. <br/>
            Mungkin Anda dapat menemukan halaman atau artikel yang Anda inginkan di bawah ini.<br/>
        <?php else: ?>
            <?php echo CHtml::encode($message); ?>
        <?php endif;?>
    </div>
</div>