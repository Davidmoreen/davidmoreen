<?php
/**
 * Posts (blog) page
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

require_once("includes/init.php");

$Template->set_current_page("blog");

include("template/header.php");
?>

<div class="clear"></div>

<div class="container" id="main_content" style="margin-top: 30px;">	
	<div class="sidebar">
		<?php include 'template/modules/nav.php' ?>
		
		<?php include 'template/modules/hi_there.php' ?>
		
		<?php include 'template/modules/find_me.php' ?>
	</div><!-- /sidebar -->
	
	
	<div class="primary_content">
		<?php include 'template/modules/posts.php' ?>
	</div><!-- /primary_content -->
</div><!-- /content -->

<?php include("template/footer.php"); ?>