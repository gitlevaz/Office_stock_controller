
<?php
class Admin_users_home_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function load(){
	$result=R::getAll("SELECT * FROM privilegesprofiles");	
	if($result){
		return $result;
	}
}

function create(){
	$data=null;
    $password=encryptDecrypt::encrypt($_POST['val_3']);
    $current_date = date('d-m-Y');
    $res=parent::insert("users",array("email"=>$_POST['val_1'],"password"=>$password,"modified_date"=>$current_date,"status"=>"1","username"=>$_POST['val_2'],"privilegesprofiles_id"=>$_POST['val_5']));
     if($res>=0){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");	
     }
     echo json_encode($data);
}

}
