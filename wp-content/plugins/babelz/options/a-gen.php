<?php
// Retrieve Options
$BabelZ_Widg = get_option('BabelZ_Widg');
$BabelZ_G_Lang1 = get_option('BabelZ_G_Lang1');
$BabelZ_G_Lang2 = get_option('BabelZ_G_Lang2');
$BabelZ_G_Mode = get_option('BabelZ_G_Mode');

// General Settings
if (get_option('BabelZ_Hide1') == 'show') {
    _e('<input type="hidden" target="BabelZ-Hide1" name="BabelZ-Hide1" class="BabelZ-SH" value="show">');
} else {
    _e('<input type="hidden" target="BabelZ-Hide1" name="BabelZ-Hide1" class="BabelZ-SH" value="hide">');
}
// Stored Values
_e('<input type="hidden" id="BabelZ-Stored-Value1" value="'.$BabelZ_Widg.'">');
_e('<input type="hidden" id="BabelZ-Stored-Value2" value="'.$BabelZ_G_Mode.'">');
?>
  <div id="poststuff">
    <div class="postbox">
      <h3 class="hndle BabelZ-H" target="BabelZ-Hide1"><span><?php _e('Widget Settings','BabelZ'); ?></span></h3>
      <div class="inside" id="BabelZ-Hide1">
<table width="100%" class="BabelZ-Pad">
<tr>
<th scope="row">
Choose Widget
</th>
<td>
<select name="BabelZ-Widg" id="BabelZ-Toggle">
	<option value="GTranslate" <?php _e($BabelZ_Widg=="GTranslate" ? "selected" : ""); ?> id="GTranslate">Google Translate</option>
	<?php /* <option value="MTranslate" <?php _e($BabelZ_Widg=="MTranslate" ? "selected" : ""); ?> id="MTranslate">Microsoft/Bing Translate</option> */ ?>
</select>
</td>
</tr>

<tr class="GTranslate">
<th scope="row">
Display Mode
</th>
<td>
<select name="BabelZ-G-Mode" id="BabelZ-Toggle2">
	<option value="google.translate.TranslateElement.InlineLayout.VERTICAL" <?php _e(substr($BabelZ_G_Mode,-3)=="CAL" ? "selected" : ""); ?> id="GMode1">Inline  - Vertical</option>
	<option value="google.translate.TranslateElement.InlineLayout.HORIZONTAL" <?php _e(substr($BabelZ_G_Mode,-3)=="TAL" ? "selected" : ""); ?> id="GMode2">Inline - Horizontal</option>
	<option value="google.translate.TranslateElement.InlineLayout.SIMPLE" <?php _e(substr($BabelZ_G_Mode,-3)=="PLE" ? "selected" : ""); ?> id="GMode3">Inline - Dropdown Only</option>
	<?php
	// Tabs are not Working properly
	/*
	<option value="google.translate.TranslateElement.FloatPosition.BOTTOM_RIGHT" <?php _e(substr($BabelZ_G_Mode,-7)=="M_RIGHT" ? "selected" : ""); ?> id="GMode4">Tabbed - Lower Right</option>
	<option value="google.translate.TranslateElement.FloatPosition.BOTTOM_LEFT" <?php _e(substr($BabelZ_G_Mode,-6)=="M_LEFT" ? "selected" : ""); ?> id="GMode5">Tabbed - Lower Left</option>
	<option value="google.translate.TranslateElement.FloatPosition.TOP_RIGHT" <?php _e(substr($BabelZ_G_Mode,-7)=="P_RIGHT" ? "selected" : ""); ?> id="GMode6">Tabbed - Upper Right</option>
	<option value="google.translate.TranslateElement.FloatPosition.TOP_LEFT" <?php _e(substr($BabelZ_G_Mode,-6)=="P_LEFT" ? "selected" : ""); ?> id="GMode7">Tabbed - Upper Left</option>
	*/
	?>
</select>
</td>
<td>
    <img src="<?php _e(BabelZ_Url()); ?>images/mode01.png" class="GMode1">
    <img src="<?php _e(BabelZ_Url()); ?>images/mode02.png" class="GMode2">
    <img src="<?php _e(BabelZ_Url()); ?>images/mode03.png" class="GMode3">
    <?php
    // Tabs are not Working properly
    /*
    <img src="<?php _e(BabelZ_Url()); ?>images/mode04.png" class="GMode4">
    <img src="<?php _e(BabelZ_Url()); ?>images/mode05.png" class="GMode5">
    <img src="<?php _e(BabelZ_Url()); ?>images/mode06.png" class="GMode6">
    <img src="<?php _e(BabelZ_Url()); ?>images/mode07.png" class="GMode7">
    */
    ?>
