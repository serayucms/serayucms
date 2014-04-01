<div class="row">
    <div class="col-lg-12">
        <h2><?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?></h2>
        <div class="row" style="padding: 10px; margin-bottom: 10px;border-bottom: 1px solid #EEE;border-top: 1px solid #EEE;">
            <div class="col-lg-4" style="border-right: solid 1px #EEE">
                posted by <?php echo $data->author->username ?>
            </div>
            <div class="col-lg-4">
                <?php echo $data->idKategori->nama_kategori ?>
            </div>
            <div class="col-lg-4">
                <?php echo date('F j, Y',$data->create_time); ?>
            </div>
        </div>
        
        <?php
        $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
        echo $data->content;
        $this->endWidget();
        ?>
        
        <b>Tags:</b>
        <?php echo implode(', ', $data->tagLinks); ?>
        <br/>
        <?php echo CHtml::link('Permalink', $data->url); ?> |
        <?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
        Last updated on <?php echo date('F j, Y',$data->update_time); ?>
        
    </div>
</div>
