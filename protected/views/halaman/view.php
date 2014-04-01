<div class="row">
    <div class="col-lg-12">
        <h2><?php echo CHtml::encode($data->title); ?></h2>
        <hr/>
        <?php
        $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
        echo $data->content;
        $this->endWidget();
        ?>
    </div>
</div>
