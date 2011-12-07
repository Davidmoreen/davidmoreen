<div class="sidebar_item">
	<h2>Hi there!</h2>
	<div class="image_box1">
		<img src="<?php echo str_replace("[IMAGES_PATH]", $path['images'], $Me->image['small']) ?>" title="Me" />
	</div>
	
	<p><?php echo truncate_word($Me->about, 25) ?></p>
	<p style="text-align:right"><a href="<?php echo $base_url ?>about.php/<?php echo $Me->display_name ?>">Read more &raquo;</a></p>
</div>