
<?php
class Substore_returns_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

	function load_item(){
		$data=null;
		$id=$_POST['id'];
		$res=R::getAll("SELECT * FROM stockitems WHERE id='$id'");	
		if($res){
			foreach ($res as $val) {
				$data=array("reply"=>"10","val_1"=>$val['id'],"val_2"=>$val['last_price'],"val_3"=>$val['unit']);
			}
		}else{
     	$data=array("reply"=>"20");
		}
		echo json_encode($data);
	}	

	function load_rtns(){
		$id=$_POST['id'];
		$res=R::getAll("SELECT * FROM issuenotemaster WHERE substore='$id'");	
		if($res){
				echo "<option></option>";
			foreach ($res as $val) {
				echo "<option value=".$val['id'].">".$val['id']."</option>";
			}
		}else{

		}
	}

	function load_subs(){
		$id=$_POST['id'];
		$res=R::getAll("SELECT * FROM issuenotesub WHERE isn_no='$id'");	
		if($res){
				echo "<option></option>";
			foreach ($res as $val) {
				echo "<option value=".$val['item_code'].">".$val['item_name']."</option>";
			}
		}else{

		}
	}

	function save_main(){
		$date =date("Y-m-d");
		$res=parent::insert("substorreturnmaster",array("substore"=>$_POST['val_2'],"date"=>$_POST['val_3'],"act_date"=>$date,"isn_no"=>$_POST['val_4']));
	// $res=parent::insert("grn_main",array());
	     if($res>=0){
	     $data=array("reply"=>"10","id"=>$res);
	     }else{
	     $data=array("reply"=>"20");	
	     }
	     echo json_encode($data);
	}	

	function save_sub(){
			$data=null;
		    $urls=null;
		    $index_id=null;
    if($_POST==null || $_POST==''){
	     $data=array("reply"=>"20");
	     echo json_encode($data);
	     return false;	
    }else{
			foreach ($_POST as $key => $value){
				if(htmlspecialchars($value)=='0' || htmlspecialchars($value)==''){
				}else{
		        $urls=$urls.htmlspecialchars($key)."_".htmlspecialchars($value)."/";
		 		// echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

				}
			}
	$vl=$urls;
	//$vl=$this->simple_decrypt($val);
	$ex=explode(",",$vl);
		$a= explode('/',$vl);
			for ($i=0; $i < count($a)-1; $i++) {
			 	$x=$a[$i];
			 	$xx =explode('_', $x);
			 	// echo $xx[0];
			 	$index_id=$xx[1];

			 	$cont=0;
			 	if($xx[6]=='' || $xx[6]==null){

			 	}else{
			 		$cont=$xx[6];
			 	}
		$res=parent::insert("substorreturnsub",array("rtnno"=>$xx[1],"item_code"=>$xx[0],"item_name"=>$xx[2],"unit_price"=>$xx[3],"quantity"=>$xx[4],"unit"=>$xx[5],"amount"=>$xx[6]));
	// $res=parent::insert("grn_main",array());
	     if($res>=0){
	     	$data=array("reply"=>"10");
	     }else{
	     $res=parent::delete2("substorreturnmaster",$index_id);
	     R::exec( 'DELETE substorreturnsub where rtnno=$index_id');
	     $data=array("reply"=>"20");
	     echo json_encode($data);
	     return false;	
	     }
	    }
	    echo json_encode($data);
	}
    }

    function remove_issuenote(){
    	$id=$_POST['id'];
 	     $res=parent::delete2("substorreturnmaster",$id);
	     R::exec( 'DELETE substorreturnsub where rtnno=$id ');
    }

}
