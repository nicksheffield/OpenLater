<?php

class Controller{
	
	protected $db;
	protected $nav;
	
	function __construct($registry){
		$this->db = $registry->db();
		$this->nav = $registry->nav();
	}
	
	
	/**
	 * Output an entire page, including the header, nav, and footer, along with the specified view
	 *
	 * @var $view_name string The filename of the view to be loaded
	 * @var $data array Variables to be unpacked and made available to the view. Default false
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	function generate($view_name,$data=false){
		
		if($data) extract($data,EXTR_OVERWRITE);
		
		include(APP.'views/layout/header.php');
		include(APP.'views/layout/nav.php');
		include(APP.'views/'.$view_name.'.php');
		include(APP.'views/layout/footer.php');
	}
	
	/**
	 * Load a specific view. Also returns the view if the $return var is set to true
	 *
	 * @var $view_name string The filename of the view to be loaded
	 * @var $data array Variables to be unpacked and made available to the view. Optional
	 * @var $return boolean Determines whether to return the view as a string
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	function load_view($view_name,$data=false,$return=false){
		
		if($data) extract($data,EXTR_OVERWRITE);
		
		if($return){
			return include(APP.'/views/'.$view_name.'.php');
		}else{
			include(APP.'/views/'.$view_name.'.php');
		}
	}
}