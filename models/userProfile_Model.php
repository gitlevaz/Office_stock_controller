
<?php
class userProfile_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

	function load(){
		$userid=Session::get('USERID');
		$res = parent::select(array("cd"=>"users"),array("cd.*"),array("cd.id"=>$userid),false);
		if($res){
			return $res;
		}else{
			return '10';
		}
	}

	function check_psw(){
		$psw=$_POST['val_0'];
		$userid=Session::get('USERID');
		$res = parent::select(array("cd"=>"users"),array("cd.*"),array("cd.id"=>$userid),false);
		if($res){
			foreach ($res as $value) {
				if($value['password']==encryptDecrypt::encrypt($psw)){
					return '0';
				}else{
					return '1';
				}
			}
		}else{
			return '10';
		}
	}

	function save(){
		$userid=Session::get('USERID');
		$current_date = date('d-m-Y');
		$psw=encryptDecrypt::encrypt($_POST['val_4']);
		$res=parent::update("users",array("email"=>$_POST['val_2'],"password"=>$psw,"modified_date"=>$current_date,"country"=>$_POST['country'],"your_name"=>$_POST['val_1']),array("id"=>$userid));
			if($res=='1'){
		    return '0';
		    }else if($res==''){
		    return '0';
		    }else{
		    return '10';	
		    }
	}

}
