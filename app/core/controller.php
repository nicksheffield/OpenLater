<?php

	class Controller{
		
		function __construct(){}
		
		function page($view){
			include(APP_DIR.'/views/header.php');
			include(APP_DIR.'/views/nav.php');
			include(APP_DIR.'/views/'.$view.'.php');
			include(APP_DIR.'/views/footer.php');
		}
		
	}