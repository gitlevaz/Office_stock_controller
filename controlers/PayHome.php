<?php

class PayHome extends controller {

    function __construct()
	{
    parent::__construct();
    // Session::init();
    // $this->view->js=array('Pos_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('payroll_home/index');	
	}
	}
}