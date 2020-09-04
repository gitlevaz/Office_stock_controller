
<?php
class Customers_edit_Model extends model
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
$res=R::getAll("SELECT * FROM customers ORDER BY id DESC LIMIT $start,$per_page");	
if($res){
echo "
    <div class='panel panel-default'>
    <div class='panel-body'>
    <div class='table-responsive cage1' id='grncontent'>
    <table class='table table-condensed'>
    <thead>
      <tr>
        <th>Cus No</th>
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

function search_key($no_of_record){
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
            $aa=$page+1;

    echo "<input type='hidden' value='$aa' class='hidden_val2' name='hidden_val2'>";
    echo "<div class='panel panel-default'>
    <div class='panel-body'>
    <div class='table-responsive cage1' id='grncontent'>
    <table class='table table-condensed'>
    <thead>
      <tr>
        <th>Cus No</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th></th>
      </tr>
    </thead>
        <tbody>";
    $keys=$_POST['keys'];
    $rs_arr=array();
    $total=0;
    $cols=R::getAll("SHOW COLUMNS FROM customers");
    foreach ($cols as $key => $value) {

        $res=R::getAll("SELECT pp.* FROM customers AS pp WHERE pp.".$value['Field']." LIKE '%$keys%' ORDER BY id DESC LIMIT $start,$per_page");   
        if($res){
        foreach ($res as $key => $val) {
        $bg_color='#fff';
        if (in_array($val['id'], $rs_arr)) {
        }else{
                $ids = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['id']);
                $f_name = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['first_name']);
                $l_name = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['last_name']);
                $address = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['address']);
                $p_number = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['contact_number']);
                $email = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['email']);
                $age = preg_replace("/(>|^)([^<]+)(?=<|$)/esx","'\\1' . str_replace('" . $keys . "', '<span>" . $keys . "</span>', '\\2')",$val['age']);
        
                $input="<tr class='cmn_tr_".$val['id']."'>
                        <td>".$ids."</td>
                        <td>".$f_name."</td>
                        <td>".$l_name."</td>
                        <td>".$email."</td>
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


function edit_load(){
$data=null;
$va=(explode('_',$_POST['eid']));
$id=$va[1];
$result=R::getAll("SELECT * FROM customers WHERE id=$id");
if($result){
foreach ($result as $value) {
$data=array("reply"=>"10","val_1"=>$value['first_name'],"val_2"=>$value['last_name'],"val_3"=>$value['address'],"val_4"=>$value['contact_number'],"val_5"=>$value['email'],"val_6"=>$value['height'],"val_7"=>$value['date_of_birth'],"val_8"=>$value['account_number'],"val_9"=>$value['weight'],"val_10"=>$value['id'],"val_11"=>$value['age'],"val_12"=>$value['gender'],"val_13"=>$value['id']);
}
}else{
$data=array("reply"=>"20");    
}
echo json_encode($data);
}


function edit(){
$data=null;
$dob=0;
$dob_month=$_POST['val_11'];
$dob_date=$_POST['val_12'];
$dob_year=$_POST['val_13'];
if($dob_month=="" || $dob_date=="" || $dob_year==""){

}else{
    $dob=$dob_year."-".$dob_month."-".$dob_date;
}

$val_1=$_POST['val_1'];
$val_2=$_POST['val_2'];
$val_3=$_POST['val_3'];
$val_4=$_POST['val_4'];
$val_5=$_POST['val_5'];

if($_POST['val_6']=="" || $_POST['val_6']==null){
$val_6=0;
}else{
$val_6=$_POST['val_6'];
}

// if($_POST['val_7']=="" || $_POST['val_7']==null){
// $val_7=0;
// }else{
// $val_7=$_POST['val_7'];
// }

$val_8=$_POST['val_8'];
$val_9=$_POST['val_9'];
$val_10=$_POST['val_10'];

$val_11=null;
if($_POST['val_14']){
$val_11=$_POST['val_14'];
}

$id=$_POST['hidden_val1'];
     $rest=R::exec("UPDATE customers SET first_name='$val_1',last_name='$val_2',address='$val_3',contact_number='$val_4',email='$val_5',height='$val_6',date_of_birth='$dob',account_number='$val_8',weight='$val_9',age='$val_10',gender='$val_11' WHERE id='$id'");
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
$res=parent::delete2("customers",$id);
$data=array("reply"=>"10");
echo json_encode($data);   
}

    //////////new////////////
    // function delete2($id){
    //     // print_r($seller_id);
    //     $rest=R::exec("DELETE FROM customers  WHERE id=$id");
    //     // $deltemp = DB::table('sales')->where('sales.id', $id )->delete();
    //     }
    ///////////////////////
}
