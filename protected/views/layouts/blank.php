<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<?php Serayu::data()->bootstrap->register(); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
	<?php echo $content; ?>
    <div id="footer" class="navbar-fixed-bottom" style="text-align: center; border-top: 1px solid #EEE; padding-top: 20px;padding-bottom: 20px;">
            Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::encode(Serayu::data()->params['title']); ?>.<br/>
            All Rights Reserved.<br/>
	</div><!-- footer -->
</div><!-- page -->
</body>
</html>
