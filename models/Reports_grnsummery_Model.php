
<?php
class Reports_grnsummery_Model extends model
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
			$res=R::getAll("SELECT * FROM grnmain ORDER BY id DESC LIMIT $start,$per_page");	
			if($res){
			echo "
			    <div class='table-responsive cage1' id='grncontent'>
			    <table class='table table-condensed default_table'>
			    <thead>
			      <tr>
			        <th>Grn no</th>
			        <th>Supplier</th>
			        <th>Payment Methods</th>
			        <th>Grn Date</th>
			        <th>Invoice Number</th>
			        <th>Date</th>
			        <th>Amount</th>
			      </tr>
			    </thead>
			    <tbody>
			";
			$total=0;
			foreach ($res as $value) {
			$totalvalue=0;
			$grnno=$value['id'];
			$rr=R::getAll("SELECT SUM(amount) as aa FROM grnsub WHERE grn_no='$grnno'");
            foreach ($rr as $vv) {
             $totalvalue=$vv['aa'];
            }
            $total+=$totalvalue;
            //echo $rr[0];
			echo "<tr>
				  <td>".$value['id']."</td>
				  <td>".$value['supplier']."</td>
				  <td>".$value['payment_method']."</td>
				  <td>".$value['date']."</td>
				  <td>".$value['inv_no']."</td>
				  <td>".$value['act_date']."</td>
				  <td>".number_format($totalvalue, 2, '.', '')."</td>
				  </tr>";
			}
			echo "
			 <td></td><td></td><td></td><td></td><td></td>
			 <td>Toatal Value</td>
			 <td>".number_format($total, 2, '.', '')."</td></tr>
			 </tbody></table><div>";
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
		echo "</div>";
	}

	function search(){
		$from_date=$_POST['val1'];
		$to_date=$_POST['val2'];
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
			$res=R::getAll("SELECT * FROM grnmain WHERE date BETWEEN '$from_date' AND '$to_date' ORDER BY id DESC LIMIT $start,$per_page");	
			if($res){
			echo "
			    <div class='table-responsive cage1' id='grncontent'>
			    <table class='table table-condensed default_table'>
			    <thead>
			      <tr>
			        <th>Grn no</th>
			        <th>Supplier</th>
			        <th>Payment Methods</th>
			        <th>Grn Date</th>
			        <th>Invoice Number</th>
			        <th>Date</th>
			        <th>Amount</th>
			      </tr>
			    </thead>
			    <tbody>
			";
			$total=0;
			foreach ($res as $value) {
			$totalvalue=0;
			$grnno=$value['id'];
			$rr=R::getAll("SELECT SUM(amount) as aa FROM grnsub WHERE grn_no='$grnno'");
            foreach ($rr as $vv) {
             $totalvalue=$vv['aa'];
            }
            $total+=$totalvalue;
            //echo $rr[0];
			echo "<tr>
				  <td>".$value['id']."</td>
				  <td>".$value['supplier']."</td>
				  <td>".$value['payment_method']."</td>
				  <td>".$value['date']."</td>
				  <td>".$value['inv_no']."</td>
				  <td>".$value['act_date']."</td>
				  <td>".number_format($totalvalue, 2, '.', '')."</td>
				  </tr>";
			}
			echo "
			 <td></td><td></td><td></td><td></td><td></td>
			 <td>Toatal Value</td>
			 <td>".number_format($total, 2, '.', '')."</td></tr>
			 </tbody></table><div>";
			}
			}


			$query_pag_num=R::getAll("SELECT COUNT(*) FROM grnmain WHERE date BETWEEN '$from_date' AND '$to_date'");	
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
