<?php

	define('APP_DIR','../app/');	

	require_once APP_DIR.'lib/silex.phar';
	require_once APP_DIR.'core/controller.php';
	
	$silex = new Silex\Application();
	
	
	
	
	
	$silex->get('/{controller}', function($controller) use ($silex){
		require_once(APP_DIR.'/controllers/'.$controller.'.php');
		
		$page = new $controller();
		
		$page->index();
	});
	
	$silex->get('/{controller}/{method}', function($controller,$method) use($silex){
		require_once(APP_DIR.'/controllers/'.$controller.'.php');
		
		$page = new $controller();
		
		call_user_func(array($controller, $method));
	});
	
	
	
	
	$silex->run();