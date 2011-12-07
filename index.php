<?php
/**
 * Home page
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

require_once("includes/init.php");
require_once 'lib/posts.lib.php';
require_once 'lib/post.lib.php';

$Posts = new Posts();

$Template->set_current_page("home");

include("template/header.php");
?>

<?php include 'template/modules/content_slider.php' ?>

<div class="clear"></div>

<div class="container" id="main_content" style="margin-top: 30px;">	
	<div class="sidebar">
		<?php include 'template/modules/nav.php' ?>
		
		<?php include 'template/modules/hi_there.php' ?>
		
		<?php include 'template/modules/find_me.php' ?>
	</div><!-- /sidebar -->
	
	
	<div class="primary_content">
		<div class="posts">
			<?php
			if ($Posts->have_posts(array("draft" => 0, "ID" => $Posts->home_post()))) { 
				foreach ($Posts->get_posts(0, 1, array("draft" => 0, "ID" => $Posts->home_post())) as $key) {
					$Post = new Post($key);
			?>
			<div class="post">
				<div class="post_info">
					<h3 class="post_title"><a href="post.php/<?php echo $Post->permalink ?>"><?php echo uc($Post->title) ?></a></h3>
					<span class="post_date"><?php echo $Post->date("F d, Y") ?> <span style="padding:0 5px">&#8226;</span> <?php echo ucfirst($Post->category) ?></span>
				</div>
				
				<div class="post_content">
					<?php echo $Post->excerpt() ?>
				</div>
				
				<span class="read_more"><a href="post.php/<?php echo $Post->permalink ?>">Read more &raquo;</a></span>
			</div>
			<?php }} else { ?>
			No posts found :(
			<?php } ?>
		</div><!-- /posts -->
	</div><!-- /primary_content -->
</div><!-- /content -->

<?php include("template/footer.php"); ?>