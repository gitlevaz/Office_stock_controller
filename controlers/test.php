<?php
class test extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    ->js=array('test/js/default.js');
	}

	function index(){
		Session::set('USERTOKEN',Session::getToken(50));
		=Session::get('USERTOKEN');
		if(parent::checkTokan()){
	 ->render('test/index');
	 }	
	}
}
?>