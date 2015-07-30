<html>
<head>
 <title>SoundDog</title>
 <link rel="stylesheet" href="<?php
 bloginfo('stylesheet_url'); ?>">
 
 <link rel="shortcut icon" href="http://localhost:81/wordpress/wp-content/uploads/2015/03/download.png" type="image/x-icon" />
</head>
<body>
 <div id="wrapper" />
 <div id="header" />
 <?php wp_head(); ?>
<div id="logoDiv"><a href="index.php" title="SoundDog" id="logo">SoundDog</a></div>

<div id="menu">
	<ul id="topnav">
		<li id="topnav-1"><a href="index.php"><img src="http://localhost:81/wordpress/wp-content/uploads/2015/02/home.png" ></img></li>
		<li id="topnav-3"><a href="http://localhost:81/wordpress/?page_id=64"><img src="http://localhost:81/wordpress/wp-content/uploads/2015/02/about.png" ></img></li>
		<li id="topnav-4"><a href="http://localhost:81/wordpress/?page_id=67"><img src="http://localhost:81/wordpress/wp-content/uploads/2015/02/gallery.png" ><img></li>
		<li id="topnav-5"><a href="http://localhost:81/wordpress/?page_id=122"><img src="http://localhost:81/wordpress/wp-content/uploads/2015/03/Top-10-Icon.png" ><img></li>
		<li id="topnav-6"><a href="http://localhost:81/wordpress/?page_id=158"><img src="http://localhost:81/wordpress/wp-content/uploads/2015/03/ticket-black.png" ><img></li>
	</ul>
</div>
<div id="accountDetails"> 
	<ul>
		<li id="registerBtn"><?php wp_register(' ' , ' '); ?> | </li>
	    <li id="loginBtn"><?php wp_loginout(); ?> | </li>
	</ul>
</div>

</div>
