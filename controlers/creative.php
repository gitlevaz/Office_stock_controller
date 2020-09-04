<?php
class creative extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('creative/js/default.js');
	}
    
    function load_tables(){
     $this->view->tables=$this->model->load_tables();
     //print_r($this->model->load_tables());
    }

	function index(){
	 $this->load_tables();
	 $this->view->render('creative/index');
	}

	function create(){
	 $this->model->create();	
	}

	function genarate_model(){
	 $this->model->genarate_model();
	}

}
?>