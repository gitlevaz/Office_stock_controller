<?php
class Itemcategory_category extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Itemcategory_category/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Itemcategory_category/index');	
	}
	}
	function create(){
    if(parent::checkTokan()){
	  $this->model->create();
	}		
	}
}
?>