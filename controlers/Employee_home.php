<?php
class Employee_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Employee_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Employee_home/index');	
	}	
	}

	function create(){
    if(parent::checkTokan()){
	  $this->model->create();
	}		
	}
}
?>