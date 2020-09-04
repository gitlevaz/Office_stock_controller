<?php
class Reports_invoices extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Reports_invoices/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Reports_invoices/index');	
	}
	}

    function load(){
    	if(parent::checkTokan()){
		$this->model->load();
	    }
	}

	function search(){
    	if(parent::checkTokan()){
		$this->model->search();
	    }
	}
	
}
?>