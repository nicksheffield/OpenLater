<?php

class Registry{
	
	public $db = new sqlite('openlater');
	public $nav = array(
		'unread'=>'unread',
		'stored'=>'stored',
		'bookmark'=>'bookmark'
	);
	
	function __construct(){
		$db->start_table('links',"
			CREATE TABLE links(
			id INTEGER PRIMARY KEY,
			title VARCHAR(100) NOT NULL,
			url VARCHAR(255) NOT NULL,
			date DATETIME NOT NULL,
			stored VARCHAR(5) DEFAULT '0',
			email VARCHAR(100) NOT NULL
		)");
	}
	
}