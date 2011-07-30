<?php

	class Home extends Controller{
		
		function __construct(){}
		
		function index(){
			echo 'home/index was called';
		}
		
		function hello(){
			echo 'home/hello was called';
		}
	}