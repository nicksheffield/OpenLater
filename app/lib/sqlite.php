<?php

/*
	By Nick Sheffield
	nick@nicksheffield.com
*/

class sqlite {

	private $table;
	private $dbname;
	private $db;
	
	private $where_conditions;

	/*
		$dbname: The name of the .sqlite file in app/db/
	*/
	public function __construct($dbname){
		
		# If the database doesn't exist, we want to create it
		if(!$this->db = new SQLiteDatabase(APP.'db/'.$dbname.'.sqlite',0666,$err)){
			exit(__LINE__.' | '.$err);
		}
	}
	
	
	/*
		$tablename: the name of the table in question to be created or checked
		$sql: the sql query necessary to create the table if it doesn't already exist
	*/
	public function start_table($tablename,$sql){
		# Check if $tablename exists as a table in the database
		$q = $this->db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='$tablename'");
		
		# If not, then we need to create it
		if(!$q->numRows()){
			
			# Query the database to create the table
			$this->db->queryexec($sql);
		}
		
		$this->table($tablename);
	}
	
	
	
	
# Send a query exec to the database and return the success as a boolean
	
	public function query($sql){
		return $this->db->queryexec($sql);
	}
	
	
	
	
# Set the table
	
	public function table($table){
		$this->table = $table;
	}
	
	
# Delete a table, only used for debugging

	public function drop($table){
		$this->db->queryexec("DROP TABLE $table");
	}
	
	
	
	
# Get an associative array from the database. Takes unlimited arguments
# get('id','content','date')
	
	public function get(){
		
		# start writing the select query
		$q = "SELECT ";
		
		# go through each value in $arr, and add it to the select query string
		
		if(func_get_args()){
			$arr = func_get_args();
			foreach($arr as $key=>$value){
				$q .= $value.',';
			}
		}
		
		# trim the last comma off the string, and add the FROM tablename to the end
		$q = $this->trim($q).' FROM '.$this->table;
		
		$q .= $this->where_conditions;
		$this->where_conditions = '';
		
		# send the query to the database
		return $this->db->arrayQuery($q,SQLITE_ASSOC);
	}
	
	
	
# Set a where clause inside any future get or insert queries. Needs a bit of work

	public function where($property,$value){
		
		if(!$this->where_conditions)  $this->where_conditions = ' WHERE ';
		$this->where_conditions .= "$property='$value'";
		
	}
	
	
	
# Delete a record where the first argument is equal to the second argument
	
	public function del($key,$value){
	
		# write the delete query 
		$query = "DELETE FROM $this->table WHERE $key='$value'";
		
		# sent the delete query
		return $this->db->unbufferedQuery($query)==true?true:false;
	}
	
	
	
	
# Insert a record to the database
	/**
         *
         * @param array $arr array of key=>value pairs to be insterted into the database
         * @return boolean
         */
	public function insert($arr){
		
		$q = "INSERT INTO $this->table( ";
		
		foreach($arr as $key=>$value){
			$key = sqlite_escape_string($key);
			$q .= "$key,";
		}
		
		$q = $this->trim($q).') VALUES(';
		
		foreach($arr as $key=>$value){
			$value = sqlite_escape_string($value);
			$q .= "'$value',";
		}
		
		$q = $this->trim($q).')';
		
		$exec = $this->db->queryexec($q);
		
		$this->last_insert = $this->db->lastInsertRowid();
		
		return $exec;
	}
	
	
	
	
# Update a record in the database
	
	public function update($arr){
		
		$q = "UPDATE $this->table SET ";
		
		foreach($arr as $key=>$value){
			$q .= "$key='$value',";
		}
		
		$q = $this->trim($q,1);
		
		$q .= $this->where_conditions;
		$this->where_conditions = '';
		
		$exec = $this->db->queryexec($q);
		
		return $exec;
	}
	
	
	
	
	
# a simple little function used simply for chopping off the last characters of a string.
# useful for removing trailing commas
	private function trim($string,$characters=1){
		return substr($string,0,strlen($string)-$characters);
	}
	
	
	
	
	
}
