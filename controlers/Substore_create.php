<?php
class Substore_create extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Substore_create/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Substore_create/index');	
	}		
	}

	function create(){
    if(parent::checkTokan()){
	  $this->model->create();
	}		
	}
}
?>