<?php


class Actions extends Controller{
	
	/**
	 * Create a link record by its title and url
	 *
	 * Example url: /create?t=html5%20shelf&u=http%3A%2F%2Fhtml5shelf.tumblr.com%2Fpage%2F5
	 *
	 * @var $title string The title of the page
	 * @var $url string The url of the page
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	function create($title,$url){
		echo 'title: '.$title.'<br/>';
		echo 'url: '.$url.'<br/>';
		
		$this->db->table('links');
		$this->db->insert(array(
			'title'=>$title,
			'url'=>$url,
			'date'=>date('c'),
			'email'=>'numbereft@gmail.com'
		));
		
	}
	
	/**
	 * Delete a link record by its id
	 *
	 * @var $id integer The id of the link to be deleted
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	function delete($id){
		echo $this->db->del('id',$id);
	}
	
	/**
	 * Store a link record by its id
	 *
	 * @var $id integer The id of the link to be stored
	 *
	 * @return void
	 * @author Nick Sheffield
	 **/
	function store($id){
		$this->db->where('id',$id);
		echo $this->db->update(array('stored'=>1));
	}
	
}