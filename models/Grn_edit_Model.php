
<?php
class Grn_edit_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

	function load(){
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
		$res=R::getAll("SELECT * FROM grnmain ORDER BY id DESC LIMIT $start,$per_page");	
		if($res){
		foreach ($res as $value) {
		echo "  <ul class='data_list'>
		        <li>Grn Number <strong>".$value['id']."</strong></li>
				<li>".$value['payment_method']."</li>
				<li>".$value['date']."</li>
				<li></li>
				<li><button type='button' class='btn btn-danger btn_delete' id='d_".$value['id']."'>Delete Grn</button></li>
				</ul>";
		echo "<button type='button' class='btn_edit2' id='e_".$value['id']."'>Show / Edit Grn</button>
		      <div id='viewmoreTable'>";
		$grn_id=$value['id'];
		$result=R::getAll("SELECT * FROM grnsub WHERE grn_no=$grn_id");
		echo " 	<div class='panel panel-default'>
  				<div><button type='button' class='btn btn-warning add_new' id='".$value['id']."'>Add New</button></div>
  				<div class='panel-body'>
		        <div class='table-responsive' id='grncontent'>
				<table class='table table-condensed' id='table_".$value['id']."'>
			    <thead>
			      <tr>
			        <th>Item Code</th>
			        <th>Item Name</th>
			        <th>FOC</th>
			        <th>Unit Price</th>
			        <th>Qty</th>
			        <th></th>

			        <th></th>
			        <th>Amount</th>
			        <th></th>
			        <th></th>
			      </tr>
			    </thead>
	        	<tbody class='body_".$grn_id."'>
			 ";
		foreach($result as $val){	
		echo "<tr class='datatr_".$val['id']."'>
				<td>
				<input type='hidden' value='".$val['item_code']."' class='sdata_val12_".$val['id']."'>
				<input type='text' value='".$val['item_code']."' class='sdata_val1_".$val['id']." form-control' style='width:80px' readonly></td>
				<td>
	        	<select id='stockitems' class='sdata_val2_".$val['id']." form-control' data-id-aa='".$val['id']."' data-id-bb='".$val['grn_no']."' name='val_2' required='' style='width:100px'>";
	        	echo "<option selected value=";
	        	echo $val['item_code'];
	        	echo ">";
	        	echo $val['item_name'];
	        	echo "</option>";
		$rr=R::getAll("SELECT * FROM stockitems");	
		foreach ($rr as $vv) {
		echo "<option value=";
		echo $vv['id'];
		echo  ">";
		echo $vv['item_name'];
		echo "</option>";
		}
	    echo"   </select>
				</td>

				<td>";
		    $check='';
		    if($val['foc']=='1'){
		    $check='checked';
		    }
		echo"
				   <input type='checkbox' class='sdata_val10_".$val['id']."'' name='' value='' id='foc_check' data-id-aa='".$val['id']."' data-id-bb='".$val['grn_no']."' ".$check.">
				</td>
				<td>
					<input type='number' value='".$val['unit_price']."' style='width:100px' class='unitprice data_".$val['id']." sdata_val3_".$val['id']." form-control' data-id-aa='".$val['id']."' data-id-bb='".$val['grn_no']."' numberonly required='' min='1'>
				</td>
				<td>
				    <input type='hidden' value='".$val['quantity']."' class='sdata_val11_".$val['id']."'>
				    <input type='number' value='".$val['quantity']."' style='width:100px' class='quantity sdata_val4_".$val['id']." form-control' id='".$val['id']."' data-id-bb='".$val['grn_no']."' numberonly required='' min='1'>
				</td>
				<td><input type='text' value='".$val['unit']."' class='sdata_val5_".$val['id']." form-control'  style='width:50px' readonly></td>
			
				<td>
				<select name='val_7' class='sdata_val7_".$val['id']." form-control' style='width:100px'>";
	        	echo "<option selected>";
	        	echo $val['container'];
	        	echo "</option>";
		echo"
                                <option>Packs</option>
                                <option>Pkts</option>
                                <option>Jar</option>
                                <option>Nos</option>
                                <option>Cans</option>
                                <option>Tins</option>
                                <option>Tub</option>
                                <option>Boxes</option>
                                <option>Cases</option>
                                <option>Glass Bots</option>
                                <option>Ganis</option>
                                <option>Pet Bots</option>
                                <option>Satches</option>
                                <option>Blister Pack</option>
                                <option>Bars</option>
                                <option>Pots</option>
                                <option>Portions</option>
                </select>
				</td>
				<td><input type='text' value='".number_format($val['amount'], 2, '.', '')."' id='amount_".$val['id']."' 
				class='totamount_".$val['grn_no']." sdata_val8_".$val['id']." form-control' style='width:100px'></td>
				<td><button type='button' class='btn btn-success btn_subedit' id='e_".$val['id']."' data-id-bb='".$val['grn_no']."'>Update</button></td>
				<td><button type='button' class='btn btn-danger btn_subdelete' id='d_".$val['id']."' data-id-bb='".$val['grn_no']."'>Delete</button><td>
				</tr>";
		}
		echo "
		<tr><td></td> <td></td> <td></td> <td></td> <td></td><td></td> <td></td> <td></td>
		<td>Total</td><td><span class='sub_total_".$val['grn_no']."'></span></td>
		<td></td> <td></td>
		</tr>
		</tbody></table></div></div></div>";
		echo "</div>";
		echo "<br>";
		}
		}
		}
		$query_pag_num=R::getAll("SELECT COUNT(*) FROM grnmain");	
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
	}

