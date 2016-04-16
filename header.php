<?php 
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE HTML>
	<html <?php language_attributes(); ?>>

<!--<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />-->

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
  
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  
  <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
  
  <link href="/img/profile/apple-touch-icon.png" rel="apple-touch-icon" />
  <link href="/img/profile/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
  <link href="/img/profile/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
  <link href="/img/profile/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
  <link rel="icon" sizes="192x192" href="/img/profile/android-touch-icon-192x192.png">
  <link rel="icon" sizes="128x128" href="/img/profile/android-touch-icon-128x128.png">
  <link rel="icon" type="image/png" href="/img/profile/favicon.png" />
  
  <!--WINDOWS PHONE 8.1-->
  <meta name="application-name" content="EligeFacil" />
  <meta name="msapplication-TileColor" content=" #00b0ff" />
  <meta name="msapplication-square70x70logo" content="/img/profile/smalltile.png" />
  <meta name="msapplication-square150x150logo" content="/img/profile/mediumtile.png" />
  <meta name="msapplication-wide310x150logo" content="/img/profile/widetile.png" />
  <meta name="msapplication-square310x310logo" content="/img/profile/largetile.png" />
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

	<title><?php if(is_home()) bloginfo('name'); else wp_title(''); ?></title>

	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php
    wp_get_archives('type=monthly&format=link');
    wp_head();
  ?>
</head>

<body>
  <div id="canvas">
    <div id="primaryContent">