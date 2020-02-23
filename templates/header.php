<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo @$meta_description; ?>">
	<meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <meta name="author" content="">
	<meta name='robots' content='index,follow'>
	<link rel='alternate' type='application/rss+xml' title='RSS' href='<?php echo @$site_url; ?>?rss=<?php echo @$cat; ?>'>
	<link rel="shortcut icon" href="<?php echo @$site_url; ?>favicon.ico" type="image/x-icon">
	

    <title><?php echo @$title; ?> | <?php echo $site_title; ?></title>
	

	<meta property="og:title" content="<?php echo @$title; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:description" content="<?php echo @$meta_description; ?>" />
	<!--meta property="og:image" content="<?php echo @$site_url; ?>og-image.php?img_url=<?php echo @$thumb; ?>" /-->
	<meta property="og:url" content="<?php echo @$canonical_url; ?>" />
	<meta property="og:site_name" content="<?php echo $site_title; ?>" />

	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo @$title; ?>">
	<meta name="twitter:description" content="<?php echo $site_title; ?>">
	<!--meta name="twitter:image" content="<?php echo @$site_url; ?>og-image.php?img_url=<?php echo @$thumb; ?>"-->
	<meta name="twitter:url" content="<?php echo @$canonical_url; ?>">
    
	<!--site specific all styles-->
	<style>
	  :root {
		  --main-theme-color: <?php echo $main_theme_color; ?>
		}
	</style>
	<link rel="stylesheet" href="<?php echo @$site_url; ?>assets/css/styles.css">
  </head>
<body >