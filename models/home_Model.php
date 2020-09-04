<?php
class home_Model extends Model
{
    function __construct(){
        Session::init();
        parent::__construct();
    }
    function logIn(){

        $user_name=$_POST['userName'];
        $data=null;
        $password=encryptDecrypt::encrypt($_POST['passWord']);
        $result=R::getAll("SELECT * FROM users WHERE username = :user AND password = :pass", array(':user' => $user_name,':pass' => $password));
        // print_r($password);
        // die();
        $user = array_filter($result);
        if (!empty($user)) {
            Session::set('USERLOGIN',true);
            foreach ($result as $value) {
            $_SESSION['log_level'] = $value['status'];
            $_SESSION['username'] = $value['username'];
            $_SESSION['user_id'] = $value['id'];
            $_SESSION['user_email'] = $value['email'];
            }
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (60*60);

            $data=array("reply"=>"10");
        }else{
            $data=array("reply"=>"20");
        }
        echo json_encode($data);
    }   
    function test(){
    $res=parent::insert("book",array("title"=>"testransaction","rating"=>"1200"));	
     if($res<=0){
     	echo "error";
     }else{
     	echo "done";
     }
    }
    function test_update(){
    $res=parent::update("book",array("title"=>"updateaaa","rating"=>"53.60"),'5'); 
    }
    function test_delete(){
    $res=parent::delete2("book",3); 
    }
    function test_search(){
     $res=parent::select("book",4); 	
    }
}