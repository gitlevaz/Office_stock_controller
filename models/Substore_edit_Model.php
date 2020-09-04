
<?php
class Substore_edit_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function load_pages(){
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
$res=R::getAll("SELECT * FROM substore ORDER BY id DESC LIMIT $start,$per_page");	
if($res){
echo "
    <div class='panel panel-default'>
    <div class='panel-body'>
    <div class='table-responsive cage1' id='grncontent'>
    <table class='table table-condensed'>
    <thead>
      <tr>
        <th>Rep Name</th>
        <th>Branch Name</th>
        <th>added_date</th>
        <th></th>
      </tr>
    </thead>
        <tbody>
";

foreach ($res as $value) {
echo "<tr><td>".$value['repname']."</td><td>".$value['branch_name']."</td><td>".$value['added_date']."</td><td><button type='button' class='btn btn-primary btn_edit' id='e_".$value['id']."'>Edit</button></td><td><button type='button' class='btn btn-danger btn_delete' id='d_".$value['id']."'>Delete</button><td></tr>";
}
echo "</tbody></table>";
}
}


$query_pag_num=R::getAll("SELECT COUNT(*) FROM substore");	
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
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span><div></div></div>";
echo $total_string;
}
}


function edit_load(){
$data=null;
$va=(explode('_',$_POST['eid']));
$id=$va[1];
$result=R::getAll("SELECT * FROM substore WHERE id=$id");
if($result){
foreach ($result as $value) {
$data=array("reply"=>"10","val_1"=>$value['repname'],"val_2"=>$value['address1'],"val_3"=>$value['telephone'],"val_4"=>$value['contact_person'],"val_5"=>$value['credit_limit'],"val_6"=>$value['bank_name'],"val_7"=>$value['added_date'],"val_8"=>$value['branch_name'],"val_9"=>$value['address2'],"val_10"=>$value['email'],"val_11"=>$value['contact_no'],"val_12"=>$value['opening_balance'],"val_13"=>$value['account_no'],"val_14"=>$value['id']);
}
}else{
$data=array("reply"=>"20");    
}
echo json_encode($data);
}


function edit(){
$data=null;

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
$id=$_POST['hidden_val1'];

     $rest=R::exec("UPDATE substore SET repname='$val2',address1='$val3',telephone='$val4',contact_person='$val5',credit_limit='$val6',bank_name='$val7',added_date='$val8',branch_name='$val9',address2='$val10',email='$val11',contact_no='$val12',opening_balance='$val13',account_no='$val14' WHERE id='$id'");
     if($rest=='1'){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");    
     }
echo json_encode($data);   
}

function delete(){
$data=null;
$va=(explode('_',$_POST['did']));
$id=$va[1];
$res=parent::delete2("substore",$id);
$data=array("reply"=>"10");
echo json_encode($data);   
}
}
