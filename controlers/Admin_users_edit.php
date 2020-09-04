<?php
class Admin_users_edit extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Admin_users_edit/js/default.js');
	}


    function load(){
    if(parent::checkTokan()){
      $this->view->privs=$this->model->load();
  } 
    }

	function index(){
    if(parent::checkTokan()){
            $this->load();
	 $this->view->render('Admin_users_edit/index');	
	}		
	}

	function save(){
    if(parent::checkTokan()){
    $this->model->save();
	}
   } 

   function loadusers(){
    if(parent::checkTokan()){
    $this->model->loadusers();
    } 
   }

   function edit_load(){
    if(parent::checkTokan()){
    $this->model->edit_load();
    } 
   }

}
?>