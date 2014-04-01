<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style>
            .page-header{
                -webkit-border-top-left-radius: 4px;
                -webkit-border-top-right-radius: 4px;
                -webkit-border-bottom-right-radius: 0;
                -webkit-border-bottom-left-radius: 0;
                -moz-border-radius-topleft: 4px;
                -moz-border-radius-topright: 4px;
                -moz-border-radius-bottomright: 0;
                -moz-border-radius-bottomleft: 0;
                border-top-left-radius: 4px;
                border-top-right-radius: 4px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
                background: #5cb85c;
                box-shadow: inset 0px -3px 0px rgba(0, 0, 0, 0.2);
                padding: 20px 10px;
                text-align: center;
                font-size: 26px;
                font-weight: 300;
                color: #fff;
            }
            .body{
                padding: 10px 20px;
                background: #fff;
                color: #444;
                background: #eaeaec !important;
            }
            .footer{
                -webkit-border-top-left-radius: 0;
                -webkit-border-top-right-radius: 0;
                -webkit-border-bottom-right-radius: 4px;
                -webkit-border-bottom-left-radius: 4px;
                -moz-border-radius-topleft: 0;
                -moz-border-radius-topright: 0;
                -moz-border-radius-bottomright: 4px;
                -moz-border-radius-bottomleft: 4px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
                padding: 10px 20px;
                background: #fff;
                color: #444;
            }
        </style>
</head>
<body style="background-color: #222">
    <div class="container">
        <?php echo $content; ?>
    </div>
</body>
</html>
