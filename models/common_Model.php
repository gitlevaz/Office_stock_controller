<?php
class common_Model extends model
{
	
	function __construct()
	{
		// Session::init();
		// parent::__construct();
	}

function check_authentication($userid,$view){
    $priv_id=null;
    $view_id=null;
    $res=R::getAll("SELECT us.privilegesprofiles_id FROM users us WHERE id='$userid'");	
    foreach ($res as $value) {
    	$priv_id=$value['privilegesprofiles_id'];
    }
    $re=R::getAll("SELECT vv.id FROM views vv WHERE view='$view'");	
    foreach ($re as $val) {
    $view_id=$val['id'];
    }
    $rest=R::getAll("SELECT * FROM accesscontroler WHERE privilegesprofiles_id='$priv_id' AND views_id='$view_id'");
    if($rest){
    	return $rest;
    }
}

}