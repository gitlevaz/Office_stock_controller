
<?php
class Invoice_home_Model extends model
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
				$data=array("reply"=>"10","val_1"=>$val['id'],"val_2"=>$val['last_price'],"val_3"=>$val['unit'],"val_3"=>$val['quantity']);
			}
		}else{
     	$data=array("reply"=>"20");
		}
		echo json_encode($data);
	}	

	function save_main(){
		$date =date("Y-m-d");
		$res=parent::insert("invoicemaster",array("customer"=>$_POST['val_2'],"date"=>$_POST['val_3'],"act_date"=>$date));
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
		    $invoice_id=null;
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
			 	$invoice_id=$xx[1];

			 	$cont=0;
			 	if($xx[6]=='' || $xx[6]==null){

			 	}else{
			 		$cont=$xx[6];
			 	}
		 	//update item price
 		$rr=parent::update_item_price($xx[0],$xx[3]);
 	       //update item qty
 		$rr=parent::update_item_quantity_4($xx[0],$xx[4]);
			 	$itme_name='null';
				$rest=R::getAll("SELECT * FROM stockitems WHERE id='$xx[2]'");	
				foreach ($rest as $value) {
				$itme_name=$value['item_name'];
				}
		$res=parent::insert("invoicesub",array("invoce_no"=>$xx[1],"item_code"=>$xx[0],"item_name"=>$itme_name,"unit_price"=>$xx[3],"quantity"=>$xx[4],"unit"=>$xx[5],"amount"=>$xx[6]));
	// $res=parent::insert("grn_main",array());
	     if($res>=0){
	     	$data=array("reply"=>"10");
	     }else{
	     $res=parent::delete2("invoicemaster",$invoice_id);
	     R::exec( 'DELETE invoicesub where invoce_no=$invoice_id');
	     $data=array("reply"=>"20");
	     echo json_encode($data);
	     return false;	
	     }
	    }
	    echo json_encode($data);
	}
    }

    function remove_invoice(){
    	$id=$_POST['id'];
 	     $res=parent::delete2("invoicemaster",$id);
	     R::exec( 'DELETE invoicesub where invoce_no=$id ');
    }

}
