<?php
$filename = "clear_none";

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
#example P {float:left; width:100px; border:1px solid #0f0; margin:0}
#example DIV {clear:left; border:1px solid #00f; margin:0}
#example DIV#rich {clear:none; border:1px solid #f00; margin:0}
</style>	
</head>

<body>
<h4 id="logo"><a href="/">clagnut</a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div> <!-- /intro -->

<h2>The test</h2>
<p>In this test we float a paragraph to the left and follow it by two divs. In our CSS we set all divs to be <code>clear:left</code> &#8211; this would cause the divs to be displayed underneath the float, not alongside. However we do want the first div to be displayed next to the float so we give it an id and apply <code>clear:none</code> to the id to cancel out the inherited <code>clear:left</code>.</p>

<p>This works fine in all modern browsers (Firefox, IE6, etc) but not in Safari. Safari seems to ignore the <code>clear:none</code> so our first div appear below the float and not next to it as desired.</p>

<p>The HTML:</p>
<pre><code>&lt;p&gt;Some text&#8230;&lt;/p&gt;
&lt;div id="rich"&gt;This text should be to the right&#8230;&lt;/div&gt;
&lt;div&gt;This text should be underneath&#8230;&lt;/div&gt;
</code></pre>

<p>The CSS:</p>
<pre><code>P {float:left; width:100px}
DIV {clear:left}
DIV#rich {clear:none}
</code></pre>

<div id="example">
<p>Some text in a paragraph box.</p>
<div id="rich">This text should be to the right of the paragraph box.</div>
<div>This text should be underneath the paragraph box.</div>
</div>

</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>