</td>
</tr>

<tr class="GTranslate"><td colspan="3"><hr></td></tr>

<tr class="GTranslate">
<th scope="row">
Translate From
</th>
<td>
<select name="BabelZ-G-Lang1">
    <option value="af" <?php _e($BabelZ_G_Lang1=="af" ? "selected" : ""); ?>>Afrikaans</option>
    <option value="sq" <?php _e($BabelZ_G_Lang1=="sq" ? "selected" : ""); ?>>Albanian</option>
    <option value="ar" <?php _e($BabelZ_G_Lang1=="ar" ? "selected" : ""); ?>>Arabic</option>
    <option value="hy" <?php _e($BabelZ_G_Lang1=="hy" ? "selected" : ""); ?>>Armenian</option>
    <option value="az" <?php _e($BabelZ_G_Lang1=="az" ? "selected" : ""); ?>>Azerbaijani</option>
    <option value="eu" <?php _e($BabelZ_G_Lang1=="eu" ? "selected" : ""); ?>>Basque</option>
    <option value="be" <?php _e($BabelZ_G_Lang1=="be" ? "selected" : ""); ?>>Belarusian</option>
    <option value="bn" <?php _e($BabelZ_G_Lang1=="bn" ? "selected" : ""); ?>>Bengali</option>
    <option value="bg" <?php _e($BabelZ_G_Lang1=="bg" ? "selected" : ""); ?>>Bulgarian</option>
    <option value="ca" <?php _e($BabelZ_G_Lang1=="ca" ? "selected" : ""); ?>>Catalan</option>
    <option value="zh-CN" <?php _e($BabelZ_G_Lang1=="zh-CN" ? "selected" : ""); ?>>Chinese</option>
    <option value="zh-TW" <?php _e($BabelZ_G_Lang1=="zh-TW" ? "selected" : ""); ?>>Chinese (Traditional)</option>
    <option value="hr" <?php _e($BabelZ_G_Lang1=="hr" ? "selected" : ""); ?>>Croatian</option>
    <option value="cs" <?php _e($BabelZ_G_Lang1=="cs" ? "selected" : ""); ?>>Czech</option>
    <option value="da" <?php _e($BabelZ_G_Lang1=="da" ? "selected" : ""); ?>>Danish</option>
    <option value="nl" <?php _e($BabelZ_G_Lang1=="nl" ? "selected" : ""); ?>>Dutch</option>
    <option value="en" <?php _e($BabelZ_G_Lang1=="en" ? "selected" : ""); ?>>English</option>
    <option value="eo" <?php _e($BabelZ_G_Lang1=="eo" ? "selected" : ""); ?>>Esperanto</option>
    <option value="et" <?php _e($BabelZ_G_Lang1=="et" ? "selected" : ""); ?>>Estonian</option>
    <option value="tl" <?php _e($BabelZ_G_Lang1=="tl" ? "selected" : ""); ?>>Filipino</option>
    <option value="fi" <?php _e($BabelZ_G_Lang1=="fi" ? "selected" : ""); ?>>Finnish</option>
    <option value="fr" <?php _e($BabelZ_G_Lang1=="fr" ? "selected" : ""); ?>>French</option>
    <option value="gl" <?php _e($BabelZ_G_Lang1=="gl" ? "selected" : ""); ?>>Galician</option>
    <option value="ka" <?php _e($BabelZ_G_Lang1=="ka" ? "selected" : ""); ?>>Georgian</option>
    <option value="de" <?php _e($BabelZ_G_Lang1=="de" ? "selected" : ""); ?>>German</option>
    <option value="el" <?php _e($BabelZ_G_Lang1=="el" ? "selected" : ""); ?>>Greek</option>
    <option value="gu" <?php _e($BabelZ_G_Lang1=="gu" ? "selected" : ""); ?>>Gujarati</option>
    <option value="ht" <?php _e($BabelZ_G_Lang1=="ht" ? "selected" : ""); ?>>Haitian</option>
    <option value="iw" <?php _e($BabelZ_G_Lang1=="iw" ? "selected" : ""); ?>>Hebrew</option>
    <option value="hi" <?php _e($BabelZ_G_Lang1=="hi" ? "selected" : ""); ?>>Hindi</option>
    <option value="iu" <?php _e($BabelZ_G_Lang1=="hu" ? "selected" : ""); ?>>Hungarian</option>
    <option value="is" <?php _e($BabelZ_G_Lang1=="is" ? "selected" : ""); ?>>Icelandic</option>
    <option value="id" <?php _e($BabelZ_G_Lang1=="id" ? "selected" : ""); ?>>Indonesian</option>
    <option value="ga" <?php _e($BabelZ_G_Lang1=="ga" ? "selected" : ""); ?>>Irish</option>
    <option value="it" <?php _e($BabelZ_G_Lang1=="it" ? "selected" : ""); ?>>Italian</option>
    <option value="ja" <?php _e($BabelZ_G_Lang1=="ja" ? "selected" : ""); ?>>Japanese</option>
    <option value="kn" <?php _e($BabelZ_G_Lang1=="kn" ? "selected" : ""); ?>>Kannada</option>
    <option value="ko" <?php _e($BabelZ_G_Lang1=="ko" ? "selected" : ""); ?>>Korean</option>
    <option value="lo" <?php _e($BabelZ_G_Lang1=="lo" ? "selected" : ""); ?>>Lao</option>
    <option value="la" <?php _e($BabelZ_G_Lang1=="la" ? "selected" : ""); ?>>Latin</option>
    <option value="lv" <?php _e($BabelZ_G_Lang1=="lv" ? "selected" : ""); ?>>Latvian</option>
    <option value="lt" <?php _e($BabelZ_G_Lang1=="lt" ? "selected" : ""); ?>>Lithuanian</option>
    <option value="mk" <?php _e($BabelZ_G_Lang1=="mk" ? "selected" : ""); ?>>Macedonian</option>
    <option value="ms" <?php _e($BabelZ_G_Lang1=="ms" ? "selected" : ""); ?>>Malay</option>
    <option value="mt" <?php _e($BabelZ_G_Lang1=="mt" ? "selected" : ""); ?>>Maltese</option>
    <option value="no" <?php _e($BabelZ_G_Lang1=="no" ? "selected" : ""); ?>>Norwegian</option>
    <option value="fa" <?php _e($BabelZ_G_Lang1=="fa" ? "selected" : ""); ?>>Persian</option>
    <option value="pl" <?php _e($BabelZ_G_Lang1=="pl" ? "selected" : ""); ?>>Polish</option>
    <option value="pt" <?php _e($BabelZ_G_Lang1=="pt" ? "selected" : ""); ?>>Portuguese</option>
    <option value="ro" <?php _e($BabelZ_G_Lang1=="ro" ? "selected" : ""); ?>>Romanian</option>
    <option value="ru" <?php _e($BabelZ_G_Lang1=="ru" ? "selected" : ""); ?>>Russian</option>
    <option value="sr" <?php _e($BabelZ_G_Lang1=="sr" ? "selected" : ""); ?>>Serbian</option>
    <option value="sk" <?php _e($BabelZ_G_Lang1=="sk" ? "selected" : ""); ?>>Slovak</option>
    <option value="sl" <?php _e($BabelZ_G_Lang1=="sl" ? "selected" : ""); ?>>Slovenian</option>
    <option value="es" <?php _e($BabelZ_G_Lang1=="es" ? "selected" : ""); ?>>Spanish</option>
    <option value="sw" <?php _e($BabelZ_G_Lang1=="sw" ? "selected" : ""); ?>>Swahili</option>
    <option value="sv" <?php _e($BabelZ_G_Lang1=="sv" ? "selected" : ""); ?>>Swedish</option>
    <option value="ta" <?php _e($BabelZ_G_Lang1=="ta" ? "selected" : ""); ?>>Tamil</option>
    <option value="te" <?php _e($BabelZ_G_Lang1=="te" ? "selected" : ""); ?>>Telugu</option>
    <option value="th" <?php _e($BabelZ_G_Lang1=="th" ? "selected" : ""); ?>>Thai</option>
    <option value="tr" <?php _e($BabelZ_G_Lang1=="tr" ? "selected" : ""); ?>>Turkish</option>
    <option value="uk" <?php _e($BabelZ_G_Lang1=="uk" ? "selected" : ""); ?>>Ukrainian</option>
    <option value="ur" <?php _e($BabelZ_G_Lang1=="ur" ? "selected" : ""); ?>>Urdu</option>
    <option value="vi" <?php _e($BabelZ_G_Lang1=="vi" ? "selected" : ""); ?>>Vietnamese</option>
    <option value="cy" <?php _e($BabelZ_G_Lang1=="cy" ? "selected" : ""); ?>>Welsh</option>
    <option value="yi" <?php _e($BabelZ_G_Lang1=="yi" ? "selected" : ""); ?>>Yiddish</option>
