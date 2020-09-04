<?php
class Invoice_print extends controller
{
	
	function __construct(){
    parent::__construct();
    Session::init();
    $this->view->js=array('Invoice_print/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
		// $this->$ff = 5;
		// $data =3;	
		// print_r($data);
		// die();
	 $this->view->render('Invoice_print/index');	
	//  $this->view->render('Invoice_print/print',compact('data'));	

	}	
	}

	function Invoice_print(){
    if(parent::checkTokan()){
	$this->model->Invoice_print();	
	}
	}
}
?>