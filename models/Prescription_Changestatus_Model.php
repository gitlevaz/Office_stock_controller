
<?php
class Prescription_Changestatus_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function load_auto(){
    $max=$_POST['mx']+1;
    $data=null;
    $mx=R::getAll("SELECT id FROM prescriptionmaster WHERE id='$max'");
    if($mx){
    	foreach ($mx as $vv) {
    	$data=array("reply"=>"10","max"=>$vv['id']);
    	}
    }else{
    	$data=array("reply"=>"20");
    }
        echo json_encode($data);
    }


    function load_dataauto(){
    	// $max=R::getAll("SELECT MAX(id) as max FROM prescriptionmaster");
    	// foreach ($max as $mv) {
    	// echo "<input type='hidden' class='maxprescrip' value=".$mv['max'].">";
    	// }
    	$actdate =date("Y-m-d");
    	$idd=$_POST['id'];
		$res=R::getAll("SELECT * FROM prescriptionmaster WHERE act_date='$actdate' AND id='$idd'");	
		if($res){
			foreach ($res as $val) {
                echo "<a href='#demo".$val['id']."' data-toggle='collapse'>";
                echo "<span class=''>".$val['id']."</span>";
				$cus_id=$val['patient'];
				$rest=R::getAll("SELECT * FROM customers WHERE id='$cus_id'");	
				foreach ($rest as $value) {
                echo " Patient Number <span class='label label-default'>".$value['id']."</span>";
                echo " Patient <span class='label label-default'>".$value['first_name']." ".$value['last_name']."</span>";
                echo "</a>";
				}
				echo "<div id='demo".$val['id']."' class='collapse'>";
				echo "	  <table class='table' id='maintable'>
						    <thead class='maintabletop'>
						      <tr class='info'>
						        <th style='width:25%;'>Drug Name</th>
						        <th style='width:10%;'>Days</th>
						        <th style='width:10%;'>Weeks</th>
						        <th style='width:10%;'>Months</th>
						        <th style='width:10%;'>Dosage</th>
						        <th style='width:6%;'></th>
						        <th style='width:10%;''></th>
						        <th style='width:10%;'>Total</th>
						        <th></th>
						      </tr>
						    </thead>";
				
				$pre_id=$val['id'];
				$rest=R::getAll("SELECT * FROM prescriptionsub WHERE prescription_no='$pre_id'");	
				foreach ($rest as $va) {
			 	echo "<tr><input type='hidden' value=".$va['item_code']."_".$va['total']."_".$value['id']." class='pdata_".$va['id']."'>
			 	<td>".$va['item_name']."</td><td>".$va['days']."</td><td>".$va['weeks']."</td><td>".$va['months']."</td>
			 	<td>".$va['dosage']."</td><td>".$va['unit']."</td><td>".$va['dostype']."</td><td>".$va['total']."</td>";
			 	$sub_id=$va['id'];
				$re=R::getAll("SELECT * FROM prescriptionstatus WHERE prescription_id='$sub_id' AND status='1'");	
				if($re){
				foreach ($re as $vv) {
			 	echo "<td><button type='button' name='prval_".$va['id']."' class='btn btn-success cancel_btn prval_".$va['id']."'  >Cancel</button></td>

			 	</tr>";
				}
			    }else{
			 	echo "<td><button type='button' name='prval_".$va['id']."' class='btn btn-success proceed_btn prval_".$va['id']."'>Proceed</button></td>

			 	</tr>";
			    }
			    }
				echo "</table>";
				echo "</div>";
				echo "<br><br>";
			}
		}else{
		}
    }


    function load_prescriptions(){

    	$max=R::getAll("SELECT MAX(id) as max FROM prescriptionmaster");
    	foreach ($max as $mv) {
    	echo "<input type='hidden' class='maxprescrip' value=".$mv['max'].">";
    	}
    	$actdate =date("Y-m-d");
		$res=R::getAll("SELECT * FROM prescriptionmaster ORDER BY id DESC");	
		if($res){
			foreach ($res as $val) {
                echo "<a href='#demo".$val['id']."' data-toggle='collapse'>";
                echo "<span class=''>".$val['id']."</span>";
				$cus_id=$val['patient'];
				$rest=R::getAll("SELECT * FROM customers WHERE id='$cus_id'");	
				foreach ($rest as $value) {
                echo " Patient Number <span class='label label-default'>".$value['id']."</span>";
                echo " Patient <span class='label label-default'>".$value['first_name']." ".$value['last_name']."</span>";
                echo "</a>";
				}
				echo "<div id='demo".$val['id']."' class='collapse'>";
				echo "	  <table class='table' id='maintable'>
						    <thead class='maintabletop'>
						      <tr class='info'>
						        <th style='width:25%;'>Drug Name</th>
						        <th style='width:10%;'>Days</th>
						        <th style='width:10%;'>Weeks</th>
						        <th style='width:10%;'>Months</th>
						        <th style='width:10%;'>Dosage</th>
						        <th style='width:6%;'></th>
						        <th style='width:10%;''></th>
						        <th style='width:10%;'>Total</th>
						        <th></th>
						      </tr>
						    </thead>";
				
				$pre_id=$val['id'];
				$rest=R::getAll("SELECT * FROM prescriptionsub WHERE prescription_no='$pre_id'");	
				foreach ($rest as $va) {
			 	echo "<tr><input type='hidden' value=".$va['item_code']."_".$va['total']."_".$value['id']." class='pdata_".$va['id']."'>
			 	<td>".$va['item_name']."</td><td>".$va['days']."</td><td>".$va['weeks']."</td><td>".$va['months']."</td>
			 	<td>".$va['dosage']."</td><td>".$va['unit']."</td><td>".$va['dostype']."</td><td>".$va['total']."</td>";
			 	$sub_id=$va['id'];
				$re=R::getAll("SELECT * FROM prescriptionstatus WHERE prescription_id='$sub_id' AND status='1'");	
				if($re){
				foreach ($re as $vv) {
			 	echo "<td><button type='button' name='prval_".$va['id']."' class='btn btn-success cancel_btn prval_".$va['id']."'  >Cancel</button></td>

			 	</tr>";
				}
			    }else{
			 	echo "<td><button type='button' name='prval_".$va['id']."' class='btn btn-success proceed_btn prval_".$va['id']."'>Proceed</button>

			 	</td>

			 	</tr>";
			    }
			    }
				echo "</table>";
				echo "</div>";
				echo "<br><br>";
			}
            }
    }


    function update_status(){
    	$data=null;
    	$pres_id=$_POST['id'];
    	$aa=$_POST['val'];
    	$ex=explode('_',$aa);
    	$item_code=$ex[0];
    	$total=$ex[1];
    	$patient_id=$ex[2];
    	$user_id=Session::get('user_id');
    	$actdate =date("Y-m-d");
    	$time=$_POST['time'];

    	$check=0;
    	$re=R::getAll("SELECT quantity FROM stockitems WHERE id='$item_code'");
    	foreach ($re as $aas) {
        $qty=$aas['quantity'];
        if($qty<$total){
        	$check=1;
        }
    	}

    	if($check==0){
        $rest=R::exec("UPDATE stockitems SET quantity=quantity-'$total' WHERE id='$item_code'");
        if($rest=='1'){
        }else{
         $data=array("reply"=>"20");
         echo json_encode($data);
         return false;	
        }

    	$rx=R::getAll("SELECT prescription_id FROM prescriptionstatus WHERE prescription_id='$pres_id'");
    	if($rx){
        $rt=R::exec("UPDATE prescriptionstatus SET status='1' WHERE prescription_id='$pres_id'");
        if($rt=='1'){
        	$data=array("reply"=>"10");
        }else{
         $data=array("reply"=>"20");
         echo json_encode($data);
         return false;	
        }

    	}else{
    	$res=parent::insert("prescriptionstatus",array("prescription_id"=>$pres_id,"user_id"=>$user_id,"date"=>$actdate,"time"=>
    		$time,"status"=>'1'));
    	if($res>=0){
	     $data=array("reply"=>"10","id"=>$res);
	     }else{
	     $data=array("reply"=>"20");	
	     }
    	}

	     }else{
	     $data=array("reply"=>"30");	
	     }
	     echo json_encode($data);
    }


    function cancel_status(){
    	$data=null;
    	$pres_id=$_POST['id'];
    	$aa=$_POST['val'];
    	$ex=explode('_',$aa);
    	$item_code=$ex[0];
    	$total=$ex[1];
    	$patient_id=$ex[2];
    	$user_id=Session::get('user_id');
    	$actdate =date("Y-m-d");
    	$time=$_POST['time'];

    	$check=0;

        $rest=R::exec("UPDATE stockitems SET quantity=quantity+'$total' WHERE id='$item_code'");
        if($rest=='1'){
        }else{
         $data=array("reply"=>"20");
         echo json_encode($data);
         return false;	
        }

    	$rx=R::getAll("SELECT prescription_id FROM prescriptionstatus WHERE prescription_id='$pres_id'");
    	if($rx){
        $rt=R::exec("UPDATE prescriptionstatus SET status='0' WHERE prescription_id='$pres_id'");
        if($rt=='1'){
        	$data=array("reply"=>"10");
        }else{
         $data=array("reply"=>"20");
         echo json_encode($data);
         return false;	
        }

    	}else{

    	}
	     echo json_encode($data);	
    }


}
