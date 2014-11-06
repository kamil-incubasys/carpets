<?php

include_once "currencies.php";

/////////////////////////

function echoChecked($opgroup, $option){

	if(array_key_exists($option, get_option($opgroup))){
		echo " checked ";
	}
}


//////////////////////////

function render_scc_targets(){


	$curs = get_option('scc_currency_options');
	$curs = $curs['targets'];

	?>

	<input type='hidden' name='scc_currency_options[targets]' id="targetField" value="<?php echo $curs;?>"/>
	<select data-placeholder="Select target currencies"  style="width:300px;" class="scc_chosen_select" multiple >
		<option value=""></option>
		<optgroup label="Auto Detect">
			<option value="autodetect" <?php echo (substr_count($curs, "autodetect") != 0)?"selected":"";?>>Autodetect</option>
		</optgroup>
		<optgroup label="Currencies">

			<?php

			foreach ($GLOBALS['currencies'] as $key => $val) {

				if(substr_count($curs, $key) != 0) $sel = "selected";
				else $sel = "";
				echo "<option value='$key' $sel>$key - $val</option>";
			}

			?>

		</optgroup>
	</select><br>
	<small>You can select multiple target currencies. Visitor's automatically detected currency will be used in place of <code>Autodetect</code>.</small>

	<?php

}





function render_scc_showFallbackOnAutodetectFailure(){
	?>
	<input id="scc_showFallbackOnAutodetectFailure" name='scc_currency_options[showFallbackOnAutodetectFailure]' type='checkbox' value='1' <?php echoChecked('scc_currency_options','showFallbackOnAutodetectFailure');?>/>
	<label for='scc_showFallbackOnAutodetectFailure'> Show a fixed fallback currency in place of <code>Autodetect</code> if auto-detection fails.</label>
	<?php
}





function render_scc_autodetectFallbackCurrency(){

	echo "<select data-placeholder='Fallback Currency'  id='scc_autodetectFallbackCurrency' name='scc_currency_options[autodetectFallbackCurrency]' style='width:300px;' class='scc_chosen_select_static' >";

	$fallCurrency = get_option('scc_currency_options');
	$fallCurrency = $fallCurrency['autodetectFallbackCurrency'];

	foreach ($GLOBALS['currencies'] as $key => $val) {

		$sel = $key==$fallCurrency?"selected":"";

		echo "<option value='$key' $sel>$key - $val</option>";
	}

	echo "</select>";

}






function render_scc_decimalPrecision(){

	?>
	<input id="scc_decimalPrecision" name='scc_currency_options[decimalPrecision]' type='checkbox' value='1' <?php echoChecked('scc_currency_options','decimalPrecision');?>/>
	<label for='scc_decimalPrecision'> Show 2 digits after the decimal dot (in converted prices).</label>
	<?php
}






function render_scc_thousandSeperator(){

	?>

	<input id="scc_thousandSeperator" name='scc_currency_options[thousandSeperator]' type='checkbox' value='1' <?php echoChecked('scc_currency_options','thousandSeperator');?>/>
	<label for='scc_thousandSeperator'> Format converted prices with comma(,)s after every 3 digits.</label>

	<?php

}



/////////////////////////////////////////////////////////////////////////////////////////////////////////


function render_scc_replaceOriginalPrice(){

	$mode='0';

	if(array_key_exists('replaceOriginalPrice', get_option('scc_theme_options'))){
		$mode = get_option('scc_theme_options');
		$mode = $mode['replaceOriginalPrice'];
	}

	?>

	<select id="scc_replaceOriginalPrice" name='scc_theme_options[replaceOriginalPrice]'>
		<option value='0' <?php echo ($mode=='0')?"selected":"";?>>Tooltip</option>
		<option value='1' <?php echo ($mode=='1')?"selected":"";?>>Replace Original Price (No Tooltip)</option>
	</select>

	<p><small>If you are using the "No Tooltip" mode, please note that you have to use a single target currency (preferably "Autodetect").</small></p>

	<?php

}


function render_scc_replacedContentFormat(){

	$format = get_option('scc_theme_options');
	$format = $format['replacedContentFormat'];

	?>

	<h5 style="margin:0.5em 0;padding:0">You can customize how the converted amount looks.</h5>
	<textarea id="scc_replacedContentFormat" name='scc_theme_options[replacedContentFormat]' type='text' style='width:100%;font-family:monospace'><?php echo $format; ?></textarea><br>
	
	
	<p><small>The above text will replace all the prices</small></p>
	<p><small>You can use the following shortcodes here:</small>
	<small>
	<ul>
		<li><code>[originalPrice]</code> : The default price.</li>
		<li><code>[convertedCurrencyCode]</code> : Visitor's local currency code (or the target currency code you've specified in case you disable auto-detection).</li>
		<li><code>[convertedAmount]</code> : Converted amount.</li>
	</ul>
	</small>
	</p>
	<p>HTML and inline CSS are allowed. (See docs to learn more. You will also find some sample formats there.)</p>

	

	<?php

}


