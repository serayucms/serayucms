<div class="<?php echo $this->class ?>">
<h3><?php echo $this->title ?></h3>
<ul class="list-group">
<?php foreach ($this->findAllCategory() as $val): ?>
    <li class="list-group-item">
    <?php 
    echo CHtml::link($val->nama_kategori, Yii::app()->createUrl("artikel/index",array("kategori"=>$val->alias_kategori)))
    ?>
    </li>
<?php endforeach; ?>
</ul>
</div>