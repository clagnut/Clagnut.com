<?php
$filename = "imagetest";

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
#img8 IMG {max-width:100%;}
#img4 {overflow:hidden;}
#img5 {overflow:hidden;}
#img5 IMG {float:right;}
#img6 {background:url(/sandbox/imagetests/wideimg.png) no-repeat center; height:171px}
#img7 {background:url(/images/duranduran.jpg) no-repeat center; height:240px}
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
<li><a href="/sandbox/imagetest3/">Experiments with max-width and images</a></li>
</ul>
 
<p><strong>Please try <a href="javascript:moveTo(50,5); window.resizeTo(600,screen.availHeight-80)" title="Resize window to 600px wide">shrinking your window</a> with different browsers and observe what happens to the different images.</strong></p>

</div> <!-- /intro -->

<h2>1. A very wide image contained in a paragraph with no styles applied</h2>
<p id="img1"><img src="/sandbox/imagetests/wideimg.png" alt=""></p>
<p><em><a href="http://www.1976design.com/blog/">Dunstan</a> kindly lent me this charming image.</em></p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>2. A very wide image with a width of 100% (no height set)</h2>
<p id="img2"><img src="/sandbox/imagetests/wideimg.png" alt=""></p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>3. A medium image with a width of 100% and a max-width equal to the actual image size (no height set)</h2>
<p id="img3"><img src="/images/duranduran.jpg" alt=""></p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>8. A medium image with a max-width of 100% (no height set)</h2>
<p id="img8"><img src="/images/duranduran.jpg" alt=""></p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>4. A very wide image with overflow:hidden applied to its container</h2>
<p id="img4"><img src="/sandbox/imagetests/wideimg.png" alt=""></p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>5. A very wide image floated right with overflow:hidden applied to its container</h2>
<p id="img5"><img src="/sandbox/imagetests/wideimg.png" alt=""></p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>6. A very wide image centered as a background with container height set to image height</h2>
<p id="img6"></p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>7. As (6) with a medium image</h2>
<p id="img7"></p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>