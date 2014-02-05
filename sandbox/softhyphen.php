<?php
$filename = "softhyphen";

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
#content IMG{
	padding:5px;
	border:1px solid #666;
}
</style>

</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div> <!-- /intro -->

<h2>The tests</h2>
<p>In these tests, I have placed 7 soft hyphens within a particularly long word. The tests are repeated using the <code>&amp;shy;</code> and <code>&amp;#173;</code> entities and thirdly by coding a <code>&lt;br/&gt;</code> in the middle of the word</p>
<p>In all cases, where a line is broken at a soft hyphen, a hyphen character must be displayed at the end of the first line. If a line is not broken at a soft hyphen, the user agent must not display a hyphen character.</p>

<h2>Soft hyphens tests in your current browser</h2>
<p>I&#8217;m told this is the longest word in the English language: anti&shy;dis&shy;est&shy;ab&shy;lish&shy;ment&shy;arian&shy;ism.</p>
<p>I&#8217;m told this is the longest word in the English language: anti&#173;dis&#173;est&#173;ab&#173;lish&#173;ment&#173;arian&#173;ism.</p>
<p>I&#8217;m told this is the longest word in the English language: anti&#173;dis&#173;est&#173;ab&#173;<br />lish&#173;ment&#173;arian&#173;ism.</p>

<h2>Soft hyphens tests in Internet Explorer 6</h2>
<p><img src="/images/softhyphen_ie6.gif" alt="screen shot of IE6 rendering soft hyphens correctly" /></p>

<h2>Soft hyphens tests in Safari 1.2</h2>
<p><img src="/images/softhyphen_safari1.2.gif" alt="screen shot of Safari 1.2 rendering all soft hyphens as visible" /></p>

<h2>Soft hyphens tests in Mozilla 1.6</h2>
<p><img src="/images/softhyphen_mozilla1.6.gif" alt="screen shot of Mozilla 1.6 not rendering any soft hyphens as visible" /></p>

<h2>Soft hyphens tests in Opera 7.23</h2>
<p><img src="/images/softhyphen_opera7.23.gif" alt="screen shot of Opera 7.23 rendering soft hyphens correctly" /></p>

</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>