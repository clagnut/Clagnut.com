<?php
$filename = "js-enhanced-IR";

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
#heading {
	width:402px;
	height:111px;
	background: #005A00 url(/sandbox/golfheading.jpg) no-repeat;
	text-indent:-1000px;
	color:#fff;
	font-size:60px;
	font-style:italic;
	margin-bottom:12px;
}
</style>
<script src="/sandbox/jir.js"></script>
</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" id="logoimg" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div> <!-- /intro -->

<h2>The premise</h2>
<p>Most image replacement (IR) techniques work by displaying a background image of text and shifting the real text out of view. This is fine unless you have images turned off, in which case you will see neither the graphical text nor the real text.</p>

<p>So the requirement is to disable the IR if images are turned off. This can be accomplished with a short piece of unobtrusive JavaScript.</p>

<p>The script detailed here fires on load. It tries to determine if images have loaded and if not it undoes the CSS in the IR technique. This script has been successfully tested in Firefox, Opera 7.5, IE6 and Safari 1.3 (not that you can turn images off in Safari).</p>

<h2>An example</h2>
<p>The following should show a header graphic (extracted from a forth-coming website). If you turn images off, you should see real text instead.</p>
<div id="heading">Golf Breaks</div>
<p>The HTML is fiendishly simple:</p>

<pre><code>&lt;div id="heading"&gt;Golf Breaks&lt;/div&gt;</code></pre>

<p>I've used a <code>div</code> with an <code>id</code>; you would probably use an <code>h1</code> or some other meaningful mark-up. The style rules applied to the div use the Phark method of IR (this is my preferred method as it is so simple):</p>

<pre><code>#heading {
  /* IR stuff */
  width:402px;
  height:111px;
  background: #005A00 url(/sandbox/golfheading.jpg) no-repeat;
  text-indent:-1000px;

  /* Style for text when visible*/
  color:#fff;
  font-size:60px;
  font-style:italic;
}
</code></pre>



<h2>The script</h2>

<p>Here is the script in its entirety. You can download it from <a href="/sandbox/jir.js">jir.js</a>.</p>

<pre><code>function checkImages() {
  if (document.getElementById) {
    var x = document.getElementById('logoimg').offsetWidth;
    if (x != '134') {
      document.getElementById('heading').style.textIndent = "0";
    }
  }
}

window.onload = checkImages;</code></pre>

<h2>The code explained</h2>

<p>The <code>checkImages()</code> function determines whether images are turned off. It does this by checking the <code>offsetWidth</code> of an existing inline image - the logo in this case, as it is ever present. If the <code>offsetWidth</code> of the image element does not equal the known width of the image then images are assumed to be turned off and the IR technique is reversed to reveal the heading text.</p>

<p>Note that in order for the script to work, the targeted image element must not have any <code>width</code> or <code>height</code> attributes and its size must not be specifically set in a style sheet.</p>

<h2 id="known-issues">Known issues</h2>
<ul>
	<li>The script relies on there being an image element in the document. This feels clunky but it's hardly an unlikely situation given that you can target a logo image.</li>
	<li>This script only fixes the images turned off scenario. It will not display real text while images are loading over a slow connection, although you could easily get the script to reverse its behaviour and apply IR if images have loaded.</li>
	<li>If the chosen test image fails to load, the script will be fooled into thinking images are turned off and will display the real text. You could reduce the probability of this by checking two test images.</li>
	<li>In IE/Win, if the image has been previously cached and images are subsequently turned off, the image element still retains the dimensions of the cached image and so the script is fooled into thinking that images are still turned on. A nasty way around this would be to apply a random query string to the target image so that it is always requested from the server.</li>
</ul>

</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>