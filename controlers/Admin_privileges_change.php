<?php
class Admin_privileges_change extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Admin_privileges_change/js/default.js');
	}

	function load(){
    if(parent::checkTokan()){
     $this->view->views=$this->model->load();
	}		
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Admin_privileges_change/index');	
	}	
	}

	function edit(){
    if(parent::checkTokan()){
     $this->model->edit();
	}		
	}

	function  edit_sub(){
    if(parent::checkTokan()){
     $this->model->edit_sub();
	}		
	}
}
?>