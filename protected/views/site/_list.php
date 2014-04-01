<div class="row">
    <div class="col-lg-12">
        <h2><?php echo CHtml::link(CHtml::encode($data->title),$data->url); ?></h2>
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
        <?php preg_match('#(<img.*?>)#', $data->content, $results); ?>
        <?php if(count($results) == 0) : ?>
        <div class="col-md-12 contentHome">
            <?php
            echo substr(strip_tags($data->content), 0, 400);
            ?>
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8">
                    <b>Tags:</b>
                    <?php echo implode(', ', $data->tagLinks); ?>
                    <br/>
                    <?php echo CHtml::link('Permalink', $data->url); ?> |
                    <?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
                    Last updated on <?php echo date('F j, Y',$data->update_time); ?>
                </div>
                <div class="col-md-4">
                    <div class="selengkapnya pull-right"><?php echo TbHtml::link('Baca Selengkapnya',$data->url,array('color' => TbHtml::BUTTON_COLOR_DEFAULT,"class"=>"btn btn-success")); ?></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr/>
        </div>
        <?php else: ?>
        <div class="col-md-4">
            <?php
            preg_match('#(src=".*?")#', $data->content, $src_tmp);
            $src = explode("\"", $src_tmp[0]);
            echo CHtml::image($src[1],"",array("class"=>"thumbnail"));  
            ?>
        </div>
        <div class="col-md-8 contentHome">
            <?php
            echo substr(strip_tags($data->content), 0, 200);
            ?>
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8">
                    <b>Tags:</b>
                    <?php echo implode(', ', $data->tagLinks); ?>
                    <br/>
                    <?php echo CHtml::link('Permalink', $data->url); ?> |
                    <?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?><br/>
                    Last updated on <?php echo date('F j, Y',$data->update_time); ?>
                </div>
                <div class="col-md-4" style="padding-top: 20px">
                    <div class="selengkapnya pull-right"><?php echo TbHtml::link('Baca Selengkapnya',$data->url,array('color' => TbHtml::BUTTON_COLOR_DEFAULT,"class"=>"btn btn-success")); ?></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr/>
        </div>
        <?php endif; ?>
    </div>
</div>
