<?php
class home extends controller
{	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('index/js/default.js');
	}
	function index(){
	 $this->view->render('index/index');	
	}
	function logIn(){
	 $this->model->logIn();	
	}
}