function render_scc_tooltipTheme(){

	$themes = array("shadow", "dark", "light", "noir", "punk");

	echo "<select id='scc_tooltipTheme' name='scc_theme_options[tooltipTheme]'>";

	$ttTheme = get_option('scc_theme_options');
	$ttTheme = $ttTheme['tooltipTheme'];

	foreach ($themes as $theme) {

		$sel = $theme==$ttTheme?"selected":"";

		echo "<option value='$theme' $sel>". ucfirst($theme) . "</option>";
	}

	echo "</select>";


}




function render_scc_tooltipAnimation(){

	$themes = array("fade", "grow", "swing", "slide", "fall");

	echo "<select id='scc_tooltipAnimation' name='scc_theme_options[tooltipAnimation]'>";

	$ttAnim = get_option('scc_theme_options');
	$ttAnim = $ttAnim['tooltipAnimation'];

	foreach ($themes as $theme) {

		$sel = $theme==$ttAnim?"selected":"";

		echo "<option value='$theme' $sel>". ucfirst($theme) . "</option>";
	}

	echo "</select>";


}





function render_scc_animationDuration(){



	$animDuration = get_option('scc_theme_options');
	$animDuration = $animDuration['animationDuration'];

	?>

	<input id='scc_animationDuration' name='scc_theme_options[animationDuration]' type='range' min='50' max='2000' step='50' value='<?php echo $animDuration;?>'/> <b id="animationDurationLabel"><?php echo $animDuration;?></b> milliseconds.<br>
	<label for='scc_theme_options[animationDuration]'>Bigger for slower animation.</label>

	<?php
}




function render_scc_tooltipPosition(){


	$positions = array("top", "bottom", "left", "right", "top-left", "top-right", "bottom-left", "bottom-right");


	echo "<select id='scc_tooltipPosition' name='scc_theme_options[tooltipPosition]'>";

	$ttPosition = get_option('scc_theme_options');
	$ttPosition = $ttPosition['tooltipPosition'];

	foreach ($positions as $position) {

		$sel = $position==$ttPosition?"selected":"";

		echo "<option value='$position' $sel>". ucfirst($position) . "</option>";
	}

	echo "</select>";


}


	
function render_scc_showTooltipArrow(){

	?>

	<input id="scc_showTooltipArrow" name='scc_theme_options[showTooltipArrow]' type='checkbox' value='1' <?php echoChecked('scc_theme_options', 'showTooltipArrow');?>/>
	<label for='scc_showTooltipArrow'> Show "speech bubble arrow" with tooltips.</label>

	<?php

}



function render_scc_tooltipShowDelay(){

	$ttDelay = get_option('scc_theme_options');
	$ttDelay = $ttDelay['tooltipShowDelay'];
	?>
	<input name='scc_theme_options[tooltipShowDelay]' id='scc_tooltipDelay' type='range' min='0' max='1000' step='50' value='<?php echo $ttDelay;?>'/> <br>
	<label for='scc_theme_options[tooltipShowDelay]'>Tooltip will be shown <b id="tooltipDelayLabel"><?php echo $ttDelay;?></b> milliseconds after the hover/touch.</label>

	<?php
}

	
function render_scc_tooltipAlwaysOpen(){

	?>

	<input id="scc_tooltipAlwaysOpen" name='scc_theme_options[tooltipAlwaysOpen]' type='checkbox' value='1' <?php echoChecked('scc_theme_options', 'tooltipAlwaysOpen');?>/>
	<label for='scc_tooltipAlwaysOpen'> Automatically open all tooltips when page loads.</label>

	<?php

}









////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function render_scc_exchangeRateUpdateInterval(){

	?>
	<select name='scc_misc_options[exchangeRateUpdateInterval]'>

	<?php 

		$upInterval = get_option('scc_misc_options');
		$upInterval = $upInterval['exchangeRateUpdateInterval'];

	?>

		<option value="1" <?php echo ($upInterval=='1')?'selected':''; ?>  >Every Minute</option>
		<option value="10" <?php echo ($upInterval=='10')?'selected':''; ?>  >Every 10 Minutes</option>
		<option value="30" <?php echo ($upInterval=='30')?'selected':''; ?>  >Every 30 Minutes</option>
		<option value="60" <?php echo ($upInterval=='60')?'selected':''; ?>  >Every Hour</option>
		<option value="360" <?php echo ($upInterval=='360')?'selected':''; ?>  >Every 6 Hours</option>
		<option value="1440" <?php echo ($upInterval=='1440')?'selected':''; ?>  >Every Day</option>
	</select><br>

	<small>On average, tooltips can be loaded a bit faster if updates are less frequent. Use more frequent updates if exchange rates of your target currencies tend to change frequently.</small>

	<?php

}


