<?php
class Admin_users_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Admin_users_home/js/default.js');
	}

    function load(){
    if(parent::checkTokan()){
      $this->view->privs=$this->model->load();
	}	
    }

	function index(){
    if(parent::checkTokan()){
    	$this->load();
	 $this->view->render('Admin_users_home/index');	
	}	
	}

	function create(){
    if(parent::checkTokan()){
    $this->model->create();
	}
   }
}
?>