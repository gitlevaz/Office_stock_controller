<?php
class Customers_edit extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Customers_edit/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Customers_edit/index');	
	}	
	}

	function load_pages(){
    if(parent::checkTokan()){
	 $this->model->load_pages();	
	}	
	}

   function edit_load(){
    if(parent::checkTokan()){
    $this->model->edit_load();
    } 
   }

   function edit(){
    if(parent::checkTokan()){
    $this->model->edit();
    } 
   }

   function delete(){
    if(parent::checkTokan()){
    $this->model->delete();
    }  
   }

  function search_key(){
    $no_of_record=10;
    $this->model->search_key($no_of_record);
  }

}
?>