function delete_sub(){
 $data=null;
 $id=$_POST['id'];
 $res=parent::delete2("grnsub",$id);
 $data=array("reply"=>"10");
 echo json_encode($data);  
}

function edit_sub(){
$data=null;
$val_1=$_POST['val_1'];
$val_2=$_POST['val_2'];
$val_3=$_POST['val_3'];
$val_4=$_POST['val_4'];
$val_5=$_POST['val_5'];
$val_6=$_POST['val_6'];
$val_7=$_POST['val_7'];
$val_8=$_POST['val_8'];
$val_9=$_POST['val_9'];
$val_10=$_POST['val_10'];
$val_11=$_POST['val_11'];
$val_12=$_POST['val_12'];

$val_13=$_POST['val_13'];
$val_14=$_POST['val_14'];
$val_15=$_POST['val_15'];
$val_16=$_POST['val_16'];
	
	if($val_15==$val_3){
 	//update item price
 		$rr=parent::update_item_price($val_3,$val_5);
 	//update item qty
 		$rr=parent::update_item_quantity_2($val_3,$val_13,$val_14);
	}else{
		$rr=parent::update_item_quantity_3($val_15,$val_3,$val_16,$val_6);
	}

     $rest=R::exec("UPDATE grnsub SET item_code='$val_3',item_name='$val_4',unit_price='$val_5',quantity='$val_6',unit='$val_7',containers='$val_8',container='$val_9',amount='$val_10',exp_date='$val_11',foc='$val_12' WHERE id='$val_1' AND grn_no='$val_2' ");
     if($rest=='1'){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");    
     }
echo json_encode($data);  
}

function load_item(){
		$data=null;
		$id=$_POST['id'];
		$res=R::getAll("SELECT * FROM stockitems WHERE id='$id'");	
		if($res){
			foreach ($res as $val) {
				$data=array("reply"=>"10","val_1"=>$val['id'],"val_2"=>$val['last_price'],"val_3"=>$val['unit']);
			}
		}else{
     	$data=array("reply"=>"20");
		}
		echo json_encode($data);
}

