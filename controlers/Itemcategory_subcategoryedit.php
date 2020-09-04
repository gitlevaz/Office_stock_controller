<?php
class Itemcategory_subcategoryedit extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Itemcategory_subcategoryedit/js/default.js');
	}

	function load(){
    if(parent::checkTokan()){
      $this->view->cats=$this->model->load();
      print_r( $this->view->cats);
      die();
	}		
	}

	function index(){
    if(parent::checkTokan()){
    $this->load();
	 $this->view->render('Itemcategory_subcategoryedit/index');	
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
}
?>