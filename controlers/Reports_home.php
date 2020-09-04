<?php
class Reports_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Reports_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Reports_home/index');	
	}
	}
}
?>