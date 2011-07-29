	<?php
	
	require('db.php');
	require('config.php');
	
	$db = new db($db_config);
	
	$query = $db->query("UPDATE records SET `stored`='1' WHERE  records.id=".$_REQUEST['id']);
	
	echo $query==true;