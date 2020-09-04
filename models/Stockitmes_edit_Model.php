
<?php
class Stockitmes_edit_Model extends model
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
 
function check_itmcode(){
$data=null;
$code=$_POST['code'];
$ids=$_POST['id'];
$rest=R::getAll("SELECT item_code FROM stockitems WHERE item_code='$code'");    
if($rest){
foreach ($rest as $value) {
 if($value['item_code']==$code){
    $rr=R::getAll("SELECT item_code FROM stockitems WHERE id='$ids'");
    foreach ($rr as $vv) {
     if($vv['item_code']==$code){
        $data=array("reply"=>"20");
        echo json_encode($data);
        return false;
     }
    }
    $data=array("reply"=>"10");
 }else{
    $data=array("reply"=>"20");
 }
}
}else{
$data=array("reply"=>"20"); 
}
echo json_encode($data);
}

function load_subcats(){
$data=null;	
$id=$_POST['id'];
$vx=$_POST['vv'];
$res=R::getAll("SELECT * FROM itemsubcategory WHERE category_id='$id'");	
if($res){
echo "<option>ty</option>";
	foreach ($res as $value) {
        if($value['id']==$vx){
        echo "<option value='".$value['id']."' selected>".$value['subcategory']."</option>";
        }else{
		echo "<option value='".$value['id']."'>".$value['subcategory']."</option>";
	}
    }  
}else{
echo "<option value='0'>-Select Sub Category-</option>";	
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
$res=R::getAll("SELECT * FROM stockitems ORDER BY id DESC LIMIT $start,$per_page");	
if($res){
echo "
    <div class='panel panel-default'>
    <div class='panel-body'>
    <div class='table-responsive cage1' id='grncontent'>
    <table class='table table-condensed'>
    <thead>
      <tr>
        <th>Itme Name</th>
        <th>Itme Code</th>
        <th>Model</th>
        <th>Quantity</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
";

foreach ($res as $value) {
echo "<tr><td>".$value['item_name']."</td><td>".$value['item_code']."</td><td>".$value['model']."</td><td>".$value['quantity']."</td><td>".$value['last_price']."</td><td><button type='button' class='btn btn-primary btn_edit' id='e_".$value['id']."'>Edit</button></td><td><button type='button' class='btn btn-danger btn_delete' id='d_".$value['id']."'>Delete</button><td></tr>";
}
echo "</tbody></table><div></div></div>";
}
}


$query_pag_num=R::getAll("SELECT COUNT(*) FROM stockitems");	
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


function edit_load(){
$data=null;
$va=(explode('_',$_POST['eid']));
$id=$va[1];
$result=R::getAll("SELECT * FROM stockitems WHERE id=$id");
if($result){
foreach ($result as $value) {
$data=array("reply"=>"10","val_1"=>$value['item_name'],"val_2"=>$value['model'],"val_3"=>$value['cost_price'],"val_4"=>$value['last_price'],"val_5"=>$value['reorder_limit'],"val_6"=>$value['category'],"val_7"=>$value['sub_category'],"val_8"=>$value['unit'],"val_9"=>$value['quantity'],"val_10"=>$value['selling_pring'],"val_11"=>$value['reorder_level'],"val_12"=>$value['id'],"val_13"=>$value['item_code'],"val_14"=>$value['issue_as'],"val_15"=>$value['qty_in']);
}
}else{
$data=array("reply"=>"20");    
}
echo json_encode($data);
}


function edit(){
$data=null;
$val_12=$_POST['val_12'];
$val_1=$_POST['val_1'];
$val_2=$_POST['val_2'];

if($_POST['val_3']=="" || $_POST['val_3']==null){
$val_3=0;
}else{
$val_3=$_POST['val_3'];
}

if($_POST['val_4']=="" || $_POST['val_4']==null){
$val_4=0;
}else{
$val_4=$_POST['val_4'];
}

if($_POST['val_5']=="" || $_POST['val_5']==null){
$val_5=0;
}else{
$val_5=$_POST['val_5'];
}
$val_6=$_POST['val_6'];
$val_7=$_POST['val_7'];
$val_8=$_POST['val_8'];

if($_POST['val_9']=="" || $_POST['val_9']==null){
$val_9=0;
}else{
$val_9=$_POST['val_9'];
}

if($_POST['val_10']=="" || $_POST['val_10']==null){
$val_10=0;
}else{
$val_10=$_POST['val_10'];
}

if($_POST['val_11']=="" || $_POST['val_11']==null){
$val_11=0;
}else{
$val_11=$_POST['val_11'];
}

$id=$_POST['hidden_val1'];

$val_13=$_POST['val_13'];

if($_POST['val_14']=="" || $_POST['val_14']==null){
$val_14=0;
}else{
$val_14=$_POST['val_14'];
}

     $rest=R::exec("UPDATE stockitems SET item_name='$val_1',model='$val_2',cost_price='$val_3',last_price='$val_4',reorder_limit='$val_5',category='$val_6',sub_category='$val_7',unit='$val_8',quantity='$val_9',selling_pring='$val_10',reorder_level='$val_11',item_code='$val_12',issue_as='$val_13',qty_in='$val_14' WHERE id='$id'");
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
 $res=parent::delete2("stockitems",$id);
$data=array("reply"=>"10");
echo json_encode($data);   
}

function search_key($no_of_record){
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
            $aa=$page+1;

    echo "<input type='hidden' value='$aa' class='hidden_val2' name='hidden_val2'>";
    echo "<div class='panel panel-default'>
    <div class='panel-body'>
    <div class='table-responsive cage1' id='grncontent'>
    <table class='table table-condensed'>
    <thead>
      <tr>
        <th>Itme Name</th>
        <th>Itme Code</th>
        <th>Model</th>
        <th>Quantity</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>";
    $keys=$_POST['keys'];
    $rs_arr=array();
    $total=0;
    $cols=R::getAll("SHOW COLUMNS FROM stockitems");
    foreach ($cols as $key => $value) {

        $res=R::getAll("SELECT pp.* FROM stockitems AS pp WHERE pp.".$value['Field']." LIKE '%$keys%' ORDER BY id DESC LIMIT $start,$per_page");   
        if($res){
        foreach ($res as $key => $val) {
        $bg_color='#fff';
        if (in_array($val['id'], $rs_arr)) {
        }else{
                $ids = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['id']);
                $item_name = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['item_name']);
                $item_code = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['item_code']);
                $model = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['model']);
                $price = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['last_price']);
        
                $input="<tr class='cmn_tr_".$val['id']."'>
                        <td>".$item_name."</td>
                        <td>".$item_code."</td>
                        <td>".$model."</td>
                        <td>".$val['quantity']."</td>
                        <td>".$price."</td>
                        <td><button type='button' class='btn btn-primary btn_edit' id='e_".$val['id']."'>Edit</button></td><td>
                        <button type='button' class='btn btn-danger btn_delete' id='d_".$val['id']."'>Delete</button><td>
                        ";     
                echo $input;
        }
        $rs_arr[]=$val['id'];   
        }
        }  
    }
            echo "</tr>
                 </tbody></table><div>";
    }
            $query_pag_num=R::getAll("SELECT COUNT(*) FROM customers"); 
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

}
