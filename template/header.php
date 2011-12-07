<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="Author" content="<?php echo $Config->item("site_author") ?>" />
	<meta name="Copyright" content="<?php echo $Config->item("copyright_holder") ?>" />
	<meta name="Description" content="<?php echo ($Template->meta_desc === null)? $Config->item("site_description") : $Template->meta_desc ?>" />
	<meta name="Keywords" content="<?php echo implode(",", array_merge($Config->item("site_keywords"), $Template->meta_keywords)) ?>" />
	<meta name="Robots" content="index, follow" />
	
	<title><?php echo $Config->item("app_name") ?><?php if ($Template->subtitle !== null) echo " - ".$Template->subtitle; ?></title>
	
	<link rel="stylesheet" href="<?php echo $path['css'] ?>master.css?0001" type="text/css" media="screen" title="master css" charset="utf-8">
	<link rel="shortcut icon" href="favicon.ico">
	
	<script type="text/javascript" src="<?php echo $path['js'] ?>cufon-yui.js"></script>
	<script type="text/javascript" src="<?php echo $path['js'] ?>Calluna_font.js"></script>
	<script type="text/javascript">
		Cufon.replace('h1, h2, h3, h4, h5, .box_title, .font_title', {hover: true});
	</script>
</head>

<body id="body">
<div class="container" id="header">
	<h1 id="davidmoreen"><a href="<?php echo $base_url ?>"></a></h1>
	<div class="download_vcard">
		<a href="<?php echo $Me->vcard ?>" class="tooltip_enabled" title="Download VCard"><img src="<?php echo $path['images'] ?>vcard.gif" /></a>
	</div>
	
	<div class="clear"></div>
	
	<div id="breadcrumb">
		<span class="bc_item"><a href="<?php echo $base_url ?>">Home</a></span>
		<span>&raquo;</span>
		<span class="current bc_item"><?php echo ucfirst($Template->current_page) ?></span>
	</div>
</div><!-- /header -->