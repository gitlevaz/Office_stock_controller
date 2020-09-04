
<?php
class Employee_home_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function create(){
// $dob=0;
// $dob_month=$_POST['val_11'];
// $dob_date=$_POST['val_12'];
// $dob_year=$_POST['val_13'];

$res=parent::insert("employee",array("first_name"=>$_POST['val_1'],"last_name"=>$_POST['val_2'],"address"=>$_POST['val_3'],"contact_number"=>$_POST['val_4'],"email"=>$_POST['val_5'],"jobcategory"=>$_POST['val_6'],"date_of_birth"=>$_POST['val_10'],"account_number"=>$_POST['val_9'],"age"=>$_POST['val_10'],"bankname"=>$_POST['val_11'],"gender"=>$_POST['val_14']));
     if($res>=0){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");	
     }
     echo json_encode($data);
}

}