function create_new(){
		echo "<tr class='".$_POST['count']."'>
				<td>
			    <input type='text' class='val1 form-control' id='val1_".$_POST['count']."' style='width:80px' readonly></td>
				<td>
	        	<select class='addnew_stockitems stockitems form-control' id='val2_".$_POST['count']."' name='val2' required=''>";
	        	echo "<option selected value=";
	        	echo ">";
	        	echo "</option>";
		$rr=R::getAll("SELECT * FROM stockitems");	
		foreach ($rr as $vv) {
		echo "<option value='".$vv['id']."'>".$vv['item_name']."</option>";
		}
	    echo"   </select>
				</td>
				<td><input type='text' class='form-control datepicker val_9' id='val9_".$_POST['count']."' name='val_9' placeholder='date' required='' style='width:100px'></td>
				<td><input type='checkbox' name='' value='' class='val10_".$_POST['count']."' id='foc_check2' data-id-index='val10_".$_POST['count']."'></td>
				<td>
					<input type='number' value='' style='width:100px' class='val3 form-control' id='val3_".$_POST['count']."' numberonly required='' min='1'>
				</td>
				<td>
				    <input type='number' value='' style='width:100px' class='val4 form-control' id='val4_".$_POST['count']."' numberonly required='' min='1'>
				</td>
				<td><input type='text' value='' class='val5 form-control' id='val5_".$_POST['count']."'  style='width:50px' readonly></td>
				<td><input type='text' value='' class='val6 form-control' id='val6_".$_POST['count']."' style='width:80px'></td>
				<td>
				<select name='val7' class='form-control' id='val7_".$_POST['count']."'>";
	        	echo "<option selected>";
	        	echo "</option>";
		echo"
                                <option>Packs</option>
                                <option>Pkts</option>
                                <option>Jar</option>
                                <option>Nos</option>
                                <option>Cans</option>
                                <option>Tins</option>
                                <option>Tub</option>
                                <option>Boxes</option>
                                <option>Cases</option>
                                <option>Glass Bots</option>
                                <option>Ganis</option>
                                <option>Pet Bots</option>
                                <option>Satches</option>
                                <option>Blister Pack</option>
                                <option>Bars</option>
                                <option>Pots</option>
                                <option>Portions</option>
                </select>
				</td>
				<td><input type='text' value='' class='val8 form-control' id='val8_".$_POST['count']."' style='width:100px'></td>
				<td><button type='button' class='btn btn-info new_save' id='newsave_".$_POST['count']."' data-id-grnno='".$_POST['grnno']."'>Save</button></td>
				<td><button type='button' class='btn btn-danger new_remove' id='newrm_".$_POST['count']."'>Remove</button><td>
				</tr>";	
}

