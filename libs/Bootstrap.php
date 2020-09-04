<?php
class Bootstrap
{
	function __construct()
	{
	$url = isset($_GET['url']) ? $_GET['url'] : null;
	$url=trim($url,'/');
	$url=explode("/",$url);

	if(empty($url[0])){
		// echo DF_ROOT;
		// require DF_ROOT.'/controlers/index.php';
		// $controller=new Index();
		// $controller->index();
		// return false;
		header("Location:".ROOT.'home');
		return false;

	}
	$file= DF_ROOT.'/controlers/'.$url[0].'.php';
	if(file_exists($file)){
		require ($file);
	    $controller=new $url[0]();
	}else{
		// require DF_ROOT.'/controlers/error.php';
		// $controlers=new error();
		// $controlers->index();
		return false;
	}
	$controlers =new $url[0];
	$controlers->loadModel($url[0]);

	if(isset($url[2])){
		if (method_exists($controller,$url[1])) {
         $controlers->{$url[1]}($url[2]);
		}
	}else{
	if(isset($url[1])){
	$controlers->{$url[1]}();	
	}else{
		$controlers->index();
	}
	}
}
}