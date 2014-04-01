<?php
class ConfigForm extends CFormModel
{
    //-----global-----
    public $adminEmail;
    public $kontakKeterangan;
    public $title;
    
    //-----artikel-----
    public $postsPerPage;
    public $editor;
    public $artikelTerkait; //-----value 0 dan 1-----
    public $profilePembuat; //-----value 0 dan 1-----
    public $layoutArtikel; //-----kolom1, kolom2, kolom3-----
    
    //-----mode perbaikan-----
    public $mPaktif; //-----value 0 dan 1-----
    public $keteranganPerbaikan;
    public $commentNeedApproval;
    public $bahasa;
    
    public function rules()
    {
        return array(
            array('adminEmail, 
                    postsPerPage, 
                    kontakKeterangan, 
                    profilePembuat,
                    artikelTerkait, 
                    title,
                    mPaktif,
                    keteranganPerbaikan,
                    commentNeedApproval,
                    layoutArtikel,
                    editor
                    ','required'
                ),
            array('adminEmail', 'email'),
            array('postsPerPage, mPaktif, artikelTerkait, profilePembuat', 'numerical', 'integerOnly'=>true),
            array('title, editor', 'length', 'max'=>128),
            array('layoutArtikel, bahasa', 'length', 'max'=>6),
            array('commentNeedApproval', 'boolean'),
            array('mPaktif, artikelTerkait, profilePembuat', 'length', 'max'=>1),
            array('kontakKeterangan, keteranganPerbaikan', 'default'),
        );
    }
    
    public function attributeLabels(){
		return array(
			'title' => Yii::t("app",'model.pengaturan.title'),
			'adminEmail' => Yii::t("app",'model.pengaturan.adminEmail'),
			'postsPerPage' => Yii::t("app",'model.pengaturan.postsPerPage'),
			'kontakKeterangan' => Yii::t("app",'model.pengaturan.kontakKeterangan'),
			'artikelTerkait' => Yii::t("app",'model.pengaturan.artikelTerkait'),
			'profilePembuat' => Yii::t("app",'model.pengaturan.profilePembuat'),
			'mPaktif' => Yii::t("app",'model.pengaturan.mPaktif'),
			'keteranganPerbaikan' => Yii::t("app",'model.pengaturan.keteranganPerbaikan'),
			'commentNeedApproval' => Yii::t("app",'model.pengaturan.commentNeedApproval'),
			'layoutArtikel' => Yii::t("app",'model.pengaturan.layoutArtikel'),
			'bahasa' => Yii::t("app",'model.pengaturan.bahasa'),
			'editor' => Yii::t("app",'model.pengaturan.editor'),
		);
    }
    
   
    
  
}
?>