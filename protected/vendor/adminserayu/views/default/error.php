<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div class="error jumbotron " style="text-align: center;border: solid #EEE;background: transparent">
    <h1>Error <small><?php echo $code; ?></small></h1>
<?php echo CHtml::encode($message); ?><br/>
    <?php echo TbHtml::link("Kembali Ke Beranda", Yii::app()->baseUrl."/".$this->module->id, array("class"=>"btn btn-success")) ?>
</div>