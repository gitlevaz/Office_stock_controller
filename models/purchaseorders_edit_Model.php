
<?php
class purchaseorders_edit_Model extends model
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
		$res=R::getAll("SELECT * FROM ordermaster ORDER BY id DESC LIMIT $start,$per_page");	
		if($res){
		foreach ($res as $value) {
		echo "  <ul class='data_list' id='ul_".$value['id']."'>
		        <li>".$value['id']."</li>
				<li>".$value['date']."</li>
				<li></li>
				<li><button type='button' class='btn btn-danger btn_delete' id='d_".$value['id']."'>Delete</button></li>
				</ul>";
		echo "<button type='button' class='btn btn-primary btn_edit2' id='e_".$value['id']."'>Show / Edit Orders</button>
		      <div id='viewmoreTable'>";
		$index_id=$value['id'];
		$result=R::getAll("SELECT * FROM ordersub WHERE order_no=$index_id");
		echo " 	<div class='panel panel-default'>
  				<div><button type='button' class='btn btn-warning add_new' id='".$value['id']."'>
 					<span class='glyphicon glyphicon glyphicon-plus' aria-hidden='true'></span>
  				Add New</button></div>
  				<div class='panel-body'>
		        <div class='table-responsive' id='grncontent'>
				<table class='table table-condensed' id='table_".$value['id']."'>
			    <thead>
			      <tr>
			        <th>Item Code</th>
			        <th>Item Name</th>
			        <th>Unit Price</th>
			        <th>Qty</th>
			        <th></th>
			        <th>Amount</th>
			        <th></th>
			        <th></th>
			      </tr>
			    </thead>
	        	<tbody class='body_".$index_id."'>
			 ";
		foreach($result as $val){	
		echo "<tr class='datatr_".$val['id']."'>
				<td>
				<input type='hidden' value='".$val['item_code']."' class='sdata_val12_".$val['id']."'>
				<input type='text' value='".$val['item_code']."' class='sdata_val1_".$val['id']." form-control' style='width:80px' readonly></td>
				<td>
	        	<select id='stockitems' class='sdata_val2_".$val['id']." form-control' data-id-aa='".$val['id']."' data-id-bb='".$val['order_no']."' name='val_2' required=''>";
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
				<td>
					<input type='number' value='".$val['unit_price']."' style='width:100px' class='unitprice data_".$val['id']." sdata_val3_".$val['id']." form-control' data-id-aa='".$val['id']."' data-id-bb='".$val['grn_no']."' numberonly required='' min='1'>
				</td>
				<td>
					<input type='hidden' value='".$val['quantity']."' class='sdata_val11_".$val['id']."'>
				    <input type='number' value='".$val['quantity']."' style='width:100px' class='quantity sdata_val4_".$val['id']." form-control' id='".$val['id']."' data-id-bb='".$val['grn_no']."' numberonly required='' min='1'>
				</td>
				<td><input type='text' value='".$val['unit']."' class='sdata_val5_".$val['id']." form-control'  style='width:60px' readonly></td>";

	echo"	<td><input type='text' value='".number_format($val['amount'], 2, '.', '')."' id='amount_".$val['id']."' 
			class='totamount_".$val['order_no']." sdata_val8_".$val['id']." form-control'></td>
				<td><button type='button' class='btn btn-success btn_subedit' id='e_".$val['id']."' data-id-bb='".$val['order_no']."'>Update</button></td>
				<td><button type='button' class='btn btn-danger btn_subdelete' id='d_".$val['id']."' data-id-bb='".$val['order_no']."'>Delete</button><td>
				</tr>";
		}
		echo "
		<tr><td></td> <td></td> <td></td> <td></td>
		<td>Total</td><td><span class='sub_total_".$val['order_no']."'></span></td>
		<td></td> <td></td>
		</tr>
		</tbody></table></div></div></div>";
		echo "</div>";
		echo "<br>";
		}
		}
		}
		$query_pag_num=R::getAll("SELECT COUNT(*) FROM ordermaster");	
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
 $res=parent::delete2("ordersub",$id);
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
$val_10=$_POST['val_10'];

