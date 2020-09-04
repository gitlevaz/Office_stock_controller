<?php
class log_out_Model extends Model
{
	
	function __construct()
	{
		Session::init();
		parent::__construct();
	}
}
?>