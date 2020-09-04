
<?php
class Prescription_home_Model extends model
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

	function load_item(){
		$data=null;
		$id=$_POST['id'];
		$res=R::getAll("SELECT * FROM stockitems WHERE id='$id'");	
		if($res){
			foreach ($res as $val) {
				$data=array("reply"=>"10","val_1"=>$val['id'],"val_2"=>$val['last_price'],"val_3"=>$val['unit'],"val_4"=>$val['quantity'],"val_5"=>$val['issue_as'],"val_6"=>$val['qty_in']);
			}
		}else{
     	$data=array("reply"=>"20");
		}
		echo json_encode($data);
	}	

	function search_patient(){
		$userid=$_POST['id'];
		$res=R::getAll("SELECT * FROM customers WHERE id='$userid'");	
		if($res){
			foreach ($res as $val) {
				$data=array("reply"=>"10","val_1"=>$val['first_name'],"val_2"=>$val['weight'],"val_3"=>$val['age'],"val_4"=>$val['date_of_birth']);
			}
		}else{
     	$data=array("reply"=>"20");
		}
		echo json_encode($data);
	}

	function save_main(){
		$date =date("Y-m-d");
		//$time =date("h:i:sa");
		$res=parent::insert("prescriptionmaster",array("patient"=>$_POST['val_4'],"date"=>$_POST['val_3'],"act_date"=>$date,"act_time"=>$_POST['localtime'],"note"=>$_POST['val_7']));
	// $res=parent::insert("grn_main",array());
	     if($res>=0){
	     $data=array("reply"=>"10","id"=>$res);
	     }else{
	     $data=array("reply"=>"20");	
	     }
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
	     $res=parent::delete2("prescriptionmaster",$invoice_id);
	     R::exec( 'DELETE prescriptionsub where prescription_no=$invoice_id');
	     $data=array("reply"=>"20");
	     echo json_encode($data);
	     return false;	
	     }
	    }
	    echo json_encode($data);
	}	
	}

    function remove_prescription(){
    	$id=$_POST['id'];

 	    //  $res=parent::delete("prescriptionmaster",$id);
	     // R::exec( 'DELETE prescriptionsub where prescription_no=$id ');
    }

    function remove_pres(){
    	 $data=null;
    	 $id=$_POST['id'];
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
         $rest=R::getAll("SELECT * FROM prescriptionmaster WHERE id='$id'");	
		 foreach ($rest as $value) {
		   $status=$value['issue_status'];
		 }
		 if($status=='0'){
 	     $res=parent::delete2("prescriptionmaster",$id);
		 	$sub_no;
         $rest=R::getAll("SELECT * FROM prescriptionsub WHERE prescription_no='$id'");	
		 foreach ($rest as $val) {
		   $sub_no=$val['id'];
		   $res=parent::delete2("prescriptionsub",$sub_no);
		 }

	     $data=array("reply"=>"10");
	 }else{
	     $data=array("reply"=>"30");
	 }
	}
	 echo json_encode($data);
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
				</p>";

				echo "<hr>";
				}
			}
		}else{
		}
    }



	function load(){
		$patient_id=$_POST['pid'];
		echo "<div class='col-sm-12 col-md-12'>";
			$page = $_POST['page'];
			$cur_page = $page;
			$page -= 1;
			$per_page = 10;
			$previous_btn = true;
			$next_btn = true;
			$first_btn = true;
			$last_btn = true;
			$start = $page * $per_page;

			if(isset($_POST['page']) && $_POST['page']>=0)
			{
			//echo $start;
			//$per_page;
			$aa=$page+1;
			echo "<input type='hidden' value='$aa' class='hidden_val2' name='hidden_val2'>";
			//$res=R::getAll("SELECT * FROM prescriptionsub ORDER BY id DESC LIMIT $start,$per_page");	
			$res=R::getAll("SELECT pr.* FROM prescriptionsub pr,prescriptionmaster pm WHERE pm.patient=$patient_id AND pr.prescription_no=pm.id ORDER BY pr.id DESC LIMIT $start,$per_page");
			if($res){
			echo "
			    <div class='table-responsive cage1' id=''>
			    <table class='table table-condensed default_table'>
			    <thead>
			      <tr>
			        <th>Date</th>
			        <th>Item</th>
			        <th>Days</th>
			        <th>Weeks</th>
			        <th>Months</th>
			        <th>Dosage</th>
			        <th>Unit</th>
			        <th></th>
			        <th>Total</th>
			      </tr>
			    </thead>
			    <tbody>
			";
			$total=0;
			$isstotal=0;
			$pendtotal=0;
			$checktotal=0;
			$color='#F5A9A9';
			$status=null;
			foreach ($res as $value) {
			$idd=$value['id'];
			$sta=R::getAll("SELECT status FROM prescriptionstatus WHERE prescription_id='$idd'");
			if($sta){
			foreach ($sta as $vv) {
			$status=$vv['status'];
			if($status=='1'){
			$checktotal=1;
			$color='#CEF6CE';	
			}
			}
		    }else{
		    $color='#F5A9A9';	
		    }

			$total+=$value['total'];
			if($checktotal==0){
				$pendtotal+=$value['total'];
			}else{
				$isstotal+=$value['total'];
			}
			$iid=$value['prescription_no'];
			$date="";
			$rs=R::getAll("SELECT date,patient FROM prescriptionmaster WHERE id='$iid'");
 				if($res){
 					foreach ($rs as $val) {
 						$date=$val['date'];
 						$patient=parent::get_patient($val['patient']);
 					}
 				}
			echo "<tr style='background-color:".$color."'>
				  <td>".$date."</td>
				  <td>".$value['item_name']."</td>
				  <td>".$value['days']."</td>
				  <td>".$value['weeks']."</td>
				  <td>".$value['months']."</td>
				  <td>".$value['dosage']."</td>
				  <td>".$value['unit']."</td>
				  <td>".$value['dostype']."</td>
				  <td class='al_right'>".number_format($value['total'], 2, '.', '')."</td>
				  </tr>";
			}
			echo "
			 </tbody></table><div>";
			}
			}


			//$query_pag_num=R::getAll("SELECT COUNT(*) FROM prescriptionsub pr,prescriptionmaster pm WHERE pm.patient=$patient_id AND pr.prescription_no=pm.id ORDER BY pr.id DESC LIMIT $start,$per_page");
			$query_pag_num=R::getAll("SELECT COUNT(*) FROM prescriptionsub");	
			if($query_pag_num){
			foreach ($query_pag_num as $key => $value) {
				$count= $value['COUNT(*)'];
			}	
			$no_of_paginations = ceil($count / $per_page);
			/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
			if ($cur_page >= 7) {
			    $start_loop = $cur_page - 3;
			    if ($no_of_paginations > $cur_page + 3)
			        $end_loop = $cur_page + 3;
			    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			        $start_loop = $no_of_paginations - 6;
			        $end_loop = $no_of_paginations;
			    } else {
			        $end_loop = $no_of_paginations;
			    }
			} else {
			    $start_loop = 1;
			    if ($no_of_paginations > 7)
			        $end_loop = 7;
			    else
			        $end_loop = $no_of_paginations;
			}
			echo "<ul class='pagination'>";
			// FOR ENABLING THE FIRST BUTTON
			if ($first_btn && $cur_page > 1) {
			    // echo"<li p='1' class='active'>First</li>";
			    echo"<li p='1' class='active'><a>First</a></li>";
			} else if ($first_btn) {
			    // echo"<li p='1' class='inactive'>First</li>";
			    echo"<li p='1' class='inactive'><a>First</a></li>";
			}
			// FOR ENABLING THE PREVIOUS BUTTON
			if ($previous_btn && $cur_page > 1) {
			    $pre = $cur_page - 1;
			    // echo "<li p='$pre' class='active'>Previous</li>";
			    echo"<li p='$pre' class='active'><a>Previous</a></li>";
			} else if ($previous_btn) {
			    // echo "<li class='inactive'>Previous</li>";
			    echo"<li class='inactive'><a>Previous</a></li>";
			}
			for ($i = $start_loop; $i <= $end_loop; $i++) {

			    if ($cur_page == $i){
			       // echo"<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
			       echo"<li p='$i' style='color:#fff;background-color:#006699;' class='active'><a>{$i}</a></li>";
			    }else{
			        // echo"<li p='$i' class='active'>{$i}</li>";
			        echo"<li p='$i' class='active'><a>{$i}</a></li>";
			    }
			}
			// TO ENABLE THE NEXT BUTTON
			if ($next_btn && $cur_page < $no_of_paginations) {
			    $nex = $cur_page + 1;
			    // echo"<li p='$nex' class='active'>Next</li>";
			    echo"<li p='$nex' class='active'><a>Next</a></li>";
			} else if ($next_btn) {
			    // echo"<li class='inactive'>Next</li>";
			    echo"<li class='inactive'><a>Next</a></li>";
			}
			// TO ENABLE THE END BUTTON
			if ($last_btn && $cur_page < $no_of_paginations) {
			    // echo"<li p='$no_of_paginations' class='active'>Last</li>";
			    echo"<li p='$no_of_paginations' class='active'><a>Last</a></li>";

			} else if ($last_btn) {
			    // echo"<li p='$no_of_paginations' class='inactive'>Last</li>";
			    echo"<li p='$no_of_paginations' class='inactive'><a>Last</a></li>";
			}
			echo "</ul>";
			echo "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/>
			      <input type='button' id='go_btn' class='go_button' value='Go'/>";
			$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
			echo $total_string;
			}
		echo "</div>";
	}



	function load_note(){
		$patient_id=$_POST['pid'];
		if($patient_id=='' || $patient_id==null){
			echo "<h2 style='padding-left:50px;color:#fff;'>No Data....</h2>";
		}else{
		echo "<div class='col-sm-12 col-md-12'>";
			$page = $_POST['page'];
			$cur_page = $page;
			$page -= 1;
			$per_page = 10;
			$previous_btn = true;
			$next_btn = true;
			$first_btn = true;
			$last_btn = true;
			$start = $page * $per_page;

			if(isset($_POST['page']) && $_POST['page']>=0)
			{
			//echo $start;
			//$per_page;
			$aa=$page+1;
			echo "<input type='hidden' value='$aa' class='hidden_val2' name='hidden_val2'>";
			//$res=R::getAll("SELECT * FROM prescriptionsub ORDER BY id DESC LIMIT $start,$per_page");	
			echo "
			    <div class='table-responsive cage1' id=''>
			    <table class='table table-condensed default_table'>
			    <thead>
			      <tr>
			        <th style='width: 18%;'>Date</th>
			        <th>Note</th>
			      </tr>
			    </thead>
			    <tbody>
			";
			$res=R::getAll("SELECT * FROM prescriptionmaster WHERE patient=$patient_id ORDER BY id DESC LIMIT $start,$per_page");
			if($res){
				foreach ($res as $value) {
			$notex=$value['note'];
			if($notex=='' || $notex==null){

			}else{
			echo "<tr>
				  <td>".$value['date']."</td>
				  <td>".$value['note']."</td>
				  </tr>";
		    }}
			echo "
			 </tbody></table><div>";
			}
			}


			//$query_pag_num=R::getAll("SELECT COUNT(*) FROM prescriptionsub pr,prescriptionmaster pm WHERE pm.patient=$patient_id AND pr.prescription_no=pm.id ORDER BY pr.id DESC LIMIT $start,$per_page");
			$query_pag_num=R::getAll("SELECT COUNT(*) FROM prescriptionmaster WHERE patient=$patient_id");	
			if($query_pag_num){
			foreach ($query_pag_num as $key => $value) {
				$count= $value['COUNT(*)'];
			}	
			$no_of_paginations = ceil($count / $per_page);
			/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
			if ($cur_page >= 7) {
			    $start_loop = $cur_page - 3;
			    if ($no_of_paginations > $cur_page + 3)
			        $end_loop = $cur_page + 3;
			    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			        $start_loop = $no_of_paginations - 6;
			        $end_loop = $no_of_paginations;
			    } else {
			        $end_loop = $no_of_paginations;
			    }
			} else {
			    $start_loop = 1;
			    if ($no_of_paginations > 7)
			        $end_loop = 7;
			    else
			        $end_loop = $no_of_paginations;
			}
			echo "<ul class='pagination'>";
			// FOR ENABLING THE FIRST BUTTON
			if ($first_btn && $cur_page > 1) {
			    // echo"<li p='1' class='active'>First</li>";
			    echo"<li p='1' class='active'><a>First</a></li>";
			} else if ($first_btn) {
			    // echo"<li p='1' class='inactive'>First</li>";
			    echo"<li p='1' class='inactive'><a>First</a></li>";
			}
			// FOR ENABLING THE PREVIOUS BUTTON
			if ($previous_btn && $cur_page > 1) {
			    $pre = $cur_page - 1;
			    // echo "<li p='$pre' class='active'>Previous</li>";
			    echo"<li p='$pre' class='active'><a>Previous</a></li>";
			} else if ($previous_btn) {
			    // echo "<li class='inactive'>Previous</li>";
			    echo"<li class='inactive'><a>Previous</a></li>";
			}
			for ($i = $start_loop; $i <= $end_loop; $i++) {

			    if ($cur_page == $i){
			       // echo"<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
			       echo"<li p='$i' style='color:#fff;background-color:#006699;' class='active'><a>{$i}</a></li>";
			    }else{
			        // echo"<li p='$i' class='active'>{$i}</li>";
			        echo"<li p='$i' class='active'><a>{$i}</a></li>";
			    }
			}
			// TO ENABLE THE NEXT BUTTON
			if ($next_btn && $cur_page < $no_of_paginations) {
			    $nex = $cur_page + 1;
			    // echo"<li p='$nex' class='active'>Next</li>";
			    echo"<li p='$nex' class='active'><a>Next</a></li>";
			} else if ($next_btn) {
			    // echo"<li class='inactive'>Next</li>";
			    echo"<li class='inactive'><a>Next</a></li>";
			}
			// TO ENABLE THE END BUTTON
			if ($last_btn && $cur_page < $no_of_paginations) {
			    // echo"<li p='$no_of_paginations' class='active'>Last</li>";
			    echo"<li p='$no_of_paginations' class='active'><a>Last</a></li>";

			} else if ($last_btn) {
			    // echo"<li p='$no_of_paginations' class='inactive'>Last</li>";
			    echo"<li p='$no_of_paginations' class='inactive'><a>Last</a></li>";
			}
			echo "</ul>";
			echo "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/>
			      <input type='button' id='go_btn' class='go_button' value='Go'/>";
			$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
			echo $total_string;
			}
		echo "</div>";
	}
	}

}
