<nav>
	<ul>
		<?php foreach(array('unread','stored','bookmark') as $page): ?>
			<li><a href="<?php echo $page; ?>"><?php echo ucfirst($page); ?><?php
				if($page=='unread')echo ' ('.$unread_count.')';
				if($page=='stored')echo ' ('.$stored_count.')';
			?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
</nav>