</select>
</td>
</tr>
<tr class="GTranslate">
<th scope="row">
Translation Languages
</th>
<td colspan="2">

<?php
$langs[] = array("af", ' Afrikaans');
$langs[] = array("sq", ' Albanian');
$langs[] = array("ar", ' Arabic');
$langs[] = array("hy", ' Armenian');
$langs[] = array("az", ' Azerbaijani');
$langs[] = array("eu", ' Basque');
$langs[] = array("be", ' Belarusian');
$langs[] = array("bn", ' Bengali');
$langs[] = array("bg", ' Bulgarian');
$langs[] = array("ca", ' Catalan');
$langs[] = array("zh-CN", ' Chinese');
$langs[] = array("zh-TW", ' Chinese (Traditional)');
$langs[] = array("hr", ' Croatian');
$langs[] = array("cs", ' Czech');
$langs[] = array("da", ' Danish');
$langs[] = array("nl", ' Dutch');
$langs[] = array("en", ' English');
$langs[] = array("eo", ' Esperanto');
$langs[] = array("et", ' Estonian');
$langs[] = array("tl", ' Filipino');
$langs[] = array("fi", ' Finnish');
$langs[] = array("fr", ' French');
$langs[] = array("gl", ' Galician');
$langs[] = array("ka", ' Georgian');
$langs[] = array("de", ' German');
$langs[] = array("el", ' Greek');
$langs[] = array("gu", ' Gujarati');
$langs[] = array("ht", ' Haitian');
$langs[] = array("iw", ' Hebrew');
$langs[] = array("hi", ' Hindi');
$langs[] = array("hu", ' Hungarian');
$langs[] = array("is", ' Icelandic');
$langs[] = array("id", ' Indonesian');
$langs[] = array("ga", ' Irish');
$langs[] = array("it", ' Italian');
$langs[] = array("ja", ' Japanese');
$langs[] = array("kn", ' Kannada');
$langs[] = array("ko", ' Korean');
$langs[] = array("lo", ' Lao');
$langs[] = array("la", ' Latin');
$langs[] = array("lv", ' Latvian');
$langs[] = array("lt", ' Lithuanian');
$langs[] = array("mk", ' Macedonian');
$langs[] = array("ms", ' Malay');
$langs[] = array("mt", ' Maltese');
$langs[] = array("no", ' Norwegian');
$langs[] = array("fa", ' Persian');
$langs[] = array("pl", ' Polish');
$langs[] = array("pt", ' Portuguese');
$langs[] = array("ro", ' Romanian');
$langs[] = array("ru", ' Russian');
$langs[] = array("sr", ' Serbian');
$langs[] = array("sk", ' Slovak');
$langs[] = array("sl", ' Slovenian');
$langs[] = array("es", ' Spanish');
$langs[] = array("sw", ' Swahili');
$langs[] = array("sv", ' Swedish');
$langs[] = array("ta", ' Tamil');
$langs[] = array("te", ' Telugu');
$langs[] = array("th", ' Thai');
$langs[] = array("tr", ' Turkish');
$langs[] = array("uk", ' Ukrainian');
$langs[] = array("ur", ' Urdu');
$langs[] = array("vi", ' Vietnamese');
$langs[] = array("cy", ' Welsh');
$langs[] = array("yi", ' Yiddish');

