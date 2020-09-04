<?php
class Stockitmes_edit extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Stockitmes_edit/js/default.js');
	}

   function load_subcats(){
    if(parent::checkTokan()){
    $this->model->load_subcats();
    }  
   }
   
	function load(){
    if(parent::checkTokan()){
	  $this->view->cats=$this->model->load();
	}		
	}

	function index(){
    if(parent::checkTokan()){
    $this->load();
	 $this->view->render('Stockitmes_edit/index');	
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

  function check_itmcode(){
  if(parent::checkTokan()){
    $this->model->check_itmcode();
  }     
  }

  function search_key(){
    $no_of_record=10;
    $this->model->search_key($no_of_record);
  }

}
?>