<?php
class Employee_edit extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Employee_edit/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){

		// $data=$this->model->load_pages();	
		// print_r($data);
		// // print_r($data["res"]);
		// 	die();	
	//  $this->view->render('Employee_edit/index',$data);	
	 $this->view->render("Employee_edit/index");
	}	
	}
  
	function create(){
    if(parent::checkTokan()){
	  $this->model->create();
	}		
	}

	
	function edit(){
		if(parent::checkTokan()){
		$this->model->edit();
		} 
	   }


	   function load_new(){
		if(parent::checkTokan()){
		 $this->model->load_pages();	
		}	
	}
}
?>