$val_13=$_POST['val_11'];
$val_14=$_POST['val_12'];
$val_15=$_POST['val_13'];
$val_16=$_POST['val_14'];

	if($val_15==$val_3){
 	//update item price
 		$rr=parent::update_item_price($val_3,$val_5);
 	//update item qty
 		//$rr=parent::update_item_quantity_22($val_3,$val_13,$val_14);
	}else{
		//$rr=parent::update_item_quantity_33($val_15,$val_3,$val_16,$val_6);
	}

  $rest=R::exec("UPDATE ordersub SET item_code='$val_3',item_name='$val_4',unit_price='$val_5',quantity='$val_6',unit='$val_7',amount='$val_10' WHERE id='$val_1' AND order_no='$val_2' ");
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
				<td><input type='text' class='val1 form-control' id='val1_".$_POST['count']."' style='width:80px' readonly></td>
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
				<td>
					<input type='number' value='' style='width:100px' class='val3 form-control' id='val3_".$_POST['count']."' numberonly required='' min='1'>
				</td>
				<td>
				    <input type='number' value='' style='width:100px' class='val4 form-control' id='val4_".$_POST['count']."' numberonly required='' min='1'>
				</td>
				<td><input type='text' value='' class='val5 form-control' id='val5_".$_POST['count']."'  style='width:60px' readonly></td>
				";
		echo"
				</td>
				<td><input type='text' value='' class='val8 form-control' id='val8_".$_POST['count']."'></td>
				<td><button type='button' class='btn btn-info new_save' id='newsave_".$_POST['count']."' data-id-invno='".$_POST['invoiceno']."'>Save</button></td>
				<td><button type='button' class='btn btn-danger new_remove' id='newrm_".$_POST['count']."'>Remove</button><td>
				</tr>";	
}

function save_new(){
$data=null;

$invno=$_POST['invoiceid'];
$val_1=$_POST['val1'];
$val_2=$_POST['val2'];
$val_3=$_POST['val3'];
$val_4=$_POST['val4'];
$val_5=$_POST['val5'];
$val_8=$_POST['val8'];

//update item price
$rr=parent::update_item_price($val_1,$val_3);
//update item qty
//$rr=parent::update_item_quantity_4($val_1,$val_4);

$res=parent::insert("ordersub",array("order_no"=>$invno,"item_code"=>$val_1,"item_name"=>$val_2,"unit_price"=>$val_3,"quantity"=>$val_4,"unit"=>$val_5,"amount"=>$val_8));
	// $res=parent::insert("grn_main",array());
if($res>=0){
		$rr=R::getAll("SELECT * FROM ordersub WHERE id=$res");	
		foreach ($rr as $val) {
		echo "<tr class='datatr_".$res."'>
				<td>
				<input type='hidden' value='".$val['item_code']."' class='sdata_val12_".$val['id']."'>
				<input type='text' value='".$val['item_code']."' class='sdata_val1_".$val['id']." form-control' style='width:80px'></td>
				<td>
	        	<select id='stockitems' class='sdata_val2_".$val['id']." form-control' data-id-aa='".$val['id']."' data-id-bb='".$val['order_no']."' name='val_2' required=''>";
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
				<td>
					<input type='number' value='".$val['unit_price']."' style='width:100px' class='unitprice data_".$val['id']." sdata_val3_".$val['id']." form-control' data-id-aa='".$val['id']."' data-id-bb='".$val['order_no']."' numberonly required='' min='1'>
				</td>
				<td>
				    <input type='hidden' value='".$val['quantity']."' class='sdata_val11_".$val['id']."'>
				    <input type='number' value='".$val['quantity']."' style='width:100px' class='quantity sdata_val4_".$val['id']."' id='".$val['id']." form-control' data-id-bb='".$val['order_no']."' numberonly required='' min='1'>
				</td>
				<td><input type='text' value='".$val['unit']."' class='sdata_val5_".$val['id']." form-control'  style='width:60px'></td>";
		echo"
				</td>
				<td><input type='text' value='".number_format($val['amount'], 2, '.', '')."' id='amount_".$val['id']."' 
				class='totamount_".$val['order_no']." sdata_val8_".$val['id']." form-control'></td>
				<td><button type='button' class='btn btn-success btn_subedit' id='e_".$val['id']."' data-id-bb='".$val['order_no']."'>Update</button></td>
				<td><button type='button' class='btn btn-danger btn_subdelete' id='d_".$val['id']."' data-id-bb='".$val['order_no']."'>Delete</button><td>
				</tr>";
			}
}else{
	echo "Errorr";
}
}

function deleteorder(){
 $data=null;
    	 $id=$_POST['id'];
	     R::exec("DELETE FROM ordersub WHERE order_no='$id'");
 	     $res=parent::delete2("ordermaster",$id);
 $data=array("reply"=>"10");
 echo json_encode($data); 
}

}