if (is_array($langs)) {
    $explo = explode(",", strval($BabelZ_G_Lang2));
    $countLangs = count($langs);
    for ($for1 = 0; $for1 < $countLangs; $for1++) {
	$chk = "";
	for ($for2 = 0; $for2 < count($explo); $for2++) {
	    if (strval($langs[$for1][0]) == trim(strval($explo[$for2]))) {
		$chk = " checked";
		break;
	    }
	}
	if ($for1 == 0) _e('<div class="BabelZ-Countries">');
	else if ($for1 %14 == 0) _e('</div><div class="BabelZ-Countries">');
	_e('<input type="checkbox" name="BabelZ-G-Lang2[]" class="BabelZLanguageChecks" id="cc_'.htmlentities($langs[$for1][0]).'" value="'.htmlentities($langs[$for1][0]).'"'.$chk.'><label data-labelfor="cc_'.htmlentities($langs[$for1][0]).'">'.$langs[$for1][1].'</label><br>');
    }
    _e('</div>');
}
?>
<div class="BabelZ-Clear"></div>

<br><input type="button" id="checkToggle" value="Check all">
</td>
</tr>

<tr class="GTranslate"><td colspan="3"><hr></td></tr>

<tr class="GTranslate">
<th scope="row">
Advanced Setttings
</th>
<td colspan="2">
    <input type="checkbox" name="BabelZ-G-Auto" id="BabelZ-G-Auto" <?php _e(get_option('BabelZ_G_Auto')); ?>> <label data-labelfor="BabelZ-G-Auto">Automatically display translation banner to users speaking languages other than the language of your page.</label>
    <br><br>
    <input type="checkbox" name="BabelZ-G-Mult" id="BabelZ-G-Mult" <?php _e(get_option('BabelZ_G_Mult')); ?>> <label data-labelfor="BabelZ-G-Mult">Your page contains content in multiple languages.</label>
