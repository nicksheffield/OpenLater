<?php

	class Page{
		
		function __construct(){}
		
		function generate($view_name,$data=false){
			
			if($data) extract($data,EXTR_OVERWRITE);
			
			include(APP.'/views/layout/header.php');
			include(APP.'/views/layout/nav.php');
			include(APP.'/views/'.$view_name.'.php');
			include(APP.'/views/layout/footer.php');
		}
		
		function load_view($view,$data=false,$return=false){
			
			if($data) extract($data,EXTR_OVERWRITE);
			
			if($return){
				return include(APP.'/views/'.$view.'.php');
			}else{
				include(APP.'/views/'.$view.'.php');
			}
		}
		
		function template($__TEMPLATE_NAME,$data=false){
			$template = file_get_contents(APP.'views/'.$__TEMPLATE_NAME.'.php');
			
			if($data){
				extract($data,EXTR_OVERWRITE);
				
				foreach($data as $key => $val){
					$template = str_replace("[@$key]",$val,$template);
				}
			}
			
			eval('?> '.$template.' <?');
		}
	}