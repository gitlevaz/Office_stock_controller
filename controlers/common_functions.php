<?php
class common_functions extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    // $this->view->js=array('Customers_home/js/default.js');
	}

	function get_options(){
	  $this->model->get_options();	
	}
	function get_index(){
	  $this->model->get_index();	
	}
}
?>