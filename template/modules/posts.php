<?php
require_once 'lib/posts.lib.php';
require_once 'lib/post.lib.php';
require_once 'includes/helpers/pagination.php';

$Posts = new Posts();

$current_page = (isset($_GET['page']) && (int)$_GET['page'] >= 1)? (int)$_GET['page'] : 1;
$items_pp = 10;
$offset = ($current_page - 1) * $items_pp;
?>

<div class="posts">
	<?php
	if ($Posts->have_posts(array("draft" => 0))) { 
		foreach ($Posts->get_posts($offset, $items_pp, array("draft" => 0)) as $key) {
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

<?php echo paginate($current_page, $Posts->post_count(), $items_pp, 1, "") ?>