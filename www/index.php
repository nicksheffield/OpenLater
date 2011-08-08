<?php
	
	/**
	 * Begin the session
	 **/
	session_start();
	
	
	/**
	 * The location of the app folder
	 *
	 * @var constant
	 **/
	define('APP','../app/');
	
	
	/**
	 * Let's the app know where it's being used. If it's localhost, no auth happens
	 * Also, is used in the bookmarklet js code
	 *
	 * @var constant
	 **/
	if($_SERVER['SERVER_ADDR'] == '127.0.0.1'){
		$site = 'localhost';
	}else if($_SERVER['SERVER_ADDR'] == '10.60.5.13'){
		$site = 'pagodabox';
	}else{
		$site = 'nicksheffield.com';
	}
	
	define('SITE',$site);
	
	
	/**
	 * Load all the necessary classes and resources
	 **/
	require_once APP.'core/silex.phar';
	require_once APP.'core/registry.php';
	require_once APP.'lib/controller.php';
	require_once APP.'lib/sqlite.php';
	require_once APP.'lib/openid.php';
	
	
	/**
	 * The system that this app runs on
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
	 * Retrieve the users google login details
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('/login', function(){
		return page('user')->login();
	});
	
	
	/**
	 * Display the unread links page
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('unread', function(){
		return page('links')->auth()->unread();
	});
	
	/**
	 * Display the stored links page
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('stored', function(){
		return page('links')->auth()->stored();
	});
	
	
	/**
	 * Display the bookmark page
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('bookmark', function(){
		return page('bookmarklet')->auth()->index();
	});
	
	
	/**
	 * Create a link record based on a title and url
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	$silex->get('create', function(){
		return page('actions')->create($_GET['t'],$_GET['u']);
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
		return page('actions')->auth()->delete($id);
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
		return page('actions')->auth()->store($id);
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
		return new $name(new Registry);
	}
	
	
	
	$silex->run();
	
	