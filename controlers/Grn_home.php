<?php
class Grn_home extends controller
{
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Grn_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Grn_home/index');	
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
	
	function remove_grns(){
    if(parent::checkTokan()){
	$this->model->remove_grns();	
	}	
	}
	
}
?>