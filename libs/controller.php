<?php
class controller
{
	function __construct()
	{
	$this->view=new View();
	}
	public function loadModel($name){
		$path=DF_ROOT.'/models/'.$name.'_model.php';
		//echo $path;
		//if(file_exists($path)){
			require 'models/'.$name.'_Model.php';
			$modelname=$name.'_Model';
			$this->model=new $modelname;	

			require 'models/common_Model.php';
			$this->common=new common_Model();
		//}
	}

	public function check_authentication(){
		$userid=$_SESSION['user_id'];
		$a=$_GET['url'];
		$ul=explode('/',$a);
		$view=$ul[0];
		$res=$this->common->check_authentication($userid,$view);
		if($res==null || $res==''){
			return false;
		}else{
		foreach ($res as $value) {
			if($value['status']==1){
				return true;
			}else{
				return false;
			}
		}
	   }
	}

	public function checkTokan(){
			if(Session::get('USERLOGIN')==true){
		        $now = time(); // Checking the time now when home page starts.
		        if ($now > $_SESSION['expire']) {
		            session_destroy();
				    $this->view->msg="<div class='alert alert-warning'>Your session has expired! <a href='".ROOT."'>Login here</a></div>";
					$this->getView("error");
		        }else{
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (60*30);
            if($this->check_authentication()){
		        return true;  
            }else{
				    // $this->view->msg="<div class='alert alert-warning'>Access Denied! <a href='".ROOT."'>Login here</a></div>";
					// $this->getView("error");	
					return true;  
            }
		        }
			}else{
				    // $this->view->msg="<div class='alert alert-warning'>Invalid Login! <a href='".ROOT."'>Login here</a></div>";
					// $this->getView("error");
					return true;  
			}
    }
	public function checklogin($accessToken){
		if($accessToken){
			if(Session::get('USERLOGIN')==true){
              return true;  
			}else{
		 //    $this->view->msg="Invalid Login..";
			// $this->getView("error");
			return '0';
			}		   
		}else if(GUESTTOKEN){
           return true;
		}else{
		    $this->view->msg="Invalid Token..";
			$this->getView("error");
		}
	}
	public function adminTokan(){
			if(Session::get('ADMINLOGIN')==true){
              return true;  
			}else{
		    $this->view->msg="Invalid Login..";
			$this->getView("error");
			}		   
	}
	public function getView($viewname){
		$this->view->render($viewname.'/index');
	}
}