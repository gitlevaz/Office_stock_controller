<?php
class Admin_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Admin_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Admin_home/index');	
	}	
	}
}
?>