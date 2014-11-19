<?php
/*
Plugin Name: BabelZ
Plugin URI: http://www.rswr.net/babelz-translation-widgets-wordpress-plugin/
Description: Display a Google Translate widget in your side bar. <a href="options-general.php?page=BabelZ.php">Settings</a>
Version: 1.1.3
Author: Ryan Christenson (The RSWR Network)
Author URI: http://www.rswr.net/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists("BabelZ")) {
	class BabelZ {
		var $adminOptionsName = "BabelZ_Admin_Options";
		function BabelZ() { //constructor
		}

		//Prints out the admin page
		function printAdminPage() {
			if (isset($_POST['Update-BabelZ-Settings'])) {
				// Save General Settings
				$BabelZ_Hide1 = $_POST['BabelZ-Hide1'];
				update_option('BabelZ_Hide1', $BabelZ_Hide1);
  				$BabelZ_Hide2 = $_POST['BabelZ-Hide2'];
  				update_option('BabelZ_Hide2', $BabelZ_Hide2);
  				$BabelZ_Hide3 = $_POST['BabelZ-Hide3'];
  				update_option('BabelZ_Hide3', $BabelZ_Hide3);
				if($_POST['BabelZ-Prom'] == "on") update_option('BabelZ_Prom', "checked=on");
  				else update_option('BabelZ_Prom', "");
  				$BabelZ_Widg = $_POST['BabelZ-Widg'];
  				update_option('BabelZ_Widg', $BabelZ_Widg);
  				
  				// Save Google Translate Settings
  				$BabelZ_G_Lang1 = $_POST['BabelZ-G-Lang1'];
  				update_option('BabelZ_G_Lang1', $BabelZ_G_Lang1);
  				for ($i=0; $i<count($_POST['BabelZ-G-Lang2']);$i++) {
				    if ($i == 0) $BabelZ_G_Lang2 .= $_POST['BabelZ-G-Lang2'][$i];
				    else $BabelZ_G_Lang2 .= ','.$_POST['BabelZ-G-Lang2'][$i];
  				}
  				update_option('BabelZ_G_Lang2', $BabelZ_G_Lang2);
  				$BabelZ_G_Mode = $_POST['BabelZ-G-Mode'];
  				update_option('BabelZ_G_Mode', $BabelZ_G_Mode);
  				if($_POST['BabelZ-G-Auto'] == "on") update_option('BabelZ_G_Auto', "checked=on");
  				else update_option('BabelZ_G_Auto', "");
  				if($_POST['BabelZ-G-Mult'] == "on") update_option('BabelZ_G_Mult', "checked=on");
  				else update_option('BabelZ_G_Mult', "");

  				// Save Microsoft Translate Settings
  				// Future Placeholder

				// Update Admin
				update_option($this->adminOptionsName, $BabelZOptions);
?>
<div class="updated"><p><span class="BabelZ-Bold"><?php _e("BabelZ Options Updated!", "BabelZ");?></span></p></div>
<?php
			}
?>
<div class="wrap">
<h2><?php _e('BabelZ - 1.1.3','BabelZ'); ?></h2>
<style type="text/css">
<!--
.BabelZ-Pad td		{padding:10px;text-align:left;font-weight:700;}
.BabelZ-Pad th		{text-align:left;vertical-align:top;font-weight:700;}
.BabelZ-Bold		{font-weight:700;}
.BabelZ-Countries	{float:left;width:150px;}
.BabelZ-Clear		{clear:both;}
#BabelZ-CLog ul		{list-style:square;margin:0 0 16px 30px;}
#BabelZ-CLog li		{margin:2px;}
-->
</style>
<form class="form-table" method="post" action="<?php _e($_SERVER["REQUEST_URI"]); ?>">
<?php
$path = trailingslashit(dirname(__FILE__));
//General Options
if(file_exists($path.'options/a-gen.php')) require_once($path.'options/a-gen.php');
?>
	<input type="submit" name="Update-BabelZ-Settings" value="<?php _e('Update Settings', 'BabelZ') ?>" class="button-primary action"><br><br>
</form>
</div>
<?php
		}
	}
}

// Widget Content
if (!function_exists("BabelZ_Widget")) {
    function BabelZ_Widget() {
	$BabelZ_Widg = get_option('BabelZ_Widg');
	
	// Google Translate
	if ($BabelZ_Widg == 'GTranslate') {
	    $BabelZ_G_Lang1 = get_option('BabelZ_G_Lang1');
	    $BabelZ_G_Lang2 = get_option('BabelZ_G_Lang2');
	    $BabelZ_G_Mode = get_option('BabelZ_G_Mode');
	    $BabelZ_G_Auto = get_option('BabelZ_G_Auto');
	    $BabelZ_G_Mult = get_option('BabelZ_G_Mult');
	    
	    if ($BabelZ_G_Auto == 'checked=on') $BabelZ_G_Auto = 'true';
	    else $BabelZ_G_Auto = 'false';
	    if ($BabelZ_G_Mult == 'checked=on') $BabelZ_G_Mult = 'true';
	    else $BabelZ_G_Mult = 'false';
_e("
	    <div id='google_translate_element'></div>
	    <script>
		function googleTranslateElementInit() {
		    new google.translate.TranslateElement({
			pageLanguage: '".$BabelZ_G_Lang1."',
			includedLanguages: '".$BabelZ_G_Lang2."',
			layout: ".$BabelZ_G_Mode.",
			autoDisplay: ".$BabelZ_G_Auto.",
			multilanguagePage: ".$BabelZ_G_Mult."
		    }, 'google_translate_element');
		}
	    </script><script src='http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'></script>
");
	}
	// Microsoft/Bing Translate
	else if ($BabelZ_Widg == 'MTranslate') {
	    // Future Placeholder
	}

	// Show Promote Link
  	if (get_option('BabelZ_Prom') == "checked=on") {
		_e('<p><a href="http://www.rswr.net/babelz-translation-widgets-wordpress-plugin/" title="BabelZ WordPress Plugin">BabelZ (WordPress Plugin)</a></p>');
	}
    }
}

// Widget Controls
if (!function_exists("BabelZ_Widget_Control")) {
    function BabelZ_Widget_Control() {
    	// On Post Save
    	if (isset($_POST['BabelZ-Submit'])) {
    		if($_POST['BabelZ-Prom'] == "on") update_option('BabelZ_Prom', "checked=on");
  		else update_option('BabelZ_Prom', "");
    	}
	
	_e('<a href="options-general.php?page=BabelZ.php">Widget Settings</a><br><br>');
	_e('<input type="checkbox" name="BabelZ-Prom"'.get_option('BabelZ_Prom').'/> Place a support link under the widget. Thanks for your support!');
  	_e('<input type="hidden" id="BabelZ-Submit" name="BabelZ-Submit" value="1" />');

    }
}

// Get Plugin URL
if (!function_exists("BabelZ_Url")) {
	function BabelZ_Url() {
		$path = dirname(__FILE__);
		$path = str_replace("\\","/",$path);
		$path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
		return $path;
	}
}

// Initialize Widget
if (!function_exists("BabelZ_Widget_Init")) {
    function BabelZ_Widget_Init() {
        $id = 'BabelZ-1';
        $title = 'BabelZ';
        $ops = array('classname' => 'widget_babelz', 'description' => __('Google Translation Widget.'));
	wp_register_sidebar_widget($id, $title, "BabelZ_Widget", $ops);
	wp_register_widget_control ($id, $title, "BabelZ_Widget_Control");
    }
}

//Initialize the admin panel
if (!function_exists("BabelZ_ap")) {
	function BabelZ_ap() {
		global $BabelZ_init;
		wp_enqueue_script('BabelZ-Main','/wp-content/plugins/babelz/js/BabelZ-main.js', array('jquery'), '1.0');
		if (!isset($BabelZ_init)) {
			return;
		}
		if (function_exists('add_options_page')) {
			add_options_page('BabelZ', 'BabelZ', 9, basename(__FILE__), array(&$BabelZ_init, 'printAdminPage'));
		}
	}
}

// Initialize Class
if (class_exists("BabelZ")) {
	$BabelZ_init = new BabelZ();
}

//Actions and Filters
if (isset($BabelZ_init)) {
	//Actions
	add_action('babelz/BabelZ.php', array(&$BabelZ_init, 'init'));
	add_action('admin_menu', 'BabelZ_ap');
	add_action("plugins_loaded", "BabelZ_Widget_Init");
}
?>
