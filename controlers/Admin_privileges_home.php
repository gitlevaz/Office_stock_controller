<?php
class Admin_privileges_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Admin_privileges_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Admin_privileges_home/index');	
	}
	}

	function create(){
    if(parent::checkTokan()){
      $this->model->create();
	}	
	}
    
    function load(){
    if(parent::checkTokan()){
      $this->model->load();
	}	
    }

    function remove(){
    if(parent::checkTokan()){
      $this->model->remove();
	}		
    }
}
?>