<?php


class Links extends Controller{
	
	function unread(){
		$this->db->where('stored','0');
		$data['result'] = $this->db->get('id','title','url','date');
		
		return $this->generate('links',$data);
	}
	
	function stored(){
		$this->db->where('stored','1');
		$data['result'] = $this->db->get('id','title','url','date');
		$data['stored'] = true;
		
		echo $data['results'];
		
		return $this->generate('links',$data);
	}
	
}