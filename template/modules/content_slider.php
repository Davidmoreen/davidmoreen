<?php
require_once 'lib/slide.lib.php';

$slides = $Db->query("SELECT * FROM ".PREFIX."featured_slides ORDER BY created_at DESC LIMIT 0,10");

if ($slides->num_rows) {
?>

<div class="container" id="slider">
	<ul id="content_slider">
		<?php
		while ($row = $slides->fetch_assoc()) {
			$Slide = new Slide($row);
		?>
		<li class="content_slide">
			<?php if ($Slide->has_content()) { ?>
			<div class="slide_contents">
				<span class="slide_title"><?php echo $Slide->title ?></span>
				
				<p class="slide_content"><?php echo $Slide->content() ?></p>
				<p style="text-align:right"><a href="<?php echo $Slide->link_destionation ?>"><?php echo $Slide->has_custom_link_title()? $Slide->link_title : "View more..." ?></a></p>
			</div>
			<?php } ?>
			
			<img src="<?php echo $Slide->image() ?>" class="slider_bg_image">
		</li>
		<?php } ?>
		
		<div id="slider_components">
			<div class="slider_arrow_left"></div>
			<div class="slider_arrow_right"></div>
			<ul class="slider_selector"></ul>
		</div>
	</ul>
</div>
<?php } ?>