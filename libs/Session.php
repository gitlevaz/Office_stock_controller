<?php
class Session
{
	
	function __construct()
	{
	}
	public static function init(){
		@session_start();
	}
	public static function set($key,$value){
		$_SESSION[$key]=$value;
	}
	public static function get($key){
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
	}
	public static function destroy(){
		session_destroy();
	}
	public static function getToken($length){
		$key = '';
    	$keys = array_merge(range(0, 9), range('a', 'z'));
	    for ($i = 0; $i < $length; $i++) {
	        $key .= $keys[array_rand($keys)];
	    }
	    return $key;
	}
}