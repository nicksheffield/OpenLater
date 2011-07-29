<?php
	
	session_start();
	
	require_once('db.php');
	require_once('config.php');
	require_once('google.php');
	
	if(!isset($_SESSION['user_email'])){
		$googleLogin = GoogleOpenID::createRequest('/create.php?url='.$_GET['url'].'&title='.$_GET['title'],'ABCDEFG',true);
	}
	
	$db = new db($db_config);
	
	$db->where('email',$_SESSION['user_email']);
	$user_result = $db->get('users');
	$user = $user_result['0'];
	
	if($db->insert('records',array(
		'title'	=> $db->filter($_REQUEST['title']),
		'url'	=> $db->filter($_REQUEST['url']),
		'date'	=> date('c'),
		'userid'=> $user['id']
	))){
		echo 1;
	}else{
		echo 0;
	}