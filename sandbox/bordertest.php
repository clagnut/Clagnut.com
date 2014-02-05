<?php
$filename = "bordertest";

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
</style>
</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div>
<h2>In your current browser</h2>

<p style="border:1px solid #000">border:1px solid #000</p>
<p style="border:1px dotted #000">border:1px dotted #000</p>
<p style="border:1px dashed #000">border:1px dashed #000</p>

<p style="border:2px solid #000">border:2px solid #000</p>
<p style="border:2px dotted #000">border:2px dotted #000</p>
<p style="border:2px dashed #000">border:2px dashed #000</p>

</div>
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>