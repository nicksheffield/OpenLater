<?php

class Database{
	
	public static function init(){
		
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
		
		return $db;
	}
}