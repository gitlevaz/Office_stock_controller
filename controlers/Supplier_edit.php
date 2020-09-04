<?php
class Supplier_edit extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('Supplier_edit/js/default.js');
	}

	function index(){
    if(parent::checkTokan()){
	 $this->view->render('Supplier_edit/index');	
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
    //        print_r('d');
    //    die();
    // if(parent::checkTokan()){
    $this->model->edit();
    // } 
   }

//    function delete($seller_id){
//     //    print_r($seller_id);
//     //    die();
//     if(parent::checkTokan()){
//     $this->model->delete2($seller_id);
//     }  
//    }
function delete(){
    if(parent::checkTokan()){
    $this->model->delete();
    }  
   }

}
?>