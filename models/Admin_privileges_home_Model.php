
<?php
class Admin_privileges_home_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

   function create(){
    $data=null;
    $pre_id=null;
    $res=parent::insert("privilegesprofiles",array("name"=>$_POST['val_1']));
     if($res>=0){
    $pre_id=$res;
    $result=R::getAll("SELECT * FROM views");  
    foreach ($result as $value) {
    $rest=parent::insert("accesscontroler",array("privilegesprofiles_id"=>$pre_id,"views_id"=>$value['id'],"status"=>'1'));  
    if($rest>=0){
      $data=array("reply"=>"10","id"=>$pre_id);
    }
    }
     }else{
      $data=array("reply"=>"20");
     }
     echo json_encode($data);
   }

   function load(){
    $result=R::getAll("SELECT * FROM privilegesprofiles");	
    if($result){
     foreach ($result as $value) {
     	echo "<li>
            <strong>".$value['name']."</strong>
            <a href='".ROOT."Admin_privileges_change?id=".$value['id']."' class='change_rol'>Chang rules</a>
            <input type='button' class='btn btn-danger' value='remove' id=".$value['id']." class='profile_remove'>
            </li>";
     }
    }
   }

   function remove(){
   	$data=null;
    $res=parent::delete2("privilegesprofiles",$_POST['id']); 
    $data=array("reply"=>"10","id"=>$_POST['id']);
    echo json_encode($data);
   }

}
