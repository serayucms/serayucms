<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php Serayu::data()->bootstrap->register(); ?>
<?php Serayu::registerCss(Serayu::data()->baseUrl."/css/main.css") ?>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container">
	<?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'brandLabel' => Serayu::data()->params['title'],
            'collapse' => true,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbNav',
                    'items' => Serayu::getMenuItem(),
                ),
            ),
        )); ?>
    
    <div style="margin-top: 70px">
        <?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>
    </div>
    
    <div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> <?php echo Serayu::data()->params['title'] ?>.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->
	

</div><!-- page -->

</body>
</html>