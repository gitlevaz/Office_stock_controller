
<?php
class Substore_create_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}


function create(){
	$val2=$_POST['val_2'];
	$val3=$_POST['val_3'];
	$val4=$_POST['val_4'];
	$val5=$_POST['val_5'];
		
		if($_POST['val_6']==null || $_POST['val_6']==''){
		$val6='0.00';
		}else{
	    $val6=$_POST['val_6'];
		}
	
	$val7=$_POST['val_7'];
	$val8=$_POST['val_8'];
	$val9=$_POST['val_9'];
	$val10=$_POST['val_10'];
	$val11=$_POST['val_11'];
	$val12=$_POST['val_12'];

		if($_POST['val_13']==null || $_POST['val_13']==''){
		$val13='0.00';
		}else{
	    $val13=$_POST['val_13'];
		}
	
	$val14=$_POST['val_14'];

$res=parent::insert("substore",array("repname"=>$val2,"address1"=>$val3,"telephone"=>$val4,"contact_person"=>$val5,"credit_limit"=>$val6,"bank_name"=>$val7,"added_date"=>$val8,"branch_name"=>$val9,"address2"=>$val10,"email"=>$val11,"contact_no"=>$val12,"opening_balance"=>$val13,"account_no"=>$val14));
     if($res>=0){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");	
     }
     echo json_encode($data);
}


}
