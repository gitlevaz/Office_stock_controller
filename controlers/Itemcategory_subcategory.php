<?php
class Itemcategory_subcategory extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Itemcategory_subcategory/js/default.js');
	}

	function load(){
    if(parent::checkTokan()){
	  $this->view->cats=$this->model->load();
	}		
	}

	function index(){
    if(parent::checkTokan()){
    	$this->load();
	 $this->view->render('Itemcategory_subcategory/index');	
	}		
	}

	function create(){
    if(parent::checkTokan()){
	  $this->model->create();
	}		
	}
}
?>