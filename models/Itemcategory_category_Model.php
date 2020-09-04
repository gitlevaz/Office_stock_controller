
<?php
class Itemcategory_category_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function create(){
$res=parent::insert("itemcategory",array("category_name"=>$_POST['val_1']));
     if($res>=0){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");	
     }
     echo json_encode($data);
}

}
