<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->params['title'] . ' - Perbaikan';
?>
<div class="row">
    <div class="col-lg-2">
        
    </div>
    <div class="col-lg-8" style="text-align: center">
        <h1><?php echo Yii::app()->params['title'] ?></h1>
        <?php
        $CHtmlPurifier = new CHtmlPurifier();
        echo $CHtmlPurifier->purify($pesan);
         ?>
    </div>
    <div class="col-lg-2">
        
    </div>
</div>

