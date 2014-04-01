<?php
$deleteJS = <<<DEL
$('.container').on('click','.time a.delete',function() {
	var th=$(this),
		container=th.closest('div.comment'),
		id=container.attr('id').slice(1);
	if(confirm('Are you sure you want to delete comment #'+id+'?')) {
		$.ajax({
			url:th.attr('href'),
			type:'POST'
		}).done(function(){container.slideUp()});
	}
	return false;
});
DEL;
Yii::app()->getClientScript()->registerScript('delete', $deleteJS);
?>
<div class="row" id="c<?php echo $data->id; ?>" style="border: 1px solid #EEE;padding: 10px;">
    <div class="col-lg-12">
        <div class="row" style="border-bottom: 1px solid #EEE; padding: 10px">
            <div class="col-lg-6" style="padding: 5px">
                <?php echo CHtml::link("#{$data->id}", $data->url, array(
                        'class'=>'cid',
                        'title'=>'Permalink to this comment',
                )); ?>


                        "<?php echo $data->authorLink; ?>" Komen di
                        <?php echo CHtml::link(CHtml::encode($data->post->title), $data->post->url); ?>

            </div>
            <div class="col-lg-6" >
                <div class="time pull-right">
                        <?php echo date('F j, Y \a\t h:i a',$data->create_time); ?> |
                        <?php if($data->status==Comment::STATUS_PENDING): ?>
                                <?php echo CHtml::linkButton('Approve', array(
                                        'submit'=>array('comment/approve','id'=>$data->id),
                                        'class'=>'btn btn-success',
                                )); ?> |
                        <?php endif; ?>
                        <?php echo CHtml::link('Update',array('comment/update','id'=>$data->id), array('class'=>'btn btn-info')); ?> |
                        <?php echo CHtml::button('Delete',
                                array(
                                'submit'=>array('comment/delete','id'=>$data->id),
                                'confirm' => 'Are you sure?',
                                    'class'=>'delete btn btn-danger'));
                        ?>
        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="padding-top: 10px">
                <?php echo nl2br(CHtml::encode($data->content)); ?>
            </div>
        </div>
    </div>
</div>

