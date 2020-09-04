<?php
class Reports_Suppliers extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Reports_Suppliers/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Reports_Suppliers/index');	
	}
	}

	function load(){
		$no_of_record=10;
		$this->model->load($no_of_record);
	}

	function search_key(){
		$no_of_record=10;
		$this->model->search_key($no_of_record);
	}
}
?>