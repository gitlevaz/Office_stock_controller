<?php
class Reports_pressummery extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Reports_pressummery/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Reports_pressummery/index');	
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