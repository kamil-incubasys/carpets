

function bindFallbackCurrencyToggle(){

	if(jQuery("#scc_showFallbackOnAutodetectFailure").is(':checked')){
		jQuery("#scc_autodetectFallbackCurrency").closest("tr").show();
		//console.log("shown");
	} else {

		jQuery("#scc_autodetectFallbackCurrency").closest("tr").hide();
		//console.log("hidden");
	}

	jQuery("#scc_showFallbackOnAutodetectFailure").change(function() {
		if(this.checked) {

			jQuery("#scc_autodetectFallbackCurrency").closest("tr").show();
		} else {
			jQuery("#scc_autodetectFallbackCurrency").closest("tr").hide();
		}
	});
}

function bindChosenTargets (settings){


	jQuery('.scc_chosen_select').chosen();
	//console.log("I got " + settings.currencies);

	var cs;
	if(settings.currencies == "") cs = [];
	else cs = settings.currencies.split(',');


	jQuery('.scc_chosen_select').on('change', function(evt, params) {

		if('selected' in params){
			cs.push(params.selected);
		}

		if('deselected' in params){
			var index = cs.indexOf(params.deselected);

			if(index>=0) cs.splice(index, 1);
		}

		var csStr = "";
		jQuery.each(cs, function (index, element){

			//console.log("" + index);
			if(index!==0) csStr += ',';
			csStr += element;
		})

		//console.log(csStr);

		jQuery('#targetField').val(csStr);

	});

}

function bindFallreplaceOriginalToggle(){

	if( jQuery("#scc_replaceOriginalPrice").val()==='1' ){

	
		jQuery("#scc_tooltipTheme").closest("tr").hide();
		jQuery("#scc_tooltipAnimation").closest("tr").hide();
		jQuery("#scc_animationDuration").closest("tr").hide();
		jQuery("#scc_tooltipPosition").closest("tr").hide();
		jQuery("#scc_showTooltipArrow").closest("tr").hide();
		jQuery("#scc_tooltipDelay").closest("tr").hide();
		jQuery("#scc_tooltipAlwaysOpen").closest("tr").hide();
		jQuery("#scc_replacedContentFormat").closest("tr").show();
		
		console.log("shown");
	} else {

		jQuery("#scc_tooltipTheme").closest("tr").show();
		jQuery("#scc_tooltipAnimation").closest("tr").show();
		jQuery("#scc_animationDuration").closest("tr").show();
		jQuery("#scc_tooltipPosition").closest("tr").show();
		jQuery("#scc_showTooltipArrow").closest("tr").show();
		jQuery("#scc_tooltipDelay").closest("tr").show();
		jQuery("#scc_tooltipAlwaysOpen").closest("tr").show();
		jQuery("#scc_replacedContentFormat").closest("tr").hide();
		console.log("hidden");
	}

	jQuery("#scc_replaceOriginalPrice").change(function() {
		if( jQuery(this).val()==='0' ) {

			jQuery("#scc_tooltipTheme").closest("tr").show();
			jQuery("#scc_tooltipAnimation").closest("tr").show();
			jQuery("#scc_animationDuration").closest("tr").show();
			jQuery("#scc_tooltipPosition").closest("tr").show();
			jQuery("#scc_showTooltipArrow").closest("tr").show();
			jQuery("#scc_tooltipDelay").closest("tr").show();
			jQuery("#scc_tooltipAlwaysOpen").closest("tr").show();
			jQuery("#scc_replacedContentFormat").closest("tr").hide();
		} else {
			jQuery("#scc_tooltipTheme").closest("tr").hide();
			jQuery("#scc_tooltipAnimation").closest("tr").hide();
			jQuery("#scc_animationDuration").closest("tr").hide();
			jQuery("#scc_tooltipPosition").closest("tr").hide();
			jQuery("#scc_showTooltipArrow").closest("tr").hide();
			jQuery("#scc_tooltipDelay").closest("tr").hide();
			jQuery("#scc_tooltipAlwaysOpen").closest("tr").hide();
			jQuery("#scc_replacedContentFormat").closest("tr").show();
		}
	});
}


function exrateHandle(){

	if( jQuery('#scc_addexrate').length>0 ){

		jQuery('.scc_remv_exrate').click(function() {
				jQuery(this).closest('tr').remove();
		});

		var options = "";
		for (var key in currencyMap){
			options += "<option value='" + key + "' "  + " >" + key + " - " + currencyMap[key] + "</option>";
		}


		var popupHTML = "<div class='scc_configpop'><span class='scc_closeBtn'>X</span><p><select style='width:300px' id='scc_curr_from' >" + options + "</select> To <select id='scc_curr_to' style='width:300px' >" + options + "</select> </p><p> <input type='text' id='exrateval' style='width:250px' placeholder='Your Custom Exchange Rate'> <button id='scc_insert_exrate' >Add this rate</button></p><p id='scc_errmsg'></p>";

		jQuery('body').append(popupHTML);

		jQuery('#scc_addexrate').click(function (event){
			jQuery('.scc_configpop').bPopup({ followSpeed: 0, closeClass:"scc_closeBtn"});
		});

		jQuery('#scc_insert_exrate').click(function (){

			var from = jQuery('#scc_curr_from').val();
			var to = jQuery('#scc_curr_to').val();

			var exrateval = jQuery('#exrateval').val();

			if(isNaN(exrateval)){
				jQuery('#scc_errmsg').html('Please give some numeric value for exchange rate. For example 3 or 4.56 or 0.67');
				return;
			}

			jQuery('table.scc_exrates tbody').append('<tr><td>' + from + ' to ' + to + '</td><td>' + exrateval + '</td><td><button type="button"  class="cc_remv_exrate button button-primary">Remove this rate</button><input type="hidden" name="scc_exrate_options[' + from + to + ']" value="' + exrateval + '"></td></tr>');

			jQuery('.scc_remv_exrate').click(function() {
				jQuery(this).closest('tr').remove();
			});

			jQuery('.scc_configpop').bPopup().close();

			

		});



	}

	
}


jQuery(document).ready(function(){

	jQuery('input#scc_animationDuration').bind('change', function(){

		jQuery('b#animationDurationLabel').text(jQuery('input#scc_animationDuration').val());
	});

	jQuery('input#scc_tooltipDelay').bind('change', function(){

		jQuery('b#tooltipDelayLabel').text(jQuery('input#scc_tooltipDelay').val());
	});
	

	jQuery('.scc_chosen_select_static').chosen();


	bindChosenTargets (settings);


	bindFallbackCurrencyToggle();

	bindFallreplaceOriginalToggle();

	exrateHandle();



	
});
