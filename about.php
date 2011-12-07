<?php
/**
 * Post page
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */

require_once 'includes/init.php';

$Author = new Author($Uri->segment(1));
$Me     = $Author;

$Template->set_current_page("about");
$Template->set_meta_keywords(array("About ".lc($Author->name)));

if ($Author->exists) {
	$Template->set_subtitle("About ".$Author->display_name);
} else {
	$Template->set_subtitle("Nothing to see");
}

include("template/header.php");
?>

<div class="container" id="main_content" style="margin-top: 30px;">	
	<div class="sidebar">
		<?php include 'template/modules/nav.php' ?>
		
		<?php include 'template/modules/find_me.php' ?>
	</div><!-- /sidebar -->
	
	
	<div class="primary_content">
		<?php if ($Author->exists) { ?>
		<div class="about">
			<div class="image_box2" style="margin-bottom:20px">
				<img src="<?php echo str_replace("[IMAGES_PATH]", $path['images'], $Author->image['large']) ?>" title="Me" />
			</div>
			<?php echo $Author->about ?>
		</div>
		<?php } else { ?>
		Author not found :(
		<?php } ?>
</div><!-- /content -->

<?php include("template/footer.php"); ?>