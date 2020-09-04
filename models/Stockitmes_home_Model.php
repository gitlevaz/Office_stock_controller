
<?php
class Stockitmes_home_Model extends model
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
$rest=R::getAll("SELECT item_code FROM stockitems WHERE item_code='$code'");	
if($rest){
foreach ($rest as $value) {
 if($value['item_code']==$code){
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
$res=R::getAll("SELECT * FROM itemsubcategory WHERE category_id='$id'");	
if($res){
	foreach ($res as $value) {
		echo "<option value='".$value['id']."'>".$value['subcategory']."</option>";
	}
}else{
echo "<option></option>";	
}
}

function create(){
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

$val_13=$_POST['val_13'];

if($_POST['val_14']=="" || $_POST['val_14']==null){
$val_14=0;
}else{
$val_14=$_POST['val_14'];
}



$res=parent::insert("stockitems",array("item_name"=>$val_1,"model"=>$val_2,"cost_price"=>$val_3,"last_price"=>$val_4,"reorder_limit"=>$val_5,"category"=>$val_6,"sub_category"=>$val_7,"unit"=>$val_8,"quantity"=>$val_9,"selling_pring"=>$val_10,"reorder_level"=>$val_11,"item_code"=>$val_12,"issue_as"=>$val_13,"qty_in"=>$val_14));
     if($res>=0){
     $data=array("reply"=>"10");
     }else{
     $data=array("reply"=>"20");	
     }
     echo json_encode($data);
}

}
