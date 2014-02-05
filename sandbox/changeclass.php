<?php
$filename = "changeclass";

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
function setClassStyle(tagName, className, styleName, styleValue) {
	elemColl = document.getElementsByTagName(tagName);
	for (var i = 0; i < elemColl.length; i++) {
		var elemClass = elemColl[i].className; 
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
<h2>Redefine a class&#8217;s styles</h2>
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
</form>

<p>I created a generic function to perform this:</p>
<pre><code>function setClassStyle(tagName, className, styleName, styleValue) {
   elemColl = document.getElementsByTagName(tagName);
   for (var i = 0; i < elemColl.length; i++) {
      var elemClass = elemColl[i].className; 
      if (elemClass == className) {
          elemColl[i].style[styleName] = styleValue;
      }
   }
}
</code></pre>
<p>We are passing four parameters to the function:</p>
<ol>
	<li>tagName = li</li>
	<li>className = fruit</li>
	<li>styleName = background</li>
	<li>styleValue = yellow</li>
</ol>
<p>The function finds all the <code>li</code> elements with a class of <code>fruit</code> and sets the background to be yellow.</p>
<p>To accomplish this, the function starts off with the <code>getElementsByTagName</code> method. All elements and attributes on the page are held in nested arrays called HTMLCollections. <code>getElementsByTagName('li')</code> gives us an HTMLCollection of all the <code>li</code> elements in the document.</p>
<p>As HTMLCollections are arrays of objects, we can use a <code>for</code> loop to step through each element in the collection. For each li, we use the <code>className</code> property to find the class name; this we assign to the <code>elemClass</code> variable.</p>
<p>Next we check if the li has the same class we passed to the function. If it does we change the style accordingly. Note that square brackets are equivalent to using a full stop (.), as style properties are yet another array of an HTML object.</p>
<p>As it stands,the function applies to all elements in the document. Using the DOM tree, we can make the function apply only to items within a given list. By giving the <code>ul</code> an id of <code>mylist</code> we need only change the first line of the function, replacing <code>document</code> with the more specific <code>document.getElementById</code>:</p>
<pre><code>elemColl = document.getElementById('mylist').getElementsByTagName(tagName);
</code></pre>

</div>
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>