<?php
class purchaseorders_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('purchaseorders_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('purchaseorders_home/index');	
	}		
	}

	function load_item(){
    if(parent::checkTokan()){
	 $this->model->load_item('purchaseorders_home/load_item');	
	}		
	}

	function save_main(){
    if(parent::checkTokan()){
	 $this->model->save_main();	
	}	
	}

	function save_sub(){
    if(parent::checkTokan()){
	$this->model->save_sub();	
	}	
	}
	
	function remove_invoice(){
    if(parent::checkTokan()){
	$this->model->remove_invoice();	
	}	
	}
}
?>