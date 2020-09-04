
<?php
class Reports_invoices_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

	function load(){
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
			$res=R::getAll("SELECT * FROM invoicesub ORDER BY id DESC LIMIT $start,$per_page");	
			if($res){
			echo "
			    <div class='table-responsive cage1' id=''>
			    <table class='table table-condensed default_table'>
			    <thead>
			      <tr>
			        <th>Invoice no</th>
			        <th>Date</th>
			        <th>Item</th>
			        <th>Unit Price</th>
			        <th>Quantity</th>
			        <th>Unit</th>
			        <th>F.o.c</th>
			        <th>Amount</th>
			      </tr>
			    </thead>
			    <tbody>
			";
			$total=0;
			foreach ($res as $value) {
			$total+=$value['amount'];
			$iid=$value['invoce_no'];
			$date="";
			$rs=R::getAll("SELECT date FROM invoicemaster WHERE id='$iid'");
 				if($res){
 					foreach ($rs as $val) {
 						$date=$val['date'];
 					}
 				}
			echo "<tr>
				  <td>".$value['invoce_no']."</td>
				  <td>".$date."</td>
				  <td>".$value['item_name']."</td>
				  <td>".$value['unit_price']."</td>
				  <td>".$value['quantity']."</td>
				  <td>".$value['unit']."</td>
				  <td></td>
				  <td>".number_format($value['amount'], 2, '.', '')."</td>
				  </tr>";
			}
			echo "
			 </td><td></td><td></td><td></td><td></td><td></td><td></td>
			 <td>Toatal Value</td>
			 <td>".number_format($total, 2, '.', '')."</td></tr>
			 </tbody></table><div>";
			}
			}


			$query_pag_num=R::getAll("SELECT COUNT(*) FROM invoicesub");	
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

	function search(){
		$from_date=$_POST['val1'];
		$to_date=$_POST['val2'];
	    $rest=R::exec("DELETE from invoicereport");
		$query=R::getAll("SELECT id FROM invoicemaster WHERE date BETWEEN '$from_date' AND '$to_date'");
        foreach ($query as $value) {
        	$ids=$value['id'];
        	$res=R::getAll("SELECT * FROM invoicesub WHERE invoce_no='$ids'");
	        	foreach ($res as $xx) {
		               $res=parent::insert("invoicereport",array("invoce_no"=>$xx['invoce_no'],"item_code"=>$xx['item_code'],"item_name"=>$xx['item_name'],"unit_price"=>$xx['unit_price'],"quantity"=>$xx['quantity'],"unit"=>$xx['unit'],"amount"=>$xx['amount']));

	        	}
        }


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
			$res=R::getAll("SELECT * FROM invoicereport ORDER BY id DESC LIMIT $start,$per_page");	
			if($res){
			echo "
			    <div class='table-responsive cage1' id=''>
			    <table class='table table-condensed default_table'>
			    <thead>
			      <tr>
			        <th>Invoice no</th>
			        <th>Date</th>
			        <th>Item</th>
			        <th>Unit Price</th>
			        <th>Quantity</th>
			        <th>Unit</th>
			        <th>F.o.c</th>
			        <th>Amount</th>
			      </tr>
			    </thead>
			    <tbody>
			";
			$total=0;
			foreach ($res as $value) {
			$total+=$value['amount'];
			$iid=$value['invoce_no'];
			$date="";
			$rs=R::getAll("SELECT date FROM invoicemaster WHERE id='$iid'");
 				if($res){
 					foreach ($rs as $val) {
 						$date=$val['date'];
 					}
 				}
			echo "<tr>
				  <td>".$value['invoce_no']."</td>
				  <td>".$date."</td>
				  <td>".$value['item_name']."</td>
				  <td>".$value['unit_price']."</td>
				  <td>".$value['quantity']."</td>
				  <td>".$value['unit']."</td>
				  <td></td>
				  <td>".number_format($value['amount'], 2, '.', '')."</td>
				  </tr>";
			}
			echo "
			</td><td></td><td></td><td></td><td></td><td></td><td></td>
			 <td>Toatal Value</td>
			 <td>".number_format($total, 2, '.', '')."</td></tr>
			 </tbody></table><div>";
			}
			}


			$query_pag_num=R::getAll("SELECT COUNT(*) FROM invoicereport");	
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
