<?php
$filename = "dynamic-accesskeys";

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
#xmp-nav A {
	text-decoration:none;
}
#xmp-nav A SPAN {
	text-decoration:underline;
}
</style>

<script type="text/javascript">
function underline() {
	var nav = document.getElementById('xmp-nav');
	var navlinks = nav.getElementsByTagName('A');
	for (var i = 0; i < navlinks.length; i++) {
		var accesskey = navlinks[i].getAttribute('accesskey');
		if (accesskey) {
			var link = navlinks[i];
			var linktext = link.childNodes[0].nodeValue;
			var keypos = linktext.indexOf(accesskey);
			var firstportion = linktext.substring(0,keypos);
			var keyportion = linktext.substring(keypos,keypos+1);
			var lastportion = linktext.substring(keypos+1,linktext.length);
			
			link.childNodes[0].nodeValue = firstportion;
			var s = document.createElement("span");
			var span = link.appendChild(s);
			var keyt = document.createTextNode(keyportion);
			span.appendChild(keyt);
			var lastt = document.createTextNode(lastportion);
			link.appendChild(lastt);
		}
	}
}

window.onload = function() {
	underline();
}
</script>

</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div> <!-- /intro -->

<h2>Some links with accesskeys</h2>
<ul id="xmp-nav">
<li><a href="#" accesskey="A">About Us</a></li>
<li><a href="#" accesskey="v">Services</a></li>
<li><a href="#" accesskey="P">Products</a></li>
<li><a href="#" accesskey="C">Contact</a></li>
<li><a href="#" accesskey="S">Search</a></li>
</ul>

<h2>The code explained</h2>
<p>View source if you want to grab the code in one go.</p>

<pre><code>function underline() {
  var nav = document.getElementById('xmp-nav');
  var navlinks = nav.getElementsByTagName('A');</code></pre>
  
<p>We select all the links in our <code>xmp-nav</code> list.</p>
  
<pre><code>  for (var i = 0; i < navlinks.length; i++) {</code></pre>
  
<p>Loop through all the links.</p>

<pre><code>    var accesskey = navlinks[i].getAttribute('accesskey');</code></pre>

<p>Pull out the accesskey defined for the link.</p>

<pre><code>    if (accesskey) {
      var link = navlinks[i];
      var linktext = link.childNodes[0].nodeValue;</code></pre>
      
<p>Get the text of the link.</p>
      
<pre><code>      var keypos = linktext.indexOf(accesskey);</code></pre>

<p>Find the first instance of the assigned accesskey in the link text.</p>

<pre><code>      var firstportion = linktext.substring(0,keypos);
      var keyportion = linktext.substring(keypos,keypos+1);
      var lastportion = linktext.substring(keypos+1,linktext.length);</code></pre>
      
<p>Isolate the accesskey text and the bit of text before and after the accesskey.</p>
      
<pre><code>      link.childNodes[0].nodeValue = firstportion;</code></pre>

<p>Rewrite the link text with only the bit of text before the accesskey.</p>

<pre><code>      var s = document.createElement("span");
      var span = link.appendChild(s);</code></pre>
      
<p>Create a <code>span</code> element and attach it to the link</p>

<pre><code>      var keyt = document.createTextNode(keyportion);
      span.appendChild(keyt);</code></pre>
      
<p>Write the accesskey letter inside the newly created <code>span</code>.</p>

<pre><code>      var lastt = document.createTextNode(lastportion);
      link.appendChild(lastt);
    }
  }
}</code></pre>

<p>Append the remaining portion of the link text to the link.</p>

<pre><code>window.onload = function() {
  underline();
}</code></pre>

<p>Call the underline function when the document loads.</p>


</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>