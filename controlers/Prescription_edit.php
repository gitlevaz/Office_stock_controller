<?php
class Prescription_edit extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Prescription_edit/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
    	$this->view->list=$this->model->auto_load();
	 $this->view->render('Prescription_edit/index');	
	}
	}

	function load_prescriptions(){
	if(parent::checkTokan()){
	$this->model->load_prescriptions();	
	}			
	}

	function load_patient(){
	if(parent::checkTokan()){
	$this->model->load_patient();	
	}
	}

	function load_pres(){
	if(parent::checkTokan()){
	 $this->model->load_pres();	
	}	
	}

	function load_up(){
	if(parent::checkTokan()){
	 $this->model->load_up();	
	}		
	}

	function remove_sub(){
	if(parent::checkTokan()){
	 $this->model->remove_sub();	
	}	
	}

		function save_sub(){
    if(parent::checkTokan()){
	$this->model->save_sub();	
	}	
	}


}
?>