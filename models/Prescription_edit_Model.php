
<?php
class Prescription_edit_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

    function auto_load(){
		$res=R::getAll("SELECT id,item_name FROM stockitems ORDER BY item_name");	
		if($res){
				return $res;
		}else{
		}
	}

    function load_prescriptions(){
    	$actdate =date("Y-m-d");
		$res=R::getAll("SELECT * FROM prescriptionmaster WHERE act_date='$actdate' ORDER BY id DESC");	
		if($res){
			foreach ($res as $val) {
				$cus_id=$val['patient'];
				$rest=R::getAll("SELECT * FROM customers WHERE id='$cus_id'");	
				foreach ($rest as $value) {
				echo "<p>".$value['first_name']." ".$val['act_date']."<br>".$val['act_time']." 
				<button class='presremove' id=prm_".$val['id'].">Remove</button>
				<button class='presedit' data-value=".$val['id']." data-patient=".$value['id'].">Edit</button></p>";
				echo "<hr>";
				}
			}
		}else{
		}
    }


    function load_patient(){
    	$cus_id=$_POST['id'];
    	$id=$_POST['pr_id'];
    	 $status='0';
    	 $check=0;
     	 // $rest=R::getAll("SELECT pa.status as status FROM prescriptionsub ps,prescriptionstatus pa WHERE ps.prescription_no='$id' AND ps.id=pa.prescription_id");
     	 $rest=R::getAll("SELECT ps.id as presid FROM prescriptionsub ps WHERE ps.prescription_no='$id'");
    	 if($rest){
    	 	foreach ($rest as $value) {
    	     $presid= $value['presid'];
    	      $rx=R::getAll("SELECT status FROM prescriptionstatus WHERE prescription_id='$presid'");
    	      if($rx){
    	      	foreach ($rx as $bb) {
    	      		$st=$bb['status'];
    	      		if($st==1){
    	      			$check=1;
    	      		}
    	      	}
    	      }
    	 	}
    	 }

    	 if($check==1){
    	 	$data=array("reply"=>"30");
    	 }else{

    	$data=null;
		$rest=R::getAll("SELECT cc.*,pm.date,pm.note  FROM customers cc,prescriptionmaster pm WHERE pm.id='$id' AND cc.id=pm.patient");	
		if($rest){
		foreach ($rest as $value) {
			$data=array('reply'=>'10','val_1'=>$value['id'],'val_2'=>$value['first_name'],'val_3'=>$value['date_of_birth'],'val_4'=>$value['age'],'val_5'=>$value['weight'],'val_6'=>$value['date'],'val_7'=>$value['note']);
		}
		}else{

		}
	    }

		echo json_encode($data);

    }

    function load_pres(){
    	$pres_id=$_POST['id'];
		$rest=R::getAll("SELECT * FROM prescriptionsub WHERE prescription_no='$pres_id'");	
		if($rest){
		 foreach ($rest as $value) {
			echo "<tr class='prescrip_rows' id='presrow_".$value['id']."'>
				<td>".$value['item_name']."</td><td></td><td>".$value['dosage']."</td><td class=''>".$value['unit']."</td><td class=''>".$value['dostype']."</td><td>".$value['days']."</td><td>".$value['weeks']."</td><td>".$value['months']."</td><td class=''>".$value['total']."</td><td><input type='hidden' class='hidden_sum' value=".$value['total']."><button type='button' class='btn btn-danger rm_btn_old' data-value='".$value['id']."'>Remove</button></td>
				</tr>";
			}
	    }
    }


    function check_status(){
     	 $status='0';
    	 $check=0;
     	 // $rest=R::getAll("SELECT pa.status as status FROM prescriptionsub ps,prescriptionstatus pa WHERE ps.prescription_no='$id' AND ps.id=pa.prescription_id");
     	 $rest=R::getAll("SELECT ps.id as presid FROM prescriptionsub ps WHERE ps.prescription_no='$id'");
    	 if($rest){
    	 	foreach ($rest as $value) {
    	     $presid= $value['presid'];
    	      $rx=R::getAll("SELECT status FROM prescriptionstatus WHERE prescription_id='$presid'");
    	      if($rx){
    	      	foreach ($rx as $bb) {
    	      		$st=$bb['status'];
    	      		if($st==1){
    	      			$check=1;
    	      		}
    	      	}
    	      }
    	 	}
    	 }

    	 if($check==1){
    	 	$data=array("reply"=>"30");
    	 }
    }



    function remove_sub(){
    	 $data=null;
    	 $id=$_POST['id'];
    	 $res=parent::delete2("prescriptionsub",$id);
    	 $data=array('reply'=>'10');
    	 echo json_encode($data);
    }


	function save_sub(){
			$data=null;
		    $urls=null;
		    $invoice_id=null;
    if($_POST==null || $_POST==''){
	     $data=array("reply"=>"20");
	     echo json_encode($data);
	     return false;	
    }else{
			foreach ($_POST as $key => $value){
				if(htmlspecialchars($value)=='0' || htmlspecialchars($value)==''){
				}else{
		        $urls=$urls.htmlspecialchars($key)."_".htmlspecialchars($value)."/";
		 		// echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

				}
			}
	$vl=$urls;
	//$vl=$this->simple_decrypt($val);
	$ex=explode(",",$vl);
		$a= explode('/',$vl);
			for ($i=0; $i < count($a)-1; $i++) {
			 	$x=$a[$i];
			 	$xx =explode('_', $x);
			 	// echo $xx[0];
			 	$invoice_id=$xx[1];

			 	$cont=0;
			 	if($xx[6]=='' || $xx[6]==null){

			 	}else{
			 		$cont=$xx[6];
			 	}
		 	//update item price
 		//$rr=parent::update_item_price($xx[0],$xx[3]);
 	       //update item qty
 		//$rr=parent::update_item_quantity_4($xx[0],$xx[4]);
			 	$itme_name='null';
				$rest=R::getAll("SELECT * FROM stockitems WHERE id='$xx[2]'");	
				foreach ($rest as $value) {
				$itme_name=$value['item_name'];
				}
		$res=parent::insert("prescriptionsub",array("prescription_no"=>$xx[1],"item_code"=>$xx[0],"item_name"=>$itme_name,"days"=>$xx[3],"weeks"=>$xx[4],"months"=>$xx[5],"dosage"=>$xx[6],"unit"=>$xx[7],"dostype"=>$xx[8],"total"=>$xx[9]));
	// $res=parent::insert("grn_main",array());
	     if($res>=0){
	     	$data=array("reply"=>"10");
	     }else{
	     // $res=parent::delete("prescriptionmaster",$invoice_id);
	     // R::exec( 'DELETE prescriptionsub where prescription_no=$invoice_id');
	     // $data=array("reply"=>"20");
	     // echo json_encode($data);
	     // return false;	
	     }
	    }
	    echo json_encode($data);
	}	
	}



}
