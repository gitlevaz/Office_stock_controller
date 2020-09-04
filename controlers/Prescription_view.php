<?php
class Prescription_view extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Prescription_view/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Prescription_view/index');	
	}
	}

	function load_prescriptions(){
	    if(parent::checkTokan()){
		 $this->model->load_prescriptions();	
		}	
	}

	function update_status(){
		if(parent::checkTokan()){
			$this->model->update_status();
		}
	}

	function load_auto(){
		if(parent::checkTokan()){
			$this->model->load_auto();
		}	
	}

	function load_dataauto(){
		if(parent::checkTokan()){
			$this->model->load_dataauto();
		}	
	}
}
?>