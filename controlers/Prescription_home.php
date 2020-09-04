<?php
class Prescription_home extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Prescription_home/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
     $this->view->list=$this->model->auto_load();
	 $this->view->render('Prescription_home/index');	
	}
	}

	function search_patient(){
    if(parent::checkTokan()){
    	$this->model->search_patient();
	}
	}

	function load_item(){
    if(parent::checkTokan()){
	 $this->model->load_item('Grn_home/load_item');	
	}		
	}

	function save_main(){
    if(parent::checkTokan()){
	 $this->model->save_main();
	}		
	}

	function save_sub(){
    if(parent::checkTokan()){
	$this->model->save_sub();	
	}	
	}

	function remove_prescription(){
	    if(parent::checkTokan()){
	$this->model->remove_prescription();	
	}		
	}

	function load_prescriptions(){
	if(parent::checkTokan()){
	$this->model->load_prescriptions();	
	}			
	}

	function remove_pres(){
	if(parent::checkTokan()){
	$this->model->remove_pres();	
	}	
	}

	function load(){
    	if(parent::checkTokan()){
		$this->model->load();
	    }
	}

	function load_note(){
    	if(parent::checkTokan()){
		$this->model->load_note();
	    }	
	}

}
?>