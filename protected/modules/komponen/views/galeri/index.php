<?php
/* @var $this GaleriController */

$this->breadcrumbs=array(
	'Galeri',
);
Serayu::registerCss($this->module->getAssetsUrl("galeri").'/css/galeriStyle.css')
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<div class="back">
 <?php echo CHtml::link(
                 CHtml::image($this->module->getAssetsUrl("galeri").'/image/testGaleri.png'),
                 array('/xxii')); ?>
</div>
