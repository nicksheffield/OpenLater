<?php


class Controller{
	
	protected $db;
	protected $nav;
	
	function __construct($registry){
		$this->db = $registry->db;
		$this->nav = $registry->nav;
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
		
		$_pages = '';
		
		$_pages .= $this->load_view('layout/header',$data,true);
		$_pages .= $this->load_view('layout/nav',$data,true);
		$_pages .= $this->load_view($view_name,$data,true);
		$_pages .= $this->load_view('layout/footer',$data,true);
		
		return $_pages;
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
			ob_start();
		    include(APP.'views/'.$view_name.'.php');
		    return ob_get_clean();
		}else{
			include(APP.'views/'.$view_name.'.php');
		}
	}
}