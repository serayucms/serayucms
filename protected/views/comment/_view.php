<?php foreach($comments as $comment): ?>
<div class="row" style="border: 1px solid #EEE;padding: 10px 0 10px 0">
    <div class="col-lg-12">
        <div class="row" style="padding: 10px; border-bottom: 1px solid #EEE;margin-bottom: 10px" >
            <div class="col-md-8">
                <?php echo $comment->authorLink; ?> says:
            </div>
            <div class="col-md-4 ">
                <?php echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array(
                        'class'=>'pull-right',
                        'title'=>'Permalink to this comment',
                        'style'=>"font-size:20px",
                )); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo date('F j, Y \a\t h:i a',$comment->create_time); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php echo nl2br(CHtml::encode($comment->content)); ?>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>