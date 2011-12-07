<div class="sidebar_item" id="navigation">
	<ul>
		<li><a href="<?php echo $base_url ?>" <?php if ($Template->current_page == "home") echo 'class="current"' ?>>Home</a></li>
		<li><a href="<?php echo $base_url ?>about.php/<?php echo $Me->display_name ?>" <?php if ($Template->current_page == "about") echo 'class="current"' ?>>About myself</a></li>
		<li><a href="<?php echo $base_url ?>posts.php" <?php if ($Template->current_page == "blog") echo 'class="current"' ?>>Blog</a></li>
		<li><a href="<?php echo $base_url ?>contact.php" <?php if ($Template->current_page == "contact") echo 'class="current"' ?>>Contact me</a></li>
	</ul>
</div>