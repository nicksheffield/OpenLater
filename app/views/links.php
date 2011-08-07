<ul>
	<?php foreach($result as $link): ?>
		<li>
			<a href="<?php echo $link['url']; ?>" target="_blank"><?php echo $link['title']; ?></a>
			<span class="actions">
					<?php if(!isset($stored)): ?><a href="store/<?php echo $link['id']; ?>">Store</a><?php endif; ?>
					<a href="delete/<?php echo $link['id']; ?>">Delete</a>
			</span>
		</li>
	<?php endforeach; ?>
</ul>