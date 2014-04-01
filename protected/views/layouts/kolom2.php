<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div class="col-lg-8">
            <?php echo $content; ?>
	</div>
	<div class="col-lg-4">
            <?php $this->widget('serayuWidget.Swkategori.Swkategori', array(
                    'title'=>'Kategori'
            )); ?>
	</div>
</div>
<?php $this->endContent(); ?>