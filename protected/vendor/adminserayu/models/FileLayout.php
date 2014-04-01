<?php
class FileLayout extends CFormModel
{
    public $file;
    
    public function rules()
    {
        return array(
            array('file','required'),
            array('file', 'default'),
            array('file', 'safe'),
        );
    }
    
    public function attributeLabels(){
		return array(
			'file' => 'File',
		);
    }
}
?>
