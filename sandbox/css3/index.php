<?php
$projectid = (isset($_REQUEST["projectid"]))?$_REQUEST["projectid"]:"21000";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>CSS 3 Font-Feature-Settings OpenType demo</title>
<link rel="stylesheet" href="screen.css" type="text/css">

<script>var domain = "<?php echo $_SERVER["HTTP_HOST"] ?>";</script>
<script id="fontdeckjs" src="http://f.fontdeck.com/s/css/js/<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $projectid ?>.js"></script>


<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="controls.js"></script>

</head>

<body>

<div id="sampleText" class="experiment" contenteditable="">
Lucky affluent actor asks to feast on giant 10.34" cheese-filled quiche in fjord.
</div>



<div id="controls">

<h2>Fontdeck</h2>
<h3 id="projectgroup">Project ID</h3>
<div class="group">
<form action="<?php echo $_SERVER["PHP_SELF"] ?>">
<label><input type="text" id="projectid" name="projectid" value="<?php echo $projectid ?>" size="6" /><input type="submit" value="Change" /></label>
</form>
</div>

<form id="inputForm">

<h2>Fonts</h2>

<h3 id="typefacegroup">Typeface</h3>
<div class="group">
<label>
<select id="typeface" name="typeface" onchange="refreshFont()">
<option value="">-local font-</option>
</select>
</label>
<label><input type="text" id="font" name="font" /></label>
<label><input type="text" id="otherfont" name="otherfont" onkeyup="refreshOther()" placeholder="Font-family name" /></label>
<label style="display:none"><input id="italic" onchange="refreshSample()" type="checkbox">Italic</label>
</div>

<h2>Features</h2>

<h3>Kerning</h3>
<div class="group">
<label><input id="kern" type="checkbox" />Enabled (kern)</label>
</div>

<h3>Ligatures</h3>
<div class="group">
<label><input id="liga" type="checkbox" />Common (liga)</label>
<label><input id="dlig" type="checkbox">Discretionary (dlig)</label>
<label><input id="hlig" type="checkbox">Historical (hlig)</label>
<label><input id="clig" type="checkbox">Contextual (clig)</label>
</div>

<h3>Letter Case</h3>
<div class="group">
<label><input id="smcp" name="smcp" type="checkbox">Small Caps (smcp)</label>
<label><input id="c2sc" name="smcp" type="checkbox">Small Caps from Caps (c2sc)</label>
</div>

<h3>Number Case</h3>
<div class="group">
<label><input name="numsty" checked="checked" type="radio">Default</label>
<label><input id="lnum" name="numsty" type="radio">Lining (lnum)</label>
<label><input id="onum" name="numsty" type="radio">Old-Style (onum)</label>
</div>

<h3>Number Spacing</h3>
<div class="group">
<label><input name="numspc" checked="checked" type="radio">Default</label>
<label><input id="pnum" name="numspc" type="radio">Proportional (pnum)</label>
<label><input id="tnum" name="numspc" type="radio">Tabular (tnum)</label>
</div>

<h3>Fractions</h3>
<div class="group">
<label><input name="frac" checked="checked" type="radio">Off</label>
<label><input id="frac" name="frac" type="radio">Normal (frac)</label>
<label><input id="afrc" name="frac" type="radio">Alternate (afrc)</label>
</div>

<h3>Positioning</h3>
<div class="group">
<label><input id="sups" type="checkbox">Superscript/Superiors</label>
<label><input id="subs" type="checkbox">Subscript/Inferiors</label>
</div>

<h3>Numeric Extras</h3>
<div class="group">
<label><input id="zero" type="checkbox">Slashed Zero (zero)</label>
<label><input id="nalt" type="checkbox">Alt. Annotation (nalt)</label>
</div>

<h3>Character Alternatives</h3>
<div class="group">
<label><input id="swsh" type="checkbox">Swash (swsh)</label>
<label><input id="calt" type="checkbox">Contextual (calt)</label>
<label><input id="hist" type="checkbox">Historical (hist)</label>
<label><input id="salt" type="checkbox">Stylistic (salt)</label>
</div>

<h3>Alternative Stylistic Sets</h3>
<div class="group">
<label><input id="ss01" type="checkbox">Set 1 (ss01)</label>
<label><input id="ss02" type="checkbox">Set 2 (ss02)</label>
<label><input id="ss03" type="checkbox">Set 3 (ss03)</label>
<label><input id="ss04" type="checkbox">Set 4 (ss04)</label>
<label><input id="ss05" type="checkbox">Set 5 (ss05)</label>
<label><input id="ss06" type="checkbox">Set 6 (ss06)</label>
<label><input id="ss07" type="checkbox">Set 7 (ss07)</label>
<label><input id="ss08" type="checkbox">Set 8 (ss08)</label>
<label><input id="ss09" type="checkbox">Set 9 (ss09)</label>
</div>

<h3>Reset</h3></h3>
<div class="group">
<label id="reset"><input type="reset" value="Defaults" /></label>
</div>


</form>
</div> <!-- /#controls -->



<div id="output">
<p><a href="http://fontdeck.com/typefaces/all/tags/opentype">OpenType-enabled webfonts from Fontdeck</a></p>
<p class="caveat">No fonts have all OpenType features, so just play around. Try the ligatures first.<strong>
Only supported in Firefox&nbsp;4+, IE&nbsp;10+, Chrome&nbsp;33+, Opera&nbsp;15+.</strong></p>
<div>
-moz-font-feature-settings:<span id="mozfeatures13" contenteditable="" onkeyup="refreshSample()"></span>;
<br />
-ms-font-feature-settings:<span id="msfeatures" contenteditable="" onkeyup="refreshSample()"></span>;
<br />
-o-font-feature-settings:<span id="ofeatures" contenteditable="" onkeyup="refreshSample()"></span>;
<br />
-webkit-font-feature-settings:<span id="webkitfeatures" contenteditable="" onkeyup="refreshSample()"></span>;
<br />
font-feature-settings:<span id="w3cfeatures"></span>;
</div>
</div>



</body></html>
