<?php
	
	define('APP','../app/');
	
	require_once APP.'core/silex.phar';
	require_once APP.'lib/controller.php';
	require_once APP.'lib/sqlite.php';
	require_once APP.'core/registry.php';
	
	/**
	 * The system that runs this app
	 *
	 * @var object
	 **/
	$silex = new Silex\Application();
	
	/**
	 * If there is no page segment supplied in the url, redirect to the 'unread' page
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('/', function() use($silex){
		return $silex->redirect('unread');
	});
	
	
	/**
	 * Display the unread links page
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('unread', function(){
		page('links')->unread();
		
		return '<!-- success -->;
	});
	
	/**
	 * Display the stored links page
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('stored', function(){
		page('links')->stored();
	});
	
	
	/**
	 * Display the bookmark page
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('bookmark', function(){
		page('bookmarklet')->index();
	});
	
	
	/**
	 * Create a link record based on a title and url
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('create', function(){
		page('actions')->create($_GET['t'],$_GET['u']);
	});
	
	
	/**
	 * Delete a link record by it's id
	 *
	 * @var $id integer The id of the record to be deleted
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('delete/{id}', function($id){
		page('actions')->delete($id);
	});
	
	
	/**
	 * Move a link record to the stored page by it's id
	 *
	 * @var $id integer The id of the record to be stored
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('store/{id}', function($id){
		page('actions')->store($id);
	});
	
	
	/**
	 * Include a controller class and return a new instance of it.
	 * Also, this function is responsible for passing along the config and database
	 *
	 * @var $name string The name of the class to be used
	 *
	 * @return object
	 * @author Nick Sheffield
	 **/
	function page($name){
		include_once(APP.'controllers/'.$name.'.php');
		global $_config;
		
		return new $name(new Registry);
	}
	
	# for debugging purposes only
	$silex->get('all', function(){
		page('links')->display_all();
	});
	
	
	
	$silex->run();
	
	