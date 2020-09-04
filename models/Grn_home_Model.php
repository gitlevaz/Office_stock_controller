
<?php
class Grn_home_Model extends model
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
				$data=array("reply"=>"10","val_1"=>$val['id'],"val_2"=>$val['last_price'],"val_3"=>$val['unit'],"val_4"=>$val['quantity']);
			}
		}else{
     	$data=array("reply"=>"20");
		}
		echo json_encode($data);
	}	

	function save_main(){
		$date =date("Y-m-d");
		$res=parent::insert("grnmain",array("supplier"=>$_POST['val_2'],"payment_method"=>$_POST['val_3'],"date"=>$_POST['val_4'],"inv_no"=>$_POST['val_5'],"act_date"=>$date));
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
		    $grn_id=null;
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
			 	$grn_id=$xx[1];

			 	$cont=0;
			 	if($xx[6]=='' || $xx[6]==null){

			 	}else{
			 		$cont=$xx[6];
			 	}
	    $check=0;
 		if($xx[10]=='foc'){
 		$check=1;
 		}
 	//update item price
 		$rr=parent::update_item_price($xx[0],$xx[3]);
 	//update item qty
 		$rr=parent::update_item_quantity($xx[0],$xx[4]);
			 	$itme_name='null';
				$rest=R::getAll("SELECT * FROM stockitems WHERE id='$xx[2]'");	
				foreach ($rest as $value) {
				$itme_name=$value['item_name'];
				}
		$res=parent::insert("grnsub",array("grn_no"=>$xx[1],"item_code"=>$xx[0],"item_name"=>$itme_name,"unit_price"=>$xx[3],"quantity"=>$xx[4],"unit"=>$xx[5],"containers"=>$cont,"container"=>$xx[7],"amount"=>$xx[8],"exp_date"=>$xx[9],"foc"=>$check));
	// $res=parent::insert("grn_main",array());
	     if($res>=0){
	     	$data=array("reply"=>"10");
	     }else{
	     $res=parent::delete2("grnmain",$grn_id);
	     R::exec( 'DELETE grnsub where grn_no=$grn_id ');
	     $data=array("reply"=>"20");
	     echo json_encode($data);
	     return false;	
	     }
	    }
	    echo json_encode($data);
	}
    }

    function remove_grns(){
    	$id=$_POST['id'];
 	     $res=parent::delete2("grnmain",$id);
	     R::exec( 'DELETE grnsub where grn_no=$id ');
    }

}