function render_scc_hideTooltipToNativeVisitor(){

	?>
	<input id="scc_hideTooltipToNativeVisitor" name='scc_misc_options[hideTooltipToNativeVisitor]' type='checkbox' value='1' <?php echoChecked('scc_misc_options','hideTooltipToNativeVisitor');?>/>
	<label for='scc_hideTooltipToNativeVisitor'> Hide the tooltip to visitors whose currency is same as the default currency of the website (<?php echo get_option('woocommerce_currency');?>).</label>

	<?php

}

function render_scc_touchFriendly(){

	?>
	<input id="scc_touchFriendly" name='scc_misc_options[touchFriendly]' type='checkbox' value='1' <?php echoChecked('scc_misc_options', 'touchFriendly');?>/>
	<label for='scc_touchFriendly'> Trigger tooltips by touch in touch-enabled devices.</label>

	<?php

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function render_scc_show_init_pop(){

	?>

	<input id="scc_show_init_pop" name='scc_popup_options[show_init_pop]' type='checkbox' value='1' <?php echoChecked('scc_popup_options','show_init_pop');?>/>
	<label for='scc_show_init_pop'>Show visitors a message that they can see converted prices by hovering over the prices.</label>

	<?php

}

function render_scc_show_config_pop(){

	?>

	<input id="scc_show_config_pop" name='scc_popup_options[show_config_pop]' type='checkbox' value='1' <?php echoChecked('scc_popup_options','show_config_pop');?>/>
	<label for='scc_show_config_pop'>Let the visitors choose their preferred currency. <p><small>(if this is enabled, the visitors will see a small settings icon in the tooltip or beside the price. They can click on that to set their preferred currency)</small></p></label>

	<?php

}

function render_scc_init_message(){

	$custClasses = get_option('scc_popup_options');
	$custClasses = $custClasses['init_message'];

	?>

	<textarea style='width:100%' id="scc_init_message" name='scc_popup_options[init_message]' type='text'><?php echo $custClasses; ?></textarea><br>
<!-- 	<p>This message will be shown to a visitor when he visits this webpage</p>
	 -->

	<?php

}

function render_scc_init_message2(){

	$custClasses = get_option('scc_popup_options');
	$custClasses = $custClasses['init_message2'];

	?>


	<textarea style='width:100%' id="scc_init_message2" name='scc_popup_options[init_message2]' type='text'><?php echo $custClasses; ?></textarea><br>
	<!-- <p>This message will be shown to a visitor when he visits this webpage</p> -->
	

	<?php

}

/////////////////////////////////////////////////////////////////////////////////////////////////


function render_scc_debugMode(){

	?>

	<input id="scc_debugMode" name='scc_adv_options[debugMode]' type='checkbox' value='1' <?php echoChecked('scc_adv_options','debugMode');?>/>
	<label for='scc_debugMode'> Show debug messages in browser console.</label>

	<?php

}


function render_scc_customClasses(){

	$custClasses = get_option('scc_adv_options');
	$custClasses = $custClasses['customClasses'];

	?>


	<textarea id="scc_customClasses" name='scc_adv_options[customClasses]' type='text'><?php echo $custClasses; ?></textarea><br>
	<p><small>By default, it is assumed that all pricetags will have a CSS class <code>amount</code>. But in some rare themes, pricetags can have different classes. If the tooltip is not showing on any particular price, enter the CSS selector of that pricetag here. You can enter multiple CSS selectors (comma-seperated).</small></p>
	<p><small>See documentation for details.</small></p>
	

	<?php

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////


function scc_exrate_callback(){

	$exrates = get_option('scc_exrate_options');

	?>


		<table cellpadding='0' cellspacing='0' class='scc_exrates'>
			<tbody>

			<?php


			if(is_array($exrates)){

				foreach ($exrates as $key => $val) {
				echo '<tr><td>'.substr($key, 0, 3).' to '.substr($key, 3, 3).'</td><td>'.$val.'</td><td><button type="button"  class="scc_remv_exrate button button-primary">Remove this rate</button><input type="hidden" name="scc_exrate_options[' . substr($key, 0, 3) . substr($key, 3, 3) . ']" value="' . $val . '"></td></tr>';
			}
			}

			

			?>


				
			</tbody>
		</table>

		<button type="button" id="scc_addexrate" class="button button-primary">Add new rate</button>

		<p style='margin-top:20px'>Exchange rates that are not specified here will be fetched from <a href="http://finance.yahoo.com/currency-converter"  target="_blank">Yahoo Finance</a>.</p>

	<?php


}

?>