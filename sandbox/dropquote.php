<?php
$filename = "dropquote";

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


#eg-quote {
	position:relative;
	width:190px;
	font-family:georgia, serif;
	font-style:italic;
	font-size:14px;
	line-height:1.3em;
	margin-left:0;
}

.openq, .closeq {
	color:#888888;
	font-family:'rotis sans', helvetica, arial, sans-serif;
	font-size:2.5em;
	vertical-align:top;
	font-style:normal;
}
.openq {
	position:absolute;
	left:-12px;
}

HTML>BODY .closeq {
	position:relative;
	top:0.25em;
}

HTML>BODY .openq {
	padding-top:0.25em;
}
</style>

</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div> <!-- /intro -->

<h2>Example</h2>
<blockquote id="eg-quote"><span class="openq">&#8220;</span>To me, jewellery is an art form and this is always the inspiration behind my work.<span class="closeq">&#8221;</span></blockquote>

</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>