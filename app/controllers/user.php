<?php


class User extends Controller{
	
	
	/**
	 * Log a user in. This function handles both stages of the process.
	 * Firstly goes to google to get the users id,
	 * Secondly gets the returned google id and saves it
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	function login(){
		$openid = new LightOpenID;
		
		// if the process hasn't been started yet, go to google and start it
		if(!$openid->mode){
			$openid->identity = 'https://www.google.com/accounts/o8/id';
			header('Location: ' . $openid->authUrl());
			echo $openid->authUrl();
			
		// if the process has been started already, save the resulting id
		}else{
			$openid->validate();
			$_SESSION['id'] = $openid->identity;
			
			header('Location: /unread');
			exit;
		}
	}
	
}