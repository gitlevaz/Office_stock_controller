<?php
class Customers_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Customers_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Customers_home/index');	
	}	
	}

	function create(){
    if(parent::checkTokan()){
	  $this->model->create();
	}		
	}
}
?>