<?php
class Itemcategory_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Itemcategory_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Itemcategory_home/index');	
	}		
	}
}
?>