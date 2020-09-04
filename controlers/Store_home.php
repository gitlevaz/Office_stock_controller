<?php
class Store_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Store_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Store_home/index');	
	}	
	}
}
?>