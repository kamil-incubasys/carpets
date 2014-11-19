
var scc_init_popup_msg = "<div class='scc_initpop'><span class='scc_closeBtn'>X</span><header><h2>" + settings.init_message + "</h2><p>" + settings.init_message2 + "</p></header></div>"



var scc_init_popups = function(){

	var scc_firstPage = false;

	if(!(jQuery.cookie("notFirstTime"))){
		scc_firstPage = true;
		jQuery.cookie("notFirstTime", "1");
	}


	if(scc_firstPage && settings.show_init_pop == '1'){

		jQuery('body').append(scc_init_popup_msg);

		jQuery('.scc_initpop').bPopup({transition: 'slideDown', position: [0, 0],  followSpeed: 0, closeClass:"scc_closeBtn"});

	}

	if(settings.show_config_pop == '1'){

		var country = localStorage['scc_countryCode'];
		var countries = jQuery.scc_getAllCountries();


		var popupHTML;

		if(country === undefined || country === 'XX'){

			popupHTML = "<div class='scc_configpop'><span class='scc_closeBtn'>X</span><p>Your selected currency is <strong>" + jQuery.scc_autodetectFallbackCurrency + "</strong>. <button class='scc_keep'>Keep it</button></p><p>Or change country: <select id='scc_currencySelect'>";

		}else{

			popupHTML = "<div class='scc_configpop'><span class='scc_closeBtn'>X</span><p>Your selected country and currency are <strong>" + countries[country].countryName + " (" + countries[country].currencyCode +")</strong>. <button class='scc_keep'>Keep it</button></p><p>Or change country: <select id='scc_currencySelect'>";

		}

	

		

		

		

		for (var key in countries){
			popupHTML += "<option value='" + key + "' " + ((key==country)?"selected":"") + " >" + countries[key].countryName + " (" + countries[key].currencyCode + ")</option>";
		}


		popupHTML += "</select><button class='scc_upd'>Save</button></p></div>";

		jQuery('body').append(popupHTML);

		jQuery('.scc_keep').click(function(){
			jQuery('.scc_configpop').bPopup().close();
		});

		jQuery('.scc_upd').click(function(){

	

			localStorage['scc_countryCode'] = jQuery('#scc_currencySelect').val();

			jQuery('.scc_configpop').bPopup().close();

			location.reload(true);
		});

		if(settings.replaceOriginalPrice === '1'){

			jQuery.each(jQuery('.scc_settings_icon'), function (index, element){
				jQuery(this).height(jQuery(this).siblings('.amount').height()*0.8);
				jQuery(this).width(jQuery(this).siblings('.amount').height()*0.8);
			});

			jQuery('.scc_settings_icon').click(function (evt){
				jQuery('.scc_configpop').bPopup({ followSpeed: 0, closeClass:"scc_closeBtn"});
				evt.stopPropagation();
				evt.preventDefault();
			});
		}

		
	}



	

};

var jscc_options = {

//	replaceOriginalPrice : settings.replaceOriginalPrice==='1',
    replaceOriginalPrice : true,
	baseCurrency   : settings.baseCurrency,
	targets   : settings.targets.split(','), 
	showFallbackOnAutodetectFailure   : settings.showFallbackOnAutodetectFailure==='1',
	autodetectFallbackCurrency   : settings.autodetectFallbackCurrency,
	decimalPrecision   : (settings.decimalPrecision==='1')?2:0,
	thousandSeperator   : (settings.thousandSeperator==='1')?',':'',
	tooltipTheme   : settings.tooltipTheme,
	tooltipAnimation   : settings.tooltipAnimation,
	animationDuration   : settings.animationDuration,
	showTooltipArrow   : settings.showTooltipArrow==='1',
	tooltipPosition   : settings.tooltipPosition,
	tooltipShowDelay   : settings.tooltipShowDelay,
	exchangeRateUpdateInterval   : settings.exchangeRateUpdateInterval,
	touchFriendly   : settings.touchFriendly==='1',
	hideTooltipToNativeVisitor   : settings.hideTooltipToNativeVisitor==='1',
	debugMode : settings.debugMode==='1',
	showConfigPop: settings.show_config_pop ==='1',
	onFinish : scc_init_popups,
	tooltipAlwaysOpen: settings.tooltipAlwaysOpen ==='1',
	exchangeRateOverrides : settings.exchange_rates,
	gearUrl : settings.gearUrl,
	replacedContentFormat: settings.replacedContentFormat
};

jQuery(document).ready(function(){


	var selectors = settings.customClasses.split(',');

	jQuery.each(selectors, function (index, element){
		selectors[index] = selectors[index].replace(/^\s+|\s+$/g,'');
	});

	if(settings.debugMode==='1'){
		console.log("Custom selectors are: ")
		console.log(selectors);	
	}
	

	window.setTimeout( function(){

		jQuery('.amount').currencyConverter(jscc_options);

		jQuery.each(selectors, function (index, element){

			jQuery(selectors[index]).currencyConverter(jscc_options);

		});


	} ,500);

	
	
});
