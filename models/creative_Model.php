<?php
class creative_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

function create(){
if (!file_exists('./views/'.$_POST['val_1'])) {
    $res=parent::insert("views",array("view"=>$_POST['val_1'],"status"=>"1"));
     if($res<=0){
     	echo "error";
     }else{
     	echo "done";
     }
// Desired folder structure
$structure=null;
$structure =array('./views/'.$_POST['val_1'],'./views/'.$_POST['val_1'].'/js');

foreach ($structure as $key => $value) {
if (!mkdir($value, 0777, true)) {
    die('Failed to create folders...');
}
}

// creating files
// views
$txt = "Creative-2\n";
$index_file = fopen("./views/".$_POST['val_1']."/index.php", "w") or die("Unable to open file!");
$js_file = fopen("./views/".$_POST['val_1']."/js/default.js", "w") or die("Unable to open file!");
fwrite($index_file, $txt);
fwrite($js_file, $txt);
// controller
$controller_txt = "<?php
class ".$_POST['val_1']." extends controller
{
	
	function __construct()
	{
    parent::__construct();
    Session::init();
    $this->view->js=array('".$_POST['val_1']."/js/default.js');
	}

	function index(){
		Session::set('USERTOKEN',Session::getToken(50));
		$accessToken=Session::get('USERTOKEN');
		if(parent::checkTokan($accessToken)){
	 $this->view->render('".$_POST['val_1']."/index');
	 }	
	}
}
?>";
$controller_file = fopen("./controlers/".$_POST['val_1'].".php", "w") or die("Unable to open file!");
fwrite($controller_file, $controller_txt);
//model
$model_txt ="
<?php
class ".$_POST['val_1']."_Model extends model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}

}
";
$model_file = fopen("./models/".$_POST['val_1']."_Model.php", "w") or die("Unable to open file!");
fwrite($model_file, $model_txt);


}
}

function load_tables(){
$res=R::getAll("SHOW TABLES IN Office");	
//$res=parent::directQuery_2("select table_name from information_schema.tables where table_schema='invest'");
if($res){
return $res;
}
}

function genarate_model(){
// $myFile = "./models/".$_POST['base_model']."_Model.php";
// $fh = fopen($myFile, 'w') or die("can't open file");
// fwrite($fh, 'DATA HERE');
// fclose($fh);

$myFile = "./models/".$_POST['base_model']."_Model.php";
$fh = fopen($myFile, 'w') or die("can't open file");
function replace_a_line($fh) {
   if (stristr($fh, '<?php')) {
     return "replaement line!\n";
   }
   return $fh;
}
$data = array_map('replace_a_line',$fh);
file_put_contents('myfile', implode('', $fh));

}

}
?>