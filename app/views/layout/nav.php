<nav>
	<ul>
		<?php foreach($this->nav as $page): ?>
			<li><a href="<?php echo $page; ?>"><?php echo ucfirst($page); ?><?php echo isset($count[$page])?' ('.$count[$page].')':'';?></a>
		</li>
		<?php endforeach; ?>
	</ul>
</nav>

<div id="main">