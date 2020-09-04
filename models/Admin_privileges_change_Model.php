
<?php
class Admin_privileges_change_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function load(){
 $view = array();
 $priv_id=$_POST['ids']; 
 $data_cat=null; 

 $result=R::getAll("SELECT * FROM views");

 foreach ($result as $value) {
  $data_cat=$value['view'];
 	$view_cat=explode('_', $value['view']);

 if(in_array($view_cat[0],$view)){	
 }else{
 	$view[] = $view_cat[0];
 }
 }

 foreach ($view as $value) {
  echo "<div class='col-sm-4 col-md-4'>";

  $ch_2='';
  $rr=R::getAll("SELECT * FROM views WHERE view LIKE '$value%'");
  foreach ($rr as $vv) {
    $vvs=$vv['id'];
    $re=R::getAll("SELECT status FROM accesscontroler WHERE privilegesprofiles_id='$priv_id' AND views_id='$vvs' AND status='1'");
    foreach ($re as $v) {
    $ch_2='checked';
    }   
  }

  echo "<strong>".$value."</strong><input type='checkbox' class='privileges_check1' data-value='$priv_id' data_cat='$value' ".$ch_2."><br>";
  $res=R::getAll("SELECT * FROM views WHERE view LIKE '$value%'");
  echo "<ul>";
  foreach ($res as $val) {
  $cat=$val['id'];
  $ch_3='';
  
  $rs=R::getAll("SELECT status FROM accesscontroler WHERE privilegesprofiles_id='$priv_id' AND views_id='$cat' AND status='1'");
  foreach ($rs as $v) {
    $ch_3='checked';
  }

  echo "<li>".$val['view']."<input type='checkbox' data-value='$priv_id' class='privileges_check2 $value' data_cat='$cat' ".$ch_3."></li>";
  }
  echo "</ul>";
  echo "</div>";
 }
 }

function edit(){
 $data=null;
 $cat=$_POST['cat'];
 $val=$_POST['val'];
 $che=$_POST['che'];
  $res=R::getAll("SELECT * FROM views WHERE view LIKE '$cat%'");
 foreach ($res as $value) {
  $v_id=$value['id'];
  $rest=R::exec("UPDATE accesscontroler SET status='$che' WHERE privilegesprofiles_id='$val' AND views_id='$v_id'");
 }
 if($rest==0){
 foreach ($res as $value) {
    $res=parent::insert("accesscontroler",array("privilegesprofiles_id"=>$val,"views_id"=>$value['id'],"status"=>$che));
 }
    if($rest>=0){
    $data=array("reply"=>"10");
    }else{
    $data=array("reply"=>"20");
    }
 }
 if($rest==1){ 
    $data=array("reply"=>"10");
 }
 echo json_encode($data);
}

function edit_sub(){
 $data=null;
 $cat=$_POST['cat'];
 $val=$_POST['val'];
 $che=$_POST['che'];
  $rest=R::exec("UPDATE accesscontroler SET status='$che' WHERE privilegesprofiles_id='$val' AND views_id='$cat'");
 if($rest==1){
    $data=array("reply"=>"10");
 }
 if($rest==0){
    $res=parent::insert("accesscontroler",array("privilegesprofiles_id"=>$val,"views_id"=>$cat,"status"=>$che));
    if($rest>0){
    $data=array("reply"=>"10");
    }else{
    $data=array("reply"=>"20");
    }
 }
 echo json_encode($data);
}

}
