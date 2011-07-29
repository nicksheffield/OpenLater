<?php

	session_start();
	
	if(!isset($_SESSION['user_email'])) header('location: /login');
	
	require_once('db.php');
	require_once('config.php');
	require_once('google.php');
	
	$db = new db($db_config);
	
	switch($_GET['mode']){
		case 'unread':
			$mode = 'unread';
			break;
		case 'stored':
			$mode = 'stored';
			break;
		case 'bookmark':
			$mode = 'bookmark';
			break;
		case 'login':
			$googleLogin = GoogleOpenID::createRequest('/authenticate.php?r=unread','ABCDEFG',true);
			$googleLogin->redirect();
			break;
		default:
			$mode = 'unread';
			break;
	}
	
	$db->where('email',$_SESSION['user_email']);
	$user_result = $db->get('users');
	$user = $user_result['0'];
	
	$nav = array('unread','stored','bookmark');
	
	$unread_count = $db->num_rows($db->query('select id from records where stored=0 AND userid='.$user['id']));
	$stored_count = $db->num_rows($db->query('select id from records where stored=1 AND userid='.$user['id']));
	
?>
<!DOCTYPE html>	

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> 				<html lang="en" class="ie ie6"> <![endif]-->
<!--[if IE 7 ]>					<html lang="en" class="ie ie7"> <![endif]-->
<!--[if IE 8 ]>					<html lang="en" class="ie ie8"> <![endif]-->
<!--[if IE 9 ]>					<html lang="en" class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 	<html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	
	<title>OpenLater</title>
	
	<link rel="shortcut icon" href="images/favicon.ico" />
	
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/style.css" />

</head>

<body>

	<div id="container">
		<header>
			<h1><span>Open</span>Later</h1>
			<!--<h2><?php echo ucfirst($mode); ?></h2>-->
		</header>
		
		<nav>
			<ul>
				<?php foreach($nav as $page): ?>
					<li><a href="<?php echo $page; ?>"<?php if($mode==$page) echo ' class="current"'; ?>><?php echo ucfirst($page); ?><?php
						if($page=='unread')echo ' ('.$unread_count.')';
						if($page=='stored')echo ' ('.$stored_count.')';
					?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</nav>
		
		<div id="main">
		<?php if($mode=='stored'||$mode=='unread'): ?>
			<ul>
				<?php 
					
					$records = $db->query("SELECT id,url,stored,title FROM records WHERE records.userid=".$user['id']);
					
					foreach($db->result_set($records) as $record): 
				?>
					<?php if($mode=='stored' && $record['stored'] || $mode=='unread' && !$record['stored']): ?>
					<li>
						<a href="<?php echo $record['url']; ?>" target="_blank"><?php echo $record['title']; ?></a>
						<span class="actions">
							<?php if($mode=='unread'): ?>
								<a href="store.php" data-id="<?php echo $record['id']; ?>" class="ajax">Store</a>
								<a href="delete.php" data-id="<?php echo $record['id']; ?>" class="ajax">Delete</a></span>
							<?php else: ?>
								<a href="delete.php" data-id="<?php echo $record['id']; ?>" class="ajax">Delete</a></span>
							<?php endif; ?>
					</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php elseif($mode=='bookmark'): ?>
			<?php include('bookmarklet.php'); ?>
		<?php endif; ?>
		</div>
	</div>
	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery-1.6.min.js"%3E%3C/script%3E'))</script>
	<script src="js/script.js"></script>
</body>
</html>