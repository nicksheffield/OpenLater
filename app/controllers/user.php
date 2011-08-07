<?php


class User extends Controller{
	
	function authenticate(){
		$googleLogin = GoogleOpenID::createRequest('unread','ABCDEFG',true);
		$googleLogin->redirect();
	}
	
}