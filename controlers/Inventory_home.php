<?php
class Inventory_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Inventory_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Inventory_home/index');	
	}	
	}
}
?>