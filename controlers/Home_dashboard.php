<?php
class Home_dashboard extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Home_dashboard/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Home_dashboard/index');	
	}	
	}

	function aa(){
	 echo $_GET['url'];
	}
}
?>