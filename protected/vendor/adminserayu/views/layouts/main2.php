<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?> Administrator</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admintheme.css" />
</head>

<body>
    <?php $this->widget('bootstrap.widgets.TbNavbar', array(
        'brandLabel' => "Serayu CMS | Administrator ",
        'collapse' => true,
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbNav',
                'encodeLabel' => false, 
                'htmlOptions'=>array("class"=>"pull-right"),
                'items' => array(
                    array('label' => '<strong>Beranda</strong><span>Dashboard</span>', 'url'=>array("/".$this->getIdAdminserayu().'/default/index')),
                    array('label' => '<strong>Bantuan</strong><span>Cara Penggunaan</span>', 'url' => array("/".$this->getIdAdminserayu()."/default/halaman", "view"=>"bantuan")),
                    array('label' => '<strong>Pengaturan</strong><span>Konfigurasi</span>', 'url' => array("/".$this->getIdAdminserayu().'/pengaturan/index'), 'visible'=>Yii::app()->user->checkAccess("admin")),
                    array('label' => '<strong>Tentang Kami</strong><span>Serayu CMS</span>', 'url'=>array("/".$this->getIdAdminserayu()."/default/halaman", "view"=>"tentang-kami")),
                ),  
            ),
        ),
    )); ?>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3 menuSidebar">
                    <div class="userProfile">
                        <?php echo CHtml::image(User::model()->getImageProfile(Yii::app()->user->getId()),"",array("class"=>"img-circle img-thumbnail")) ?>
                        <div class="detail">
                            <strong> <?php echo $this->getNamaUser(); ?></strong><br/>
                            <?php echo CHtml::link("Profile", array("/".$this->getIdAdminserayu()."/user/update", "id"=>Yii::app()->user->getId()) , array("class"=>"btn btn-success btn-block","style"=>"margin-bottom:10px;margin-top:10px")); ?>
                            <?php echo CHtml::link("Logout", array("/".$this->getIdAdminserayu()."/default/logout") , array("class"=>"btn btn-success btn-block")); ?>
                        </div>
                    </div>
                    <?php $this->widget('komponen.UserMenu.UserMenu'); ?>
                    <div style="text-align: center;margin-top: 50px;">
                        Copyright &copy; 2014 | Serayu CMS <br/>
                        All Right Reserved
                    </div>
                     
                </div>
                <div class="col-xs-9">
                     
                    <div class="isiContent"> 
                        <?php if(Yii::app()->params['mPaktif'] == "1"): ?>
                        <div class="alert alert-info"><strong>Informasi : </strong> Anda Mengaktifkan Mode Perbaikan pada website</div>
                        <?php endif; ?>
                        
                        <?php echo $content; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
