<?php
class View
{
	
	function __construct()
	{
	Session::init();
	// setTokenForPages();
	// $this->list="test_list";	
	}
	public function render($name,$noInclude=false){
		$this->currentView=$name;
		if($noInclude==true){
		 require 'views/'.$noInclude.'.php';	
		}else{
		$native=NATIVE;
		$nb=explode('/', $name);
		if($native==$nb[0]){
			require 'views/'.$name.'.php';
		}else{
		require 'views/common/hedder.php';
			require 'views/'.$name.'.php';
        require 'views/common/footer.php';
		}
		}	
	}
}