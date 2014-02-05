<?php
$filename = "imagefades";

$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);

include($dr . "/includes/sandbox_getdetails.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$title?> | clagnut/sandbox</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
@import url(/css/sandbox.css);
#photoholder {
	width:450px;
	height:338px;
	border:1px solid #666;
	background:#fff url('/images/loading.gif') 50% 50% no-repeat;
}
#thephoto {
	width:450px;
	height:338px;
}
TABLE {
	margin-bottom:1em;
	border-collapse:collapse;
}
TH {
	font-weight:normal;
	font-style:italic;
	white-space:nowrap;
	text-align:left;
}
TD, TH {
	vertical-align:top;
	padding:0.25em 0.5em;
	border:1px solid #ddd;
}
</style>

<script type="text/javascript">
<!--
document.write("<style type='text/css'>#thephoto {visibility:hidden;}</style>");

function initImage() {
	imageId = 'thephoto';
	image = document.getElementById(imageId);
	setOpacity(image, 0);
	image.style.visibility = "visible";
	fadeIn(imageId,0);
}
function fadeIn(objId,opacity) {
	if (document.getElementById) {
		obj = document.getElementById(objId);
		if (opacity <= 100) {
			setOpacity(obj, opacity);
			opacity += 10;
			window.setTimeout("fadeIn('"+objId+"',"+opacity+")", 100);
		}
	}
}
function setOpacity(obj, opacity) {
	opacity = (opacity == 100)?99.999:opacity;
	// IE/Win
	obj.style.filter = "alpha(opacity:"+opacity+")";
	// Safari<1.2, Konqueror
	obj.style.KHTMLOpacity = opacity/100;
	// Older Mozilla and Firefox
	obj.style.MozOpacity = opacity/100;
	// Safari 1.2, newer Firefox and Mozilla, CSS3
	obj.style.opacity = opacity/100;
}
window.onload = function() {initImage()}
// -->
</script>
</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div> <!-- /intro -->
<h2>Example</h2>

<p id="photoholder">
<img src="/images/ithaka.jpg" alt="Picturesque fishing village on Ithaka." id="thephoto" />
</p>
<p>I've deliberately made the image quite a large filesize so you'll have a chance to see the 'loading&#8230;' message before it fades out.</p>

<h2>The code</h2>
<p>The photo is a straightforward image in a div. Each has an id:</p>
<pre><code>&lt;div id='photoholder'&gt;
&lt;img src='/images/ithaka.jpg' alt='Photo' id='thephoto' /&gt;
&lt;/div&gt;</code></pre>

<p>The 'loading&#8230;' image is set as the background to the photoholder div, and the photoholder is sized to match the photo.</p>
<pre><code>#photoholder {
  width:450px;
  height:338px;
  background:#fff url('/images/loading.gif') 50% 50% no-repeat;
}
#thephoto {
  width:450px;
  height:338px;
}</code></pre>

<p>To prevent a cached photo from displaying before it has been faded in, when need to make the photo hidden. JavaScript is used to write a style rule so that users without JavaScript enabled will not have the photo permanently hidden:</p>

<pre><code>document.write(&quot;&lt;style type='text/css'&gt;
  #thephoto {visibility:hidden;} &lt;/style&gt;&quot;);</code></pre>

<p>Note that <a href="http://ln.hixie.ch/?start=1091626816&amp;count=1" title="Hixie explains why"><code>document.write</code> does not work</a> when XHTML is properly sent as application/xhtml+xml. You will either have to use HTML or serve your document as text/html.</p>

<p>Once everything on the page has loaded (crucially this includes images), an <code>onload</code> event is triggered, calling our <code>initImage</code> function:</p>
<pre><code>window.onload = function() {initImage()}</code></pre>

<p>The <code>initImage</code> function makes the photo completely tranpsarent by using the <code>setOpacity</code> function to set its opacity to zero. The photo can then be made visible and faded in using the <code>fadeIn</code> function:</p>

<pre><code>function initImage() {
  imageId = 'thephoto';
  image = document.getElementById(imageId);
  setOpacity(image, 0);
  image.style.visibility = 'visible';
  fadeIn(imageId,0);
}</code></pre>

<p>The <code>setOpacity</code> function is passed an object and an opacity value. It then sets the opacity of the supplied object using four proprietary ways. It also prevents a flicker in Firefox caused when opacity is set to 100%, by setting the value to 99.999% instead.</p>

<pre><code>function setOpacity(obj, opacity) {
  opacity = (opacity == 100)?99.999:opacity;
  
  // IE/Win
  obj.style.filter = "alpha(opacity:"+opacity+")";
  
  // Safari&lt;1.2, Konqueror
  obj.style.KHTMLOpacity = opacity/100;
  
  // Older Mozilla and Firefox
  obj.style.MozOpacity = opacity/100;
  
  // Safari 1.2, newer Firefox and Mozilla, CSS3
  obj.style.opacity = opacity/100;
}</code></pre>

<p>The <code>fadeIn</code> function uses a <code>Timeout</code> to call itself every 100ms with an object Id and an opacity. The opacity is specified as a percentage and increased 10% at a time. The loop stops once the opacity reaches 100%:</p>

<pre><code>function fadeIn(objId,opacity) {
  if (document.getElementById) {
    obj = document.getElementById(objId);
    if (opacity &lt;= 100) {
      setOpacity(obj, opacity);
      opacity += 10;
      window.setTimeout(&quot;fadeIn('&quot;+objId+&quot;',&quot;+opacity+&quot;)&quot;, 100);
    }
  }
}</code></pre>

<h3>Accessibility</h3>
<p>This implementation caters for all combinations of JS and CSS; that is to say the photo can always be seen once it has loaded.</p>

<table>
<tr>
	<th>CSS &amp; JS</th>
	<td>'loading&#8230;' image displayed, photo fades in once loaded.</td>
</tr>
<tr>
	<th>No CSS or JS</th>
	<td>No 'loading&#8230;' image, photo appears once loaded.</td>
</tr>
<tr>
	<th>CSS but no JS</th>
	<td>'loading&#8230;' image displayed, photo appears once loaded.</td>
</tr>
<tr>
	<th>JS but no CSS</th>
	<td>No 'loading&#8230;' image displayed, photo either appears or fades in once loaded (depending on why there's no CSS).</td>
</tr>
</table>

<p>All the scripts and style sheets should be held in their own files to fully separate the content, presentation and behaviour layers (they are coded into the <code>head</code> here for demonstration purposes).</p>

</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>