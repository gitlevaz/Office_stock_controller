<?php
class Stockitmes_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Stockitmes_home/js/default.js');
	}

	function load(){
    if(parent::checkTokan()){
	  $this->view->cats=$this->model->load();
	}		
	}

	function index(){
    if(parent::checkTokan()){
     $this->load();
	 $this->view->render('Stockitmes_home/index');	
	}	
	}

	function load_subcats(){
	if(parent::checkTokan()){
	  $this->view->cats=$this->model->load_subcats();
	}		
	}

	function create(){
	if(parent::checkTokan()){
	  $this->view->cats=$this->model->create();
	}		
	}

	function check_itmcode(){
	if(parent::checkTokan()){
	  $this->model->check_itmcode();
	}			
	}


}
?>