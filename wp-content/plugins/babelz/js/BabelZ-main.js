jQuery(function() {
	// Add Cursor to Box Headers & Text Clickies
	jQuery(".BabelZ-H,.checkBoxText").css("cursor","pointer");
	// Minimize/Maximize Boxes Based (On Stored Value)
	jQuery(".BabelZ-SH").each(function (i) {
		var a = jQuery(this).attr("target");
		if (jQuery("[name='"+ a +"']").val() == "hide") {
		    jQuery("[id='"+ a +"']").hide();
		}
	});
	// Minimize/Maximize Boxes (On Click)
	jQuery(".BabelZ-H").click(function () {
		var a = jQuery(this).attr('target');
		if (jQuery("[id='"+ a +"']").is(":hidden")) {
		    jQuery("[name='"+ a +"']").val("show");
		    jQuery("[id='"+ a +"']").toggle("fast");
		} else {
		    jQuery("[name='"+ a +"']").val("hide");
		    jQuery("[id='"+ a +"']").toggle("fast");
		}
	});
	// Show/Hide Google/Microsoft Settings (On Stored Value)
	jQuery("#BabelZ-Stored-Value1").each(function (i) {
		var a = jQuery(this).val();
		if (a == "" || a == "GTranslate") jQuery(".MTranslate").hide();
		else jQuery(".GTranslate").hide();
	});
	// Toggle Google/Microsoft Settings (On Click)
	jQuery("#BabelZ-Toggle").click(function () {
		if (jQuery("#GTranslate").is(":selected")) {
		    jQuery(".GTranslate").show();
		    jQuery(".MTranslate").hide();
		} else if (jQuery("#MTranslate").is(":selected")) {
		    jQuery(".GTranslate").hide();
		    jQuery(".MTranslate").show();
		}
	});
	// Toggle Display Mode Image (On Stored Value)
	jQuery("#BabelZ-Stored-Value2").each(function (i) {
		var a = jQuery(this).val();
		a = a.substr(a.length-7);
		if (a == "" || a == "ERTICAL") jQuery(".GMode2,.GMode3,.GMode4,.GMode5,.GMode6,.GMode7,.GMode8").hide();
		else if (a == "IZONTAL") jQuery(".GMode1,.GMode3,.GMode4,.GMode5,.GMode6,.GMode7,.GMode8").hide();
		else if (a == ".SIMPLE") jQuery(".GMode1,.GMode2,.GMode4,.GMode5,.GMode6,.GMode7,.GMode8").hide();
		else if (a == "M_RIGHT") jQuery(".GMode1,.GMode2,.GMode3,.GMode5,.GMode6,.GMode7,.GMode8").hide();
		else if (a == "OM_LEFT") jQuery(".GMode1,.GMode2,.GMode3,.GMode4,.GMode6,.GMode7,.GMode8").hide();
		else if (a == "P_RIGHT") jQuery(".GMode1,.GMode2,.GMode3,.GMode4,.GMode5,.GMode7,.GMode8").hide();
		else if (a == "OP_LEFT") jQuery(".GMode1,.GMode2,.GMode3,.GMode4,.GMode5,.GMode6,.GMode8").hide();
	});
	// Toggle Display Mode Image (On Click)
	jQuery("#BabelZ-Toggle2").click(function () {
		if (jQuery("#GMode1").is(":selected")) {
		    jQuery(".GMode1").show();
		    jQuery(".GMode2,.GMode3,.GMode4,.GMode5,.GMode6,.GMode7,.GMode8").hide();
		} else if (jQuery("#GMode2").is(":selected")) {
		    jQuery(".GMode2").show();
		    jQuery(".GMode1,.GMode3,.GMode4,.GMode5,.GMode6,.GMode7,.GMode8").hide();
		} else if (jQuery("#GMode3").is(":selected")) {
		    jQuery(".GMode3").show();
		    jQuery(".GMode1,.GMode2,.GMode4,.GMode5,.GMode6,.GMode7,.GMode8").hide();
		} else if (jQuery("#GMode4").is(":selected")) {
		    jQuery(".GMode4").show();
		    jQuery(".GMode1,.GMode2,.GMode3,.GMode5,.GMode6,.GMode7,.GMode8").hide();
		} else if (jQuery("#GMode5").is(":selected")) {
		    jQuery(".GMode5").show();
		    jQuery(".GMode1,.GMode2,.GMode3,.GMode4,.GMode6,.GMode7,.GMode8").hide();
		} else if (jQuery("#GMode6").is(":selected")) {
		    jQuery(".GMode6").show();
		    jQuery(".GMode1,.GMode2,.GMode3,.GMode4,.GMode5,.GMode7,.GMode8").hide();
		} else if (jQuery("#GMode7").is(":selected")) {
		    jQuery(".GMode7").show();
		    jQuery(".GMode1,.GMode2,.GMode3,.GMode4,.GMode5,.GMode6,.GMode8").hide();
		}
	});
	// Checkbox Toggle Check
	var i = 0;
	jQuery(".BabelZLanguageChecks:checked").each(function() {
	    i += 1;
	    if (i == 66) jQuery("#checkToggle").val("Uncheck all");
	});
	// Checkbox Toggle Button
	jQuery("#checkToggle").click(function(){
	    var a = jQuery(this).val();
	    if (a == "Check all") {
	    	jQuery(this).val("Uncheck all");
	    	jQuery(".BabelZLanguageChecks").attr('checked', true);
	    } else {
		jQuery(this).val("Check all");
		jQuery(".BabelZLanguageChecks").attr('checked', false);
	    }
	});
	// Checkbox Clicky Text
	jQuery("[data-labelfor]").click(function(){
	    jQuery('#' + jQuery(this).attr("data-labelfor")).prop('checked', function(i, oldVal) { return !oldVal; });
	});
});
