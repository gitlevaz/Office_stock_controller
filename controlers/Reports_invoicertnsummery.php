<?php
class Reports_invoicertnsummery extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Reports_invoicertnsummery/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Reports_invoicertnsummery/index');	
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