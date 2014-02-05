<?php
$filename = "domtable";

$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);

include($dr . "/includes/sandbox_getdetails.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$title?> | clagnut/sandbox</title>
<style type="text/css">
@import url(/css/sandbox.css);
TD {
	text-align:center;
	}
</style>
<script type="text/javascript">
function toggle(control) {
	dir = control.name;
	axis = control.value;
	formInputs = document.getElementsByTagName('input');
	for (var i = 0; i < formInputs.length; i++) {
		var type = formInputs[i].getAttribute('type'); 
		if (type == 'checkbox') {
			if (dir == 'col' && formInputs[i].getAttribute('name') == axis) {
				formInputs[i].checked = true;
			}
			if (dir == 'row' && formInputs[i].getAttribute('value') == axis) {
				formInputs[i].checked = true;
			}
		}
	}
}

function setClassStyle(tagName, className, styleName, styleValue) {
	elemColl = document.getElementsByTagName(tagName);
	for (var i = 0; i < elemColl.length; i++) {
		var elemClass = elemColl[i].getAttribute('class'); 
		if (elemClass == className) {
			elemColl[i].style[styleName] = styleValue;
		}
	}
}
</script>
</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div>
<h2>Redefine a class's styles</h2>
<p>All elements and attributes on the page are held in nested arrays called HTMLCollections. This means that any individual element can be manipulated without it being assigned an <code>id</code>.</p>
<p>In this simple example we have a list of fruit and vegetables. Each item of fruit has been given a class of <code>fruit</code> and each vegetable a class of <code>veg</code>. We can use DOM scripting to effectively redefine the styles of each class.</p>
<form action="#" id="matrix">
<input type="button" value="change fruit class" onclick="setClassStyle('LI', 'fruit', 'background', 'yellow')" />
<input type="button" value="change veg class" onclick="setClassStyle('LI', 'veg', 'background', 'green')" />
<ul>
	<li class="fruit">orange</li>
	<li class="fruit">banana</li>
	<li class="fruit">apple</li>
	<li class="veg">potato</li>
	<li class="veg">cabbage</li>
	<li class="veg">carrot</li>
</ul>
<p>I created a generic function to perform this:</p>
<pre>
function setClassStyle(tagName, className, styleName, styleValue) {
   elemColl = document.getElementsByTagName(tagName);
   for (var i = 0; i < elemColl.length; i++) {
      var elemClass = elemColl[i].getAttribute('class'); 
      if (elemClass == className) {
          elemColl[i].style[styleName] = styleValue;
      }
   }
}
</pre>

<h2>Select a whole row or column</h2>
<table>
<tr>
	<th></th>
	<th><input type="button" name="col" value="A" onclick="toggle(this)" /></th>
	<th><input type="button" name="col" value="B" /></th>
	<th><input type="button" name="col" value="C" /></th>
	<th><input type="button" name="col" value="D" /></th>
</tr>
<tr>
	<th><input type="button" name="row" value="1" onclick="toggle(this)" /></th>
	<td><input type="checkbox" name="A" value="1" /></td>
	<td><input type="checkbox" name="B" value="1" /></td>
	<td><input type="checkbox" name="C" value="1" /></td>
	<td><input type="checkbox" name="D" value="1" /></td>
</tr>
<tr>
	<th><input type="button" name="row" value="2" /></th>
	<td><input type="checkbox" name="A" value="2" /></td>
	<td><input type="checkbox" name="B" value="2" /></td>
	<td><input type="checkbox" name="C" value="2" /></td>
	<td><input type="checkbox" name="D" value="2" /></td>
</tr>
<tr>
	<th><input type="button" name="row" value="3" /></th>
	<td><input type="checkbox" name="A" value="3" /></td>
	<td><input type="checkbox" name="B" value="3" /></td>
	<td><input type="checkbox" name="C" value="3" /></td>
	<td><input type="checkbox" name="D" value="3" /></td>
</tr>
</table>
</form>

</div>
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>