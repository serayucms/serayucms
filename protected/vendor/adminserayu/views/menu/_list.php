<div class="row">
    <div class="col-lg-12">
        <div class="row" style="border: 1px solid #EEE;padding: 5px 0 5px 0">
            <div class="col-lg-6" style="padding-top: 5px; border-right: 1px solid #EEE">
                <Strong><?php echo $data->name ?></Strong>
            </div>
            <?php if($data->name == "main-menu"): ?>
                <div class="col-lg-6" style="border-right: 1px solid #EEE">
                    <?php echo TbHtml::link("Detail", Yii::app()->baseUrl."/".$this->module->id."/menu/admin/id/".$data->id,array("class"=>"btn btn-success pull-right btn-block btn-sm")); ?>
                </div>
            <?php else: ?>
                <div class="col-lg-3" style="border-right: 1px solid #EEE">
                    <?php echo TbHtml::link("Detail", Yii::app()->baseUrl."/".$this->module->id."/menu/admin/id/".$data->id,array("class"=>"btn btn-success pull-right btn-block btn-sm")); ?>
                </div>
                <div class="col-lg-3">
                    <?php
                    echo CHtml::link('Delete',"#", 
                    array('submit'=>array('deleteParent', 'id'=>$data->id), 
                          'confirm' => 'Apakah anda yakin akan menghapus menu ini?',
                          "class"=>"btn btn-danger pull-right btn-block btn-sm",  
                        ));
                    ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</div>
