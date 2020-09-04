<?php
class Invoice_return extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Invoice_return/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Invoice_return/index');	
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
	
	function remove_returnnote(){
    if(parent::checkTokan()){
	$this->model->remove_returnnote();	
	}	
	}

	function load_rtns(){
    if(parent::checkTokan()){
	$this->model->load_rtns();	
	}	
	}

	function load_subs(){
    if(parent::checkTokan()){
	$this->model->load_subs();	
	}	
	}

}
?>