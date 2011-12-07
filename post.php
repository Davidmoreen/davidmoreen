<?php
/**
 * Post page
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

require_once 'includes/init.php';
require_once 'lib/posts.lib.php';
require_once 'lib/post.lib.php';

$Posts        = new Posts();
$uri_segment  = $Uri->segment(1);
$post_found   = $Posts->have_posts(array("draft" => 0, "permalink" => $uri_segment));

if ($post_found) {
	$Post = new Post( array_shift($Posts->get_posts(0, 1, array("draft" => 0, "permalink" => $uri_segment))) );
	
	$Template->set_current_page($Post->title);
	$Template->set_subtitle($Post->title);
	
	if ($Post->meta_desc != null) {
		$Template->set_meta_desc($Post->meta_desc);
	}
	
	if (count($Post->meta_keywords) > 0) {
		$Template->set_meta_keywords($Post->keywords_array());
	}
} else {
	$Template->set_current_page("Nothing to see");
	$Template->set_subtitle("Nothing to see");
}

include("template/header.php");
?>

<div class="container" id="main_content" style="margin-top: 30px;">	
	<div class="sidebar">
		<?php include 'template/modules/nav.php' ?>
		
		<?php include 'template/modules/hi_there.php' ?>
		
		<?php include 'template/modules/find_me.php' ?>
	</div><!-- /sidebar -->
	
	
	<div class="primary_content">
		<div class="posts">
			<?php if ($post_found) { ?>
			<div class="post">
				<div class="post_info">
					<h3 class="post_title"><?php echo uc($Post->title) ?></h3>
					<span class="post_date"><?php echo $Post->date("F d, Y") ?> <span style="padding:0 5px">&#8226;</span> <?php echo ucfirst($Post->category) ?></span>
				</div>
				
				<div class="post_content">
					<?php echo $Post->content ?>
				</div>
			</div>
			<?php } else { ?>
			Post not found :(
			<?php } ?>
		</div><!-- /posts -->
	</div><!-- /primary_content -->
</div><!-- /content -->

<?php include("template/footer.php"); ?>