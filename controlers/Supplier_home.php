<?php
class Supplier_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Supplier_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Supplier_home/index');	
	}	
	}

	function create(){
    if(parent::checkTokan()){
	  $this->model->create();
	}		
	}
}
?>