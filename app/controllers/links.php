<?php


class Links extends Controller{
	
	protected $db;
	protected $nav;
	
	function __construct(){
		echo 'links<br/>';
	}
	
	function unread(){
		echo 'unread1<br/>';
		$this->db->where('stored','0');
		$data['result'] = $this->db->get('id','title','url','date','email');
		
		echo 'unread2<br/>';
		return $this->generate('links',$data);
	}
	
	function stored(){
		$this->db->where('stored','1');
		$data['result'] = $this->db->get('id','title','url','date','email');
		$data['stored'] = true;
		
		echo $data['results'];
		
		return $this->generate('links',$data);
	}
	
	function display_all(){
		
		echo '<pre>';
		print_r($this->db->get('id','title','url','date','stored','email'));
		echo '</pre>';
	}
	
}