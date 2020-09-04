
<?php
class Admin_users_edit_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}


function loadusers(){
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
$res=R::getAll("SELECT * FROM users ORDER BY id DESC LIMIT $start,$per_page");	
if($res){
echo "
    <div class='panel panel-default'>
    <div class='panel-body'>
    <div class='table-responsive cage1' id='grncontent'>
    <table class='table table-condensed'>
    <thead>
      <tr>
        <th>id</th>
        <th>Email</th>
        <th>Date</th>
        <th>Profile</th>
        <th>User Name</th>
        <th>Password</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
";

foreach ($res as $value) {
echo "<tr><td>".$value['id']."</td><td>".$value['email']."</td><td>".$value['modified_date']."</td><td>".$value['privilegesprofiles_id']."</td><td>".$value['username']."</td><td>".encryptDecrypt::decrypt($value['password'])."</td><td>".$value['status']."</td><td><button type='button' class='btn btn-primary btn_edit' id='e_".$value['id']."'>Edit</button></td>
</tr>";
}
echo "</tbody></table><div></div></div>";
}
}


$query_pag_num=R::getAll("SELECT COUNT(*) FROM users");	
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


function load(){
	$result=R::getAll("SELECT * FROM privilegesprofiles");	
	if($result){
		return $result;
	}
}

function load2(){
$userid=Session::get('user_id');
	$result=R::getAll("SELECT * FROM users WHERE id='$userid'");	
	if($result){
		return $result;
	}
}

function save(){
	$data=null;
	$email=$_POST['val_1'];
	$username=$_POST['val_2'];
	$proid=$_POST['val_5'];
    $password=encryptDecrypt::encrypt($_POST['val_3']);
    $current_date = date('d-m-Y');
    $userid=$_POST['val_x'];
    $pass=null;
	$result=R::getAll("SELECT password FROM users WHERE  id='$userid'");	
	if($result){
	foreach ($result as $value) {
	$pass=$value['password'];
	}
	}
	if(encryptDecrypt::encrypt($_POST['val_6']) == $pass){
     $rest=R::exec("UPDATE users SET email='$email',password='$password',modified_date='$current_date',status='1',username='$username',privilegesprofiles_id='$proid' WHERE id='$userid'");
// $res=parent::insert("users",array("email"=>$_POST['val_1'],"password"=>$password,"modified_date"=>$current_date,"status"=>"1","username"=>$_POST['val_2'],"privilegesprofiles_id"=>$_POST['val_5']));
     if($rest=='1'){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");	
     }
 }else{
     $data=array("reply"=>"30"); 	
 }
     echo json_encode($data);
 }

function edit_load(){
$data=null;
$va=(explode('_',$_POST['eid']));
$id=$va[1];
$result=R::getAll("SELECT * FROM users WHERE id=$id");
if($result){
foreach ($result as $value) {
$data=array("reply"=>"10","val_1"=>$value['id'],"val_2"=>$value['email'],"val_3"=>encryptDecrypt::decrypt($value['password']),"val_4"=>$value['modified_date'],"val_5"=>$value['status'],"val_6"=>$value['username'],"val_7"=>$value['privilegesprofiles_id']);
}
}else{
$data=array("reply"=>"20");    
}
echo json_encode($data);
}

}
