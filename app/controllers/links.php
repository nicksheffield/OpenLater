<?php


class Links extends Controller{
	
	function unread(){
		echo 'unread1 ';
		$this->db->where('stored','0');
		$data['result'] = $this->db->get('id','title','url','date','email');
		
		echo 'unread2 ';
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