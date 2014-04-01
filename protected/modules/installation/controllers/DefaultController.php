<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->layout = "colom1";
                $this->pageTitle = "Serayu CMS | Installation ";
                $this->render('index');
	}
	public function actionTest()
	{
		echo "Test";
	}
}