<?php
$filename = "imagetest3";

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
#img1 {}
#img2 IMG {width:100%;}
#img3 IMG {width:100%; max-width:320px;}
#img4 IMG {max-width:100%;}
#img5 IMG {max-width:100%; width:320px}
</style>

</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
<p>See also:</p>
<ul>
<li><a href="/sandbox/imagetest2/">Experiments with three images</a></li>
<li><a href="/sandbox/imagetest/">Experiments with wide images</a></li>
</ul>
<p><strong>Please try <a href="javascript:moveTo(50,5); window.resizeTo(600,screen.availHeight-80)" title="Resize window to 600px wide">shrinking your window</a> with different browsers and observe what happens to the different images.</strong></p>

</div> <!-- /intro -->

<h2>1. A medium image contained in a paragraph with no styles applied</h2>
<p id="img1"><img src="/images/duranduran.jpg" alt=""></p>
<p><code>#img1 {}</code></p>


<h2>2. A medium image with a width of 100% (no height set)</h2>
<p id="img2"><img src="/images/duranduran.jpg" alt=""></p>
<p><code>#img2 IMG {width:100%;}</code></p>


<h2>3. A medium image with a width of 100% and a max-width equal to the actual image size (no height set)</h2>
<p id="img3"><img src="/images/duranduran.jpg" alt=""></p>
<p><code>#img3 IMG {width:100%; max-width:320px;}</code></p>


<h2>4. A medium image with a max-width of 100% (no height or width set)</h2>
<p id="img4"><img src="/images/duranduran.jpg" alt=""></p>
<p><code>#img4 IMG {max-width:100%;}</code></p>


<h2>5. A medium image with a max-width of 100% and a width equal to the actual image size (no height set)</h2>
<p id="img5"><img src="/images/duranduran.jpg" alt=""></p>
<p><code>#img5 IMG {max-width:100%; width:320px}</code></p>

</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>