<?php
class Reports_grn extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Reports_grn/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Reports_grn/index');	
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