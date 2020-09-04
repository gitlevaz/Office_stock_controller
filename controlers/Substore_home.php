<?php
class Substore_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Substore_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Substore_home/index');	
	}		
	}
}
?>