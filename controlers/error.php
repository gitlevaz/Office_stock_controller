<?php
class error extends controller
{
	
	function __construct()
	{
	parent::__construct();
	// echo "This is an error!";

	}

	function index(){
	 $this->view->msg="This page doesnt exist";
	 $this->view->render('error/index');
	}
}