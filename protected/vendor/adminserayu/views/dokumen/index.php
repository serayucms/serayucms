<?php
$this->judul=Yii::t('app','app.dokumen');
?>
<div class="box">
    <div class="box-body">
    <div id="file-uploader"></div>
    <?php
    $this->widget('ext.elFinder.ElFinderWidget', array(
                'connectorRoute' => $this->module->id.'/dokumen/connector',
                'settings' => array('height'=>500)
            )
    );
    ?>
    <?php
    /*
    $filesPath = Yii::getPathOfAlias('webroot'). "/images/upload";
    $filesUrl = Yii::app()->baseUrl . "/images/upload";
    $this->widget("ext.ezzeelfinder.ElFinderWidget", array(
        'selector' => "div#file-uploader",
        'clientOptions' => array(

            'resizable' => false,
            'wysiwyg' => "ckeditor"
        ),
        'connectorRoute' => "adminig/dokumen/konektor",
        'connectorOptions' => array(
            'roots' => array(
                array(
                    'driver'  => "LocalFileSystem",
                    'path' => $filesPath,
                    'URL' => $filesUrl,
                    'mimeDetect' => "internal",
                    'accessControl' => "access"
                )
            )
        )
    ));
     * 
     */
    ?>
    <div id="elfinder" style="margin: -10px;margin-bottom: 0px;"></div>
    </div>
</div>
