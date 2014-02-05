<?php
$filename = "blinking";

$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);

include($dr . "/includes/sandbox_getdetails.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<h2>A blink tag in action</h2>
<p>This will probably only work in Firefox and friends as <q cite="http://www.hicom.net/~oedipus/wai/ua/tests/blinking_text_test2.html">user agents do not need to support the blink effect in order to conform to either  CSS1 or  CSS2</q> and so not many do.</p>

<p><code>&lt;blink&gt;flip&lt;/blink&gt;</code> : <blink>flip</blink></p>


<h2>A blink tag suppressed</h2>

<p><code>&lt;blink style=&quot;text-decoration:none&quot;&gt;flip&lt;/blink&gt;</code> : <blink style="text-decoration:none">flip</blink></p>

</div>
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>