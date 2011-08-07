<?php


class Bookmarklet extends Controller{
	
	function index(){
		return $this->generate('bookmarklet');
	}
	
}