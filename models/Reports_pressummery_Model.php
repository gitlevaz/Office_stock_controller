
<?php
class Reports_pressummery_Model extends model
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
			$res=R::getAll("SELECT * FROM prescriptionmaster ORDER BY id DESC LIMIT $start,$per_page");	
			if($res){
			echo "
			    <div class='table-responsive cage1' id=''>
			    <table class='table table-condensed default_table'>
			    <thead>
			      <tr>
			        <th>Pres..no</th>
			        <th>Customer</th>
			        <th>Date</th>
			        <th>Time</th>
			        <th>Note</th>
			      </tr>
			    </thead>
			    <tbody>
			";
			$checktotal=0;
			foreach ($res as $value) {

			$iid=$value['id'];
			$date="";
			$rs=R::getAll("SELECT date,patient FROM prescriptionmaster WHERE id='$iid'");
 				if($res){
 					foreach ($rs as $val) {
 						$date=$val['date'];
 						$patient=parent::get_patient($val['patient']);
 					}
 				}
			echo "<tr>
				  <td>".$value['id']."</td>
				  <td>".$patient."</td>
				  <td>".$date."</td>
				  <td>".$value['act_time']."</td>
				  <td>".$value['note']."</td>
				  </tr>";
			}
			echo "
			 </tbody></table><div>";
			}
			}


			$query_pag_num=R::getAll("SELECT COUNT(*) FROM prescriptionmaster");	
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
		$pres_no=$_POST['val4'];
	    $rest=R::exec("DELETE from presrptsumm");

	    if($pres_no=='' || $pres_no==null){
		$query=R::getAll("SELECT id FROM prescriptionmaster WHERE date BETWEEN '$from_date' AND '$to_date'");
        }else{
        $query=R::getAll("SELECT id FROM prescriptionmaster WHERE id='$pres_no'");
        }

        if($from_date=='' && $to_date=='' && $pres_no==''){
		$query=R::getAll("SELECT id FROM prescriptionmaster");
        }

        foreach ($query as $value) {
        	$ids=$value['id'];
        	$res=R::getAll("SELECT * FROM prescriptionmaster WHERE id='$ids'");
	        	foreach ($res as $xx) {
		               $res=parent::insert("presrptsumm",array("pres_id"=>$xx['id'],"patient"=>$xx['patient'],"date"=>$xx['date'],"act_date"=>$xx['act_date'],"act_time"=>$xx['act_time'],"issue_status"=>$xx['issue_status'],"note"=>$xx['note']));

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
			$res=R::getAll("SELECT * FROM presrptsumm ORDER BY id DESC LIMIT $start,$per_page");	
			if($res){
			echo "
			    <div class='table-responsive cage1' id=''>
			    <table class='table table-condensed default_table'>
			    <thead>
			      <tr>
			        <th>Pres..no</th>
			        <th>Customer</th>
			        <th>Date</th>
			        <th>Time</th>
			        <th>Note</th>
			      </tr>
			    </thead>
			    <tbody>
			";
			$total=0;
			$status=null;
			foreach ($res as $value) {

			$iid=$value['pres_id'];
			$date="";
			$rs=R::getAll("SELECT date,patient FROM prescriptionmaster WHERE id='$iid'");
 				if($res){
 					foreach ($rs as $val) {
 						$date=$val['date'];
 						$patient=parent::get_patient($val['patient']);
 					}
 				}
			echo "<tr>
				  <td>".$value['pres_id']."</td>
				  <td>".$patient."</td>
				  <td>".$date."</td>
				  <td>".$value['act_time']."</td>
				  <td>".$value['note']."</td>
				  </tr>";
			}
			echo "
			 </tbody></table><div>";
			}
			}


			$query_pag_num=R::getAll("SELECT COUNT(*) FROM presrptsumm");	
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
