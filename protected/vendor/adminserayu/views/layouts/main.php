<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?> Administrator</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
</head>

    <body class="skin-black wysihtml5-supported  pace-done ">
    <!-- header logo: style can be found in header.less -->
        <header class="header">
            <?php echo TbHtml::link("Serayu CMS","#",array("class"=>"logo")) ?>
            <!-- Header Navbar: style can be found in header.less -->
            
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle hidden-lg" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
                <div class="navbar-left">
                    <?php $this->widget('bootstrap.widgets.TbNav', array(
                         'type' => TbHtml::NAV_TYPE_PILLS,
                        'items' => $this->menu,
                        'encodeLabel'=>false,
                        'htmlOptions'=>array('class'=>'navbar-static-top'),
                    )); ?>
                </div>
                <div class="navbar-right">
                    
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this->getNamaUser(); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php echo CHtml::image(User::model()->getImageProfile(Yii::app()->user->getId()),"",array("class"=>"img-circle img-thumbnail")) ?>
                                    <p>
                                        <?php echo $this->getNamaUser(); ?>  - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <?php echo TbHtml::link("Profile", array("/".$this->getIdAdminserayu()."/user/update/","id"=>Yii::app()->user->getId()), array("class"=>'btn btn-default btn-flat')) ?>
                                    </div>
                                    <div class="pull-right">
                                        <?php echo TbHtml::link("Logout", array("/".$this->getIdAdminserayu()."/default/logout"), array("class"=>'btn btn-default btn-flat')) ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php echo CHtml::image(User::model()->getImageProfile(Yii::app()->user->getId()),"",array("class"=>"img-circle")) ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hallo, <?php echo $this->getNamaUser(); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <?php $this->widget('komponen.UserMenu.UserMenu'); ?>
                    <div style="text-align: center;color: #7C7777; font-size: 12px;padding-top: 20px; border-top: 1px Solid #7C7777">
                        Copyright &copy; <?php echo date("Y"). " " . Yii::app()->name; ?> <br/>
                        All Right Reserved
                    </div>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <section class="content-header">
                    <h1><?php echo ucfirst($this->judul) ?> <small>Serayu CMS</small></h1>
                </section>
                <section class="content">
                    <?php echo $content; ?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    
</body>
</html>
