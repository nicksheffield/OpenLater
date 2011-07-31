

<div id="main">
	<ul>
		<?php foreach($result as $link): ?>
			<?php if(!$link['stored']): ?>
			<li>
				<a href="<?php echo $link['url']; ?>" target="_blank"><?php echo $link['title']; ?></a>
				<span class="actions">
						<a href="store/<?php echo $link['id']; ?>" class="ajax">Store</a>
						<a href="delete/<?php echo $link['id']; ?>" class="ajax">Delete</a>
				</span>
			</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</div>