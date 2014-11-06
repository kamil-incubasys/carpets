<?php

function init_options(){


	if( false == get_option( 'scc_currency_options' ) ) {	
		add_option( 'scc_currency_options' );

		update_option('scc_currency_options', array(


			"targets" => "autodetect",
			"showFallbackOnAutodetectFailure" => "1",
			"autodetectFallbackCurrency" => "USD",
			"decimalPrecision" => "0",
			"thousandSeperator" => "1"

			));

	}

	if( false == get_option( 'scc_theme_options' ) ) {	
		add_option( 'scc_theme_options' );

		update_option('scc_theme_options', array(

			"replaceOriginalPrice" => "0",
			"tooltipTheme" => "shadow",
			"tooltipAnimation" => "fade",
			"animationDuration" => "300",
			"showTooltipArrow" => "1",
			"tooltipPosition" => "top",
			"tooltipShowDelay" => "100",
			"replacedContentFormat" => "[convertedCurrencyCode] [convertedAmount]"
			
			));

	}

	if( false == get_option( 'scc_misc_options' ) ) {	
		add_option( 'scc_misc_options' );

		update_option('scc_misc_options', array(

			"exchangeRateUpdateInterval" => "30",
			"touchFriendly" => "1",
			"hideTooltipToNativeVisitor" => "0"
			));

	}

	if( false == get_option( 'scc_adv_options' ) ) {	
		add_option( 'scc_adv_options' );

		update_option('scc_adv_options', array(
			"debugMode" => "0",
			"customClasses" => ""
			));

	}

	if( false == get_option( 'scc_popup_options' ) ) {	
		add_option( 'scc_popup_options' );

		update_option('scc_popup_options', array(

			"show_init_pop" => "1",
			"show_config_pop" => "1",
			"init_message" => "Keep your mouse pointer over the prices to see them converted",
			"init_message2" => "You'd still have to pay in the stores default currency though."             

		    ));

	}

	if( false == get_option( 'scc_exrate_options' ) ) {	
		add_option( 'scc_exrate_options' );

		update_option('scc_exrate_options', "");
	}

	add_settings_section(
		'scc_currency_section',	
		'Currency Settings',	
		'scc_options_callback',	
		'scc_currency_options'		
	);

	add_settings_section(
		'scc_theme_section',	
		'Display Settings',	
		'scc_options_callback',	
		'scc_theme_options'		
	);

	add_settings_section(
		'scc_misc_section',	
		'Miscellaneous Settings',	
		'scc_options_callback',	
		'scc_misc_options'		
	);

	add_settings_section(
		'scc_adv_section',	
		'Advanced Settings',	
		'scc_adv_options_callback',	
		'scc_adv_options'		
	);

	add_settings_section(
		'scc_popup_section',	
		'Popup Settings',	
		'scc_options_callback',	
		'scc_popup_options'		
	);

	add_settings_section(
		'scc_exrate_section',	
		'Custom Exchange Rates',	
		'scc_exrate_callback',	
		'scc_exrate_options'		
	);



//	add_settings_field('baseCurrency',						'Base Currency'		,		'render_scc_baseCurrency',						'scc_currency_options',			'scc_currency_section'			);
	add_settings_field('targets',							'Target Currencies',		'render_scc_targets',							'scc_currency_options',			'scc_currency_section'			);
	add_settings_field('showFallbackOnAutodetectFailure',	'Fallback',					'render_scc_showFallbackOnAutodetectFailure',	'scc_currency_options',			'scc_currency_section'			);
	add_settings_field('autodetectFallbackCurrency',		'Fallback Currency',		'render_scc_autodetectFallbackCurrency',		'scc_currency_options',			'scc_currency_section'			);
	add_settings_field('decimalPrecision',					'Show 2 digits after dot',	'render_scc_decimalPrecision',					'scc_currency_options',			'scc_currency_section'			);
	add_settings_field('thousandSeperator',					'Comma Format',				'render_scc_thousandSeperator',					'scc_currency_options',			'scc_currency_section'			);

	add_settings_field('replaceOriginalPrice',				'Display Mode',				'render_scc_replaceOriginalPrice',				'scc_theme_options',			'scc_theme_section'			);
	add_settings_field('tooltipTheme',						'Theme',					'render_scc_tooltipTheme',						'scc_theme_options',			'scc_theme_section'			);
	add_settings_field('tooltipAnimation',					'Animation',				'render_scc_tooltipAnimation',					'scc_theme_options',			'scc_theme_section'			);
	add_settings_field('animationDuration',					'Animation Duration',		'render_scc_animationDuration',					'scc_theme_options',			'scc_theme_section'			);
	add_settings_field('showTooltipArrow',					'Show Arrow',				'render_scc_showTooltipArrow',					'scc_theme_options',			'scc_theme_section'			);
	add_settings_field('tooltipPosition',					'Position',					'render_scc_tooltipPosition',					'scc_theme_options',			'scc_theme_section'			);
	add_settings_field('tooltipShowDelay',					'Show Delay',				'render_scc_tooltipShowDelay',					'scc_theme_options',			'scc_theme_section'			);
	add_settings_field('tooltipAlwaysOpen',					'Open All Tooltips',		'render_scc_tooltipAlwaysOpen',					'scc_theme_options',			'scc_theme_section'			);
	add_settings_field('replacedContentFormat',				'Replaced Content Format',	'render_scc_replacedContentFormat',				'scc_theme_options',			'scc_theme_section'			);



	add_settings_field('exchangeRateUpdateInterval',		'Update Exchange Rate Cache','render_scc_exchangeRateUpdateInterval',		'scc_misc_options',				'scc_misc_section'			);
	add_settings_field('hideTooltipToNativeVisitor',		'Hide to Native Visitor',	'render_scc_hideTooltipToNativeVisitor',		'scc_misc_options',				'scc_misc_section'			);
	add_settings_field('touchFriendly',						'Touch Friendly',			'render_scc_touchFriendly',						'scc_misc_options',				'scc_misc_section'			);

	add_settings_field('debugMode',							'Enable Debugging Mode',	'render_scc_debugMode',							'scc_adv_options',				'scc_adv_section'			);
	add_settings_field('customClasses',						'Custom Price Selectors',	'render_scc_customClasses',						'scc_adv_options',				'scc_adv_section'			);


	add_settings_field('show_init_pop',						'Show Initial Popup Message','render_scc_show_init_pop',					'scc_popup_options',			'scc_popup_section'			);
	
	add_settings_field('init_message',						'Popup Message Line 1',	'render_scc_init_message',						'scc_popup_options',			'scc_popup_section'			);
	add_settings_field('init_message2',						'Popup Message Line 2',	'render_scc_init_message2',						'scc_popup_options',			'scc_popup_section'			);
	add_settings_field('show_config_pop',					'Enable User Preferences',	'render_scc_show_config_pop',					'scc_popup_options',			'scc_popup_section'			);

//	add_settings_field('exchange_rates',					'Your custom exchange rates',	'render_scc_exrates',					'scc_exrate_options',			'scc_exrate_section'			);



	register_setting(
		'scc_currency_options',
		'scc_currency_options'
	);

	register_setting(
		'scc_theme_options',
		'scc_theme_options'
	);

	register_setting(
		'scc_misc_options',
		'scc_misc_options'
	);

	register_setting(
		'scc_adv_options',
		'scc_adv_options'
	);

	register_setting(
		'scc_popup_options',
		'scc_popup_options'
	);

	register_setting(
		'scc_exrate_options',
		'scc_exrate_options'
	);


}


?>