<div class="clear"></div>

<div class="container" id="footer">
	<p class="legal">(c)<?php echo $Config->item("copyright_date")." ".$Config->item("copyright_holder") ?></p>
</div><!-- /footer -->


<!-- scripts -->
<script type="text/javascript">
	Cufon.now();
</script>

<script type="text/javascript" src="http://www.google.com/jsapi" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	google.load("jquery", "1.4.4");
</script>

<script type="text/javascript" src="<?php echo $path['js'] ?>jquery.easing.1.3.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $path['js'] ?>slider.js" charset="utf-8"></script>

<script type="text/javascript" src="<?php echo $path['js'] ?>main.js"  charset="utf-8"></script>

<?php if ($Template->current_page == "contact") { ?>
<script type="text/javascript" src="<?php echo $path['js'] ?>contact.js"  charset="utf-8"></script>
<?php } ?>

</body>
<html>