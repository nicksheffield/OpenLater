<?php


class User extends Controller{
	
	function login(){
		$openid = new LightOpenID;
		if(!$openid->mode){
			$openid->identity = 'https://www.google.com/accounts/o8/id';
			header('Location: ' . $openid->authUrl());
			echo $openid->authUrl();
		}else{
			$openid->validate();
			$_SESSION['id'] = $openid->identity;
			
			header('Location: /unread');
			exit;
		}
	}
	
}