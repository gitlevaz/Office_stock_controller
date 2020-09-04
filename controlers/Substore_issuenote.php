<?php
class Substore_issuenote extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Substore_issuenote/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Substore_issuenote/index');	
	}
	}

	function load_item(){
    if(parent::checkTokan()){
	 $this->model->load_item('Grn_home/load_item');	
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