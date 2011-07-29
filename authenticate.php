<?php
	
	session_start();
	
	require_once('db.php');
	require_once('config.php');
	require_once('google.php');
	try{
		$googleLogin = GoogleOpenID::getResponse();
	}
	catch(Exception $e) {
		echo '<p>ERROR FOOL!: '.$e->getMessage().'</p>';
	}
	if($googleLogin instanceof GoogleOpenID) {
		if($googleLogin->success()){
			$_SESSION['user_id'] = $googleLogin->identity();
			$_SESSION['user_email'] = $googleLogin->email();
			
			$db = new db($db_config);
			
			$db->where('email',$googleLogin->email());
			if(!$db->get('users')){
				$db->insert('users',array(
					'identifier' => $googleLogin->identity(),
					'email'	=> $googleLogin->email(),
					'last_login' => date('c')
				));
			}else{
				$db->where('email',$googleLogin->email());
				$db->update('users',array('last_login'=>date('c')));
			}
			
			header('location: /'.$_GET['r']);
		}
	}