
<?php
class Itemcategory_subcategoryedit_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function load(){
$res=R::getAll("SELECT * FROM itemcategory ");	
if($res){
return $res;
}
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
$res=R::getAll("SELECT * FROM itemsubcategory ORDER BY id DESC LIMIT $start,$per_page");	
if($res){
echo "
    <div class='panel panel-default'>
    <div class='panel-body'>
    <div class='table-responsive cage1' id='grncontent'>
    <table class='table table-condensed'>
    <thead>
      <tr>
        <th>Category</th>
        <th>Sub sategory</th>
        <th></th>
      </tr>
    </thead>
        <tbody>
";

foreach ($res as $value) {
$vv=$value['category_id'];
$re=R::getAll("SELECT category_name FROM itemcategory WHERE id='$vv'");
if($re){
foreach ($re as $val) {
echo "<tr><td>".$val['category_name']."</td><td>".$value['subcategory']."</td><td><button type='button' class='btn btn-primary btn_edit' id='e_".$value['id']."'>Edit</button></td><td><button type='button' class='btn btn-danger btn_delete' id='d_".$value['id']."' >Delete</button><td></tr>";
}
}
}
echo "</tbody></table></div>";
}
}


$query_pag_num=R::getAll("SELECT COUNT(*) FROM itemsubcategory");	
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
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span></div></div>";
echo $total_string;
}
}

function edit_load(){
$data=null;
$va=(explode('_',$_POST['eid']));
$id=$va[1];
$result=R::getAll("SELECT * FROM itemsubcategory WHERE id=$id");
if($result){
foreach ($result as $value) {
$data=array("reply"=>"10","val_1"=>$value['subcategory'],"val_2"=>$value['category_id'],"val_10"=>$value['id']);
}
}else{
$data=array("reply"=>"20");    
}
echo json_encode($data);
}

function edit(){
$data=null;
$val_1=$_POST['val_1'];
$val_2=$_POST['val_2'];
$id=$_POST['hidden_val1'];
     $rest=R::exec("UPDATE itemsubcategory SET category_id='$val_1',subcategory='$val_2' WHERE id='$id'");
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
$res=parent::delete2("itemsubcategory",$id);
$data=array("reply"=>"10");
echo json_encode($data);   
}

}
