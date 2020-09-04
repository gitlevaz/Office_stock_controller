
<?php
class Supplier_home_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function create(){
if($_POST['val_4']=="" || $_POST['val_4']==null){
$val_1=0;
}else{
$val_1=$_POST['val_4'];
}

if($_POST['val_10']=="" || $_POST['val_10']==null){
$val_2=0;
}else{
$val_2=$_POST['val_10'];
}

$res=parent::insert("supplier",array("first_name"=>$_POST['val_1'],"address"=>$_POST['val_2'],"email"=>$_POST['val_3'],"credit_limit"=>$val_1,"bank_name"=>$_POST['val_5'],"payment_date"=>$_POST['val_6'],"last_name"=>$_POST['val_7'],"contact_mobile"=>$_POST['val_8'],"contact_land"=>$_POST['val_9'],"opening_balance"=>$val_2,"account_No"=>$_POST['val_11'],"remaining_before"=>$_POST['val_12']));
     if($res>=0){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");	
     }
     echo json_encode($data);
}

}
