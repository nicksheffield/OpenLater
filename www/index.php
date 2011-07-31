<?php
	
	define('APP','../app/');
	
	require_once APP.'core/silex.phar';
	require_once APP.'lib/page.php';
	require_once APP.'lib/sqlite.php';
	
	$silex = new Silex\Application();
	
	$db = new sqlite('openlater');
	$db->start_table('links',"
		CREATE TABLE links(
		id INTEGER PRIMARY KEY,
		title VARCHAR(100) NOT NULL,
		url VARCHAR(255) NOT NULL,
		date DATETIME NOT NULL,
		stored VARCHAR(5) DEFAULT '0',
		email VARCHAR(100) NOT NULL
	)");
	
	
	$silex->get('/', function() use($silex){
		return $silex->redirect('unread');
	});
	
	$silex->get('unread', function() use($db){
		
		$page = new Page();
		
		$data['title'] = 'output';
		$data['content'] = 'This is the result';
		$data['result'] = $db->get('id','title','url','date','stored','email');
		
		$page->generate('unread',$data);
	});
	
	$silex->get('bookmark', function() use($db){
		$page = new Page();
		
		$page->generate('bookmarklet');
	});
	
	$silex->get('create', function() use($db){
		echo 'title: '.$_GET['t'].'<br/>';
		echo 'url: '.$_GET['u'].'<br/>';
		
		$db->table('links');
		$db->insert(array(
			'title'=>$_GET['t'],
			'url'=>$_GET['u'],
			'date'=>date('c'),
			'email'=>'numbereft@gmail.com'
		));
		
		# example url
		# /create?t=html5%20shelf&u=http%3A%2F%2Fhtml5shelf.tumblr.com%2Fpage%2F5
	});
	
	$silex->get('delete/{id}', function($id) use($db){
		echo $db->del('id',$id);
	});
	
	
	
	$silex->run();
	
	