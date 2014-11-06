<?php

/*
Plugin Name: Smart Currency Converter for Woocommerce
Plugin URI: http://demos.codehoundbd.com/woocommerce/scc
Description: Autodetects visitor's local currency and shows converted prices in that currency. This plugin depends on WooCommerce. WooCommerce should be installed and activated for this plugin to work.
Author: Codehound
Author URI: http://codehoundbd.com
Version: 4.3
*/ 


include_once "register_settings.php";
include_once "renders.php";

$plugin_folder = 'ch_scc_woo';

function scc_add_scripts_to_admin_panel(){

	$plugin_folder = $GLOBALS['plugin_folder'];

	wp_enqueue_style( 'ch_scc_chosen_css', plugins_url() . "/$plugin_folder/css/chosen.min.css");

	wp_enqueue_style( 'ch_scc_admin_css', plugins_url() . "/$plugin_folder/css/jquery.scc_admin.css");

	wp_enqueue_style( 'ch_scc_css', plugins_url() . "/$plugin_folder/css/jquery.scc.css");


	wp_enqueue_script( 'ch_scc_maps_js', plugins_url() . "/$plugin_folder/js/scc_maps.js", array(), '1.0.0' );

	wp_enqueue_script( 'ch_scc_bpopup', plugins_url() . "/$plugin_folder/js/jquery.bpopup.min.js", array('jquery'), '1.0.0' );
	wp_enqueue_script( 'ch_scc_chosen_js', plugins_url() . "/$plugin_folder/js/chosen.jquery.min.js", array('jquery'), '1.0.0' );
	wp_enqueue_script( 'ch_scc_adminready', plugins_url() . "/$plugin_folder/js/scc_adminready.js", array('ch_scc_chosen_js', 'ch_scc_maps_js'), '1.0.0', true );

	$options = get_option('scc_currency_options');
	
	wp_localize_script('ch_scc_adminready', 'settings', array(
		
		'currencies' => $options['targets']

		));	
}

function get_scc_bool_option($opgroup, $option){

	if(array_key_exists($option, get_option($opgroup))){
		$options = get_option($opgroup);
		return $options[$option];
	}

	return 0;
}

function scc_add_scripts_to_post() {


	$plugin_folder = $GLOBALS['plugin_folder'];

	wp_enqueue_style( 'ch_scc_css', plugins_url() . "/$plugin_folder/css/jquery.scc.css");

	wp_enqueue_script( 'ch_scc_maps_js', plugins_url() . "/$plugin_folder/js/scc_maps.js", array(), '1.0.0' );
	wp_enqueue_script( 'ch_scc_js', plugins_url() . "/$plugin_folder/js/jquery.scc.min.js", array('ch_scc_bpopup','ch_scc_maps_js'), '1.0.0' );
	wp_enqueue_script( 'ch_scc_bpopup', plugins_url() . "/$plugin_folder/js/jquery.bpopup.min.js", array('jquery'), '1.0.0' );
	wp_enqueue_script( 'ch_scc_postready', plugins_url() . "/$plugin_folder/js/scc_postready.js", array('ch_scc_js'), '1.0.0' );

	$currency_options = get_option('scc_currency_options');
	$theme_options = get_option('scc_theme_options');	
	$misc_options = get_option('scc_misc_options');	
	$adv_options = get_option('scc_adv_options');	
	$popup_options = get_option('scc_popup_options');
	$exrate_options = get_option('scc_exrate_options');	

	$gear_url = plugins_url( 'img/gear.png' , __FILE__ );


	wp_localize_script('ch_scc_postready', 'settings', array(
		
		'baseCurrency' 							=> get_option('woocommerce_currency'),

		'targets'								=> $currency_options['targets'],
		'showFallbackOnAutodetectFailure'		=> get_scc_bool_option('scc_currency_options', 'showFallbackOnAutodetectFailure'),
		'autodetectFallbackCurrency'			=> $currency_options['autodetectFallbackCurrency'],
		'decimalPrecision'						=> get_scc_bool_option('scc_currency_options', 'decimalPrecision'),
		'thousandSeperator'						=> get_scc_bool_option('scc_currency_options', 'thousandSeperator'),

		'replaceOriginalPrice'					=> $theme_options['replaceOriginalPrice'],
		'replacedContentFormat'					=> $theme_options['replacedContentFormat'],
		'tooltipTheme'							=> $theme_options['tooltipTheme'],
		'tooltipAnimation'						=> $theme_options['tooltipAnimation'],
		'animationDuration'						=> $theme_options['animationDuration'],
		'showTooltipArrow'						=> get_scc_bool_option('scc_theme_options', 'showTooltipArrow'),
		'tooltipPosition'						=> $theme_options['tooltipPosition'],
		'tooltipShowDelay'						=> $theme_options['tooltipShowDelay'],
		'tooltipAlwaysOpen'						=> get_scc_bool_option('scc_theme_options', 'tooltipAlwaysOpen'),

		'exchangeRateUpdateInterval'			=> $misc_options['exchangeRateUpdateInterval'],
		'touchFriendly'							=> get_scc_bool_option('scc_misc_options', 'touchFriendly'),
		'hideTooltipToNativeVisitor'			=> get_scc_bool_option('scc_misc_options', 'hideTooltipToNativeVisitor'),

		'debugMode'								=> get_scc_bool_option('scc_adv_options', 'debugMode'),
		'customClasses'							=> $adv_options['customClasses'],

		'show_init_pop'							=> get_scc_bool_option('scc_popup_options', 'show_init_pop'),
		'show_config_pop'						=> get_scc_bool_option('scc_popup_options', 'show_config_pop'),
		'init_message'							=> $popup_options['init_message'],
		'init_message2'							=> $popup_options['init_message2'],

		'exchange_rates'						=> $exrate_options,
		'gearUrl'								=> $gear_url

	));

	


};


// function scc_filter($atts, $content){

// 	return "<span class='priceTag'>$content</span>";

// }

function scc_options_callback() {
	echo '';
}

function scc_adv_options_callback() {
	echo 'Please do not change anything here unless you absolutely know what you are doing.';
}

function render_scc_display(){

	$active_tab = 'currency';
	
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	}



	?>

	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>
		<h2>Woocommerce Smart Currency Converter</h2>
		

		<h2 class="nav-tab-wrapper">
			<a href='?page=scc_options_page&tab=currency' class="nav-tab <?php echo ($active_tab=='currency')?'nav-tab-active':''; ?>">Currency</a>
			<a href='?page=scc_options_page&tab=theme' class="nav-tab <?php echo ($active_tab=='theme')?'nav-tab-active':''; ?>">Appearance</a>
			<a href='?page=scc_options_page&tab=popup' class="nav-tab <?php echo ($active_tab=='popup')?'nav-tab-active':''; ?>">Popups</a>
			<a href='?page=scc_options_page&tab=exrate' class="nav-tab <?php echo ($active_tab=='exrate')?'nav-tab-active':''; ?>">Exchange Rates</a>
			<a href='?page=scc_options_page&tab=misc' class="nav-tab <?php echo ($active_tab=='misc')?'nav-tab-active':''; ?>">Miscellaneous</a>
			<a href='?page=scc_options_page&tab=adv' class="nav-tab <?php echo ($active_tab=='adv')?'nav-tab-active':''; ?>">Advanced</a>
		</h2>

		<?php settings_errors(); ?>

		<form method="post" action="options.php">

			<?php

			if($active_tab == 'currency'){
				settings_fields( 'scc_currency_options' );
				do_settings_sections( 'scc_currency_options' ); 
			}

			elseif ($active_tab == 'theme') {
				settings_fields( 'scc_theme_options' );
				do_settings_sections( 'scc_theme_options' ); 
			}

			elseif ($active_tab == 'popup') {
				settings_fields( 'scc_popup_options' );
				do_settings_sections( 'scc_popup_options' ); 
			}

			elseif ($active_tab == 'adv') {
				settings_fields( 'scc_adv_options' );
				do_settings_sections( 'scc_adv_options' ); 
			}

			elseif ($active_tab == 'exrate') {
				settings_fields( 'scc_exrate_options' );
				do_settings_sections( 'scc_exrate_options' ); 
			}

			else{

				settings_fields( 'scc_misc_options' );
				do_settings_sections( 'scc_misc_options' );
			}

			submit_button(); 

			?>
		</form>

	</div>

	<?php

}

function scc_plugin_menu() {

	add_submenu_page(
		'woocommerce',
		'Smart Currency Converter Settings', 			
		'Smart Currency Converter',			
		'administrator',			
		'scc_options_page',	
		'render_scc_display'	
		);

}

// Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	add_action('admin_menu', 'scc_plugin_menu');
	add_action( 'wp_enqueue_scripts', 'scc_add_scripts_to_post' );
	
	add_action('admin_init', 'init_options');
	add_action('admin_init', 'scc_add_scripts_to_admin_panel');

}