</td>
</tr>
</table>
      </div>
    </div>
  </div>
<?php
//Promote BabelZ
if (get_option('BabelZ_Hide2') == 'show') {
    _e('<input type="hidden" target="BabelZ-Hide2" name="BabelZ-Hide2" class="BabelZ-SH" value="show">');
} else {
    _e('<input type="hidden" target="BabelZ-Hide2" name="BabelZ-Hide2" class="BabelZ-SH" value="hide">');
}
?>
  <div id="poststuff">
    <div class="postbox">
      <h3 class="hndle BabelZ-H" target="BabelZ-Hide2"><span><?php _e('Other Settings','BabelZ'); ?></span></h3>
      <div class="inside" id="BabelZ-Hide2">
<table width="100%" class="BabelZ-Pad">
<tr>
<th scope="row">
Help promote BabelZ?
</th>
<td>
<input type="checkbox" name="BabelZ-Prom" <?php _e(get_option('BabelZ_Prom')); ?>> Place a support link under the widget. Thanks for your support!
</td></tr>
</table>
      </div>
    </div>
  </div>
<?php
//ChangeLog
if (get_option('BabelZ_Hide3') == 'show') {
    _e('<input type="hidden" target="BabelZ-Hide3" name="BabelZ-Hide3" class="BabelZ-SH" value="show">');
} else {
    _e('<input type="hidden" target="BabelZ-Hide3" name="BabelZ-Hide3" class="BabelZ-SH" value="hide">');
}
?>
  <div id="poststuff">
    <div class="postbox">
      <h3 class="hndle BabelZ-H" target="BabelZ-Hide3"><span><?php _e('ChangeLog','BabelZ'); ?></span></h3>
      <div class="inside" id="BabelZ-Hide3">
<table width="100%" class="BabelZ-Pad">
<tr><td>
<ul id="BabelZ-CLog">
  <li>1.1.3 - 3/28/13
	<ul>
	  <li>Added additional inline display modes; inline, tabbed, and automatic (Google translate)</li>
	  <li>Updated language list (Google translate)</li>
	  <li>Added option "Your page contains content in multiple languages." (Google translate)</li>
	  <li>Added option "Automatically display translation banner to users speaking languages other than the language of your page." (Google Translate)</li>
	</ul>
  </li>
  <li>1.1.2 - 1/23/13
	<ul>
	  <li>Updated compatibility to 3.5</li>
	  <li>Removed Yahoo Babelfish widgets</li>
	</ul>
  </li>
  <li>1.1.1 - 2/28/10
	<ul>
	  <li>Widget Setting Bug Fixes</li>
	</ul>
  </li>
  <li>1.1.0 - 2/25/10
	<ul>
	  <li>Added Google Translate Widget with options</li>
	  <li>Added BabelFish Text/URL combo box</li>
	</ul>
  </li>
  <li>1.0.2 - 6/13/09
	<ul>
	  <li>Updated the CSS for boxes to fix visual glitch in 2.8</li>
	</ul>
  </li>
  <li>1.0.1 - 2/26/09
	<ul>
	  <li>Link Fix</li>
	</ul>
  </li>
  <li>1.0.0 - 2/24/09
	<ul>
	  <li>Initial Release</li>
	</ul>
  </li>
</ul>
</td></tr>
</table>
      </div>
    </div>
  </div>
