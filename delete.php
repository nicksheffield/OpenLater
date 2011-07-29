	<?php
	
	require('db.php');
	require('config.php');
	
	$db = new db($db_config);
	
	$query = $db->delete('records','id',$_REQUEST['id']);
	
	echo $query==true;