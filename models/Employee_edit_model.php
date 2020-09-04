
<?php
class Employee_edit_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}


	function load_pages1(){
		$res=R::getAll("SELECT * FROM itemcategory ");	
		
		if($res){
			// foreach ($res as & $value) {
		// 		print_r($value[0]);
		// die();
		// print_r($res);
		// 		die();
				return $res;
				
			// }


		}
		}

		
function load_pages(){      
	$page = $_POST['page'];
	$cur_page = $page;
	$page -= 1;
	$per_page = 100;
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
	$res=R::getAll("SELECT * FROM employee ORDER BY id");	
	if($res){
	echo "
		<div class='panel panel-default'>
		<div class='panel-body'>
		<div class='table-responsive cage1' id='grncontent'>
		<table class='table table-condensed'>
		<thead>
		  <tr>
			<th>Cus No<s/th>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>Email</th>
			<th></th>
		  </tr>
		</thead>
			<tbody>";
	
	foreach ($res as $value) {
	echo "<tr><td>".$value['id']."</td><td>".$value['first_name']."</td><td>".$value['last_name']."</td><td>".$value['email']."</td><td><button type='button' class='btn btn-primary btn_edit' id='e_".$value['id']."'>Edit</button></td><td><button type='button' class='btn btn-danger btn_delete'  id='e_".$value['id']."'>Delete</button><td></tr>";
	}
	echo "</tbody></table><div></div></div>";
	}
	}
	
	
	}

}