function save_new(){
$data=null;

$grnno=$_POST['grnid'];
$val_1=$_POST['val1'];
$val_2=$_POST['val2'];
$val_3=$_POST['val3'];
$val_4=$_POST['val4'];
$val_5=$_POST['val5'];

if($_POST['val6']=='' || $_POST['val6']==null){
$val_6='0';
}else{
$val_6=$_POST['val6'];
}

$val_7=$_POST['val7'];
$val_8=$_POST['val8'];
$val_9=$_POST['val9'];
$val_10=$_POST['val10'];

$res=parent::insert("grnsub",array("grn_no"=>$grnno,"item_code"=>$val_1,"item_name"=>$val_2,"unit_price"=>$val_3,"quantity"=>$val_4,"unit"=>$val_5,"containers"=>$val_6,"container"=>$val_7,"amount"=>$val_8,"exp_date"=>$val_9,"foc"=>$val_10));
	// $res=parent::insert("grn_main",array());
if($res>=0){
		$rr=R::getAll("SELECT * FROM grnsub WHERE id=$res");	
		foreach ($rr as $val) {
		echo "<tr class='datatr_".$res."'>
				<td>
				<input type='hidden' value='".$val['item_code']."' class='sdata_val12_".$val['id']."'>
				<input type='text' value='".$val['item_code']."' class='sdata_val1_".$val['id']." form-control' style='width:80px'></td>
				<td>
	        	<select id='stockitems' class='sdata_val2_".$val['id']." form-control' data-id-aa='".$val['id']."' data-id-bb='".$val['grn_no']."' name='val_2' required=''>";
	        	echo "<option selected value=";
	        	echo $val['item_code'];
	        	echo ">";
	        	echo $val['item_name'];
	        	echo "</option>";
		$rr=R::getAll("SELECT * FROM stockitems");	
		foreach ($rr as $vv) {
		echo "<option value=";
		echo $vv['id'];
		echo  ">";
		echo $vv['item_name'];
		echo "</option>";
		}
		echo "</select>
		      <td>
		         <input type='text' value='".$val['exp_date']."' class='sdata_val9_".$val['id']." datepicker form-control' form-control datepicker val_9' name='val_9' placeholder='date' required='' style='width:100px'>
		      </td>";
	        $check='';
		    if($val['foc']=='1'){
		    $check='checked';
		    }
	    echo"   <td>
	    		<input type='checkbox' class='sdata_val10_".$val['id']."' form-control' name='' value='' id='foc_check' data-id-aa='".$val['id']."' data-id-bb='".$val['grn_no']."' ".$check.">
				</td>
				<td>
					<input type='number' value='".$val['unit_price']."' style='width:100px' class='unitprice data_".$val['id']." sdata_val3_".$val['id']." form-control' data-id-aa='".$val['id']."' data-id-bb='".$val['grn_no']."' numberonly required='' min='1'>
				</td>
				<td>
				    <input type='hidden' value='".$val['quantity']."' class='sdata_val11_".$val['id']."'>
				    <input type='number' value='".$val['quantity']."' style='width:100px' class='quantity sdata_val4_".$val['id']."' id='".$val['id']."' data-id-bb='".$val['grn_no']." form-control' numberonly required='' min='1'>
				</td>
				<td><input type='text' value='".$val['unit']."' class='sdata_val5_".$val['id']." form-control'  style='width:50px'></td>
				<td><input type='text' value='".$val['containers']."' class='sdata_val6_".$val['id']." form-control' style='width:80px'></td>
				<td>
				<select name='val_7' class='sdata_val7_".$val['id']." form-control'>";
	        	echo "<option selected>";
	        	echo $val['container'];
	        	echo "</option>";
		echo"
                                <option>Packs</option>
                                <option>Pkts</option>
                                <option>Jar</option>
                                <option>Nos</option>
                                <option>Cans</option>
                                <option>Tins</option>
                                <option>Tub</option>
                                <option>Boxes</option>
                                <option>Cases</option>
                                <option>Glass Bots</option>
                                <option>Ganis</option>
                                <option>Pet Bots</option>
                                <option>Satches</option>
                                <option>Blister Pack</option>
                                <option>Bars</option>
                                <option>Pots</option>
                                <option>Portions</option>
                </select>
				</td>
				<td><input type='text' value='".number_format($val['amount'], 2, '.', '')."' id='amount_".$val['id']."' 
				class='totamount_".$val['grn_no']." sdata_val8_".$val['id']." form-control' style='width:100px'></td>
				<td><button type='button' class='btn btn-success btn_subedit' id='e_".$val['id']."' data-id-bb='".$val['grn_no']."'>Update</button></td>
				<td><button type='button' class='btn btn-danger btn_subdelete' id='d_".$val['id']."' data-id-bb='".$val['grn_no']."'>Delete</button><td>
				</tr>";
			}
}else{
	echo "Errorr";
}
}

function deletegrn(){
 $data=null;
    	 $id=$_POST['id'];
	     R::exec("DELETE FROM grnsub WHERE grn_no='$id'");
 	     $res=parent::delete2("grnmain",$id);
 $data=array("reply"=>"10");
 echo json_encode($data); 
}

}
