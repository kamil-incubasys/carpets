<?php

/**
 * Plugin Name: Grid Gallery Ready!
 * Description: Easy to use Grid Gallery with professional gallery templates. Show off your best design, photography and creative work
 * Version: 0.6.3.2
 * Author: gallery plugin ready
 * Author URI: http://readyshoppingcart.com/product/grid-gallery-wordpress-plugin-ready/
 **/

require_once dirname(__FILE__) . '/app/ReadyGirdGallery.php';

$readyGirdGallery = new ReadyGirdGallery();
$readyGirdGallery->run();
