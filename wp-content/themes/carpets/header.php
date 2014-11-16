<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title><?php bloginfo('name'); ?> <?php wp_title('-'); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/assets/css/jquery.nstSlider.min.css" type="text/css" />
        
        <?php wp_head(); ?>
        
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!--<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/assets/js/jquery.min.js"></script>-->
        <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/assets/js/jquery.main.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/assets/js/gallery.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/assets/js/script.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory') ?>/assets/js/jquery.nstSlider.min.js"></script>
        <!--<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/assets/js/jquery-loader.js"></script>-->





        <script>var siteUrl = '<?php echo get_site_url(); ?>';</script>




</head>
<body>
	<div id="wrapper">
        <header id="header">
            <div class="top-bar">
                <div class="holder">
                    <form action="#" class="search-form">
                        <fieldset>
                            <input type="search" class="search" placeholder="SEARCH....">
                            <input type="submit" value="search">
                        </fieldset>
                    </form>
                    <div class="panel">
                        <div class="lang">
                            <a href="#" class="icon">Language</a>
                            <div class="drop">
                                <div class="list">
                                    <ul>
                                        <li><a href="#">ENG</a></li>
                                        <li><a href="#">中文</a></li>
                                        <li><a href="#">JAP</a></li>
                                        <li><a href="#">KOR</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="currency">
                            <a href="#" class="icon">Currency</a>
                            <div class="drop">
                                <div class="list">
                                    <ul>
                                        <li><a href="#">SGD</a></li>
                                        <li><a href="#">USD</a></li>
                                        <li><a href="#">RMB</a></li>
                                        <li><a href="#">YEN</a></li>
                                        <li><a href="#">EURO</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="wp-admin" class="login">Log in</a>
                        <a href="#" class="cart-bg">Cart</a>
                    </div>
                    <strong class="logo"><a href="#">Handmade Carpet Gallery</a></strong>
                    <!--<nav id="nav" class="add-nav">
                        <a href="" class="opener">open</a>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Collections</a></li>
                            <li><a href="#">Maintenance</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="#">Delivery</a></li>
                        </ul>
                    </nav>-->
                    <nav id="nav" class="add-nav">
                        <a href="" class="opener">open</a>
                    <?php
                    $defaults = array(
                        'container_class' => 'holder',
                        'menu_class' => 'fnav',
                        'menu'       => 'header-nav',
                        'items_wrap'      => '<ul class="%2$s">%3$s</ul>'

                    );

                    wp_nav_menu( $defaults );
                    ?>
                    </nav>
                </div>
            </div>
            <nav id="nav" class="main-nav">
                <a href="" class="opener">open</a>
                <!--<ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Collections</a></li>
                    <li><a href="#">Maintenance</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Delivery</a></li>
                </ul>-->
                <?php
                $defaults = array(
                    'container_class' => 'holder',
                    'menu_class' => 'fnav',
                    'menu'       => 'header-nav',
                    'items_wrap'      => '<ul class="%2$s">%3$s</ul>'

                );

                wp_nav_menu( $defaults );
                ?>
            </nav>
        </header>
		<section class="slider">
			<div class="mask">
				<div class="slideset">
					<div class="slide">
						<img src="<?php bloginfo('template_directory') ?>/assets/images/img.jpg" alt="">
						<span class="slide-title"><span>Collection</span></span>
					</div>
					<div class="slide">
						<img src="<?php bloginfo('template_directory') ?>/assets/images/img1.jpg" alt="">
						<span class="slide-title"><span>DESIGN</span></span>
					</div>
					<div class="slide">
						<img src="<?php bloginfo('template_directory') ?>/assets/images/img2.jpg" alt="">
						<span class="slide-title"><span>MAINTENANCE</span></span>
					</div>
				</div>
			</div>
			<div class="holder">
				<div class="heading">
					<!-- <h1><?php echo get_the_title(); ?></h1> -->
					<a href="#" class="btn-next">Next</a>
					<a href="#" class="btn-prev">Prev</a>
				</div>
			</div>
		</section>
		<div id="main">
			<h2><?php echo get_the_title(); ?></h2>
			<div class="holder">