
<?php
class common_functions_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function get_options(){
    $ch=$_POST['ch'];
    $values=$_POST['da'];
    $sval=explode(" ",$values);
    $table=$sval[1];
    $tex=$sval[2];
    $va=$sval[3];
    $pls=$sval[4];
    $order=$sval[5];
    if($ch>0){
        if(isset($order)){
        $res=R::getAll("SELECT * FROM $table ORDER BY $order");            
        }else{
        $res=R::getAll("SELECT * FROM $table");  
        }
        if($res){
            if($pls==''){
              echo "<option value='' disabled selected>Select your options</option>";
            }else{
              echo "<option value='' disabled selected>".$pls."</option>";
            }
            foreach ($res as $value) {
              echo("<option value='".$value[$va]."'>".$value[$tex]."</option>");
            }
        }
    }
}

function get_index(){
$values=$_POST['data'];    
    if($values){
        $res=R::getAll("SELECT MAX(id) FROM $values");  
        if($res){
            foreach ($res as $value) {
              print_r($value['MAX(id)']+1);
            }
        }else{
        echo "0";
        }
    }
}

}