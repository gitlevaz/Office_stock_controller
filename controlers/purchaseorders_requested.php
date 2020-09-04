<?php
class purchaseorders_requested extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('purchaseorders_requested/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('purchaseorders_requested/index');	
	}	
	}
    function load(){
    if(parent::checkTokan()){
    	$this->model->load();
	}
	}

	function delete_sub(){
    if(parent::checkTokan()){
    	$this->model->delete_sub();
	}
	}

	function edit_sub(){
    if(parent::checkTokan()){
    	$this->model->edit_sub();
	}
	}

	function load_item(){
    if(parent::checkTokan()){
    	$this->model->load_item();
	}
	}

	function create_new(){
    if(parent::checkTokan()){
    	$this->model->create_new();
	}
	}

	function save_new(){
    if(parent::checkTokan()){
    	$this->model->save_new();
	}
	}

	function deleteorder(){
    if(parent::checkTokan()){
    	$this->model->deleteorder();
	}	
	}

	function confirmorder(){
    if(parent::checkTokan()){
    	$this->model->confirmorder();
	}	
	}
}
?>