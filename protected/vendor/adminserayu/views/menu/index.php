<?php
$this->judul=Yii::t('app','app.menu');
?>
<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default" >
                    <div class="panel-heading">
                       <h3 class="panel-title">Tambah Menu </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $this->renderPartial('_formParentMenu', array('model'=>$model)); ?>   
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=>$dataProvider,
                        'itemView'=>'_list',
                        'template'=>"{items}\n{pager}",
                )); ?>
                
            </div>
            <div class="col-lg-6">
                <?php echo Yii::t('app','app.menu.ket.keterangan2'); ?> 
               
            </div>
        </div>
    </div>
</div>
 