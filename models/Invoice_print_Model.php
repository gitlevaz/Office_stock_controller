
<?php
class Invoice_print_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

	function Invoice_print(){
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
// print_r($xx[0]);
// die();
		// $res=parent::insert("invoicesub",array("invoce_no"=>$xx[1],"item_code"=>$xx[0],"item_name"=>$xx[2],"unit_price"=>$xx[3],"quantity"=>$xx[4],"unit"=>$xx[5],"amount"=>$xx[6]));
		// echo "<span>Item code</span><h1>".$xx[0]."</h1>";
		echo "<div class='row'><div class='col-md-12'><span>Item code</span><h1>".$xx[1]."</h1><span>Item code</span><h1>".$xx[2]."</h1><span>Item code</span><h1>".$xx[3]."</h1><span>Item code</span><h1>".$xx[4]."</h1><span>Item code</span><h1>".$xx[5]."</h1></div></div>";
		// echo "<s";
		// echo "<span>Item code</span><h1>".$xx[3]."</h1>";
	    // echo "<span>Item code</span><h1>".$xx[4]."</h1>";
		// echo "<h1>".$xx[5]."</h1>";
		// echo $xx[0];
		// echo $xx[1];
		// echo $xx[2];
		// echo $xx[3];
		// echo $xx[4];
		// echo $xx[5];
	    }
	

	}

}
