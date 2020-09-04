
<?php
class Itemcategory_subcategory_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function create(){
$res=parent::insert("itemsubcategory",array("category_id"=>$_POST['val_1'],"subcategory"=>$_POST['val_2']));
     if($res>=0){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");	
     }
     echo json_encode($data);
}

function load(){
$res=R::getAll("SELECT * FROM itemcategory ");	
if($res){
return $res;
}
}

}
