<?php

	class Test extends Controller{
		
		function __construct(){}
		
		function index(){
			echo 'test/index was called';
		}
		
		function hello(){
			echo 'test/hello was called';
		}
	}