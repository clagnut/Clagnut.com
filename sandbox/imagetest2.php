<?php
$filename = "imagetest2";

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
IMG {padding:4px; border:1px solid #a9a9a9}
#img1 {}
#img2 {border-collapse:collapse; width:100%;}
#img2a {text-align:left}
#img2b {text-align:center}
#img2c {text-align:right}
#img3 {text-align:center}
#img3a {float:left;}
#img3b {float:right;}
#img4 {text-align:center; position:relative; width:100%;}
#img4a {position:absolute; left:0;}
#img4c {position:absolute; right:0;}
#img5 {margin:0 9.03%;}
</style>

</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
<p>See also:</p>

<ul>
  <li><a href="/sandbox/imagetest/">Experiments with wide images</a></li>
  <li><a href="/sandbox/imagetest3/">Experiments with max-width and images</a></li>
</ul>
<p><strong>Please try <a href="javascript:moveTo(50,5); window.resizeTo(600,screen.availHeight-80)" title="Resize window to 600px wide">shrinking your window</a> with different browsers and observe what happens to the different images.</strong></p>
</div> <!-- /intro -->


<h2>1. Three small images, side by side with padding and border styles applied</h2>
<p id="img1">
<img src="/photos/th/1.jpg" alt="">
<img src="/photos/th/2.jpg" alt="">
<img src="/photos/th/3.jpg" alt="">
</p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>




<h2>2. Three small images in a table with LHS and RHS images touching the gutter</h2>
<table id="img2">
<tr><td id="img2a"><img src="/photos/th/1.jpg" alt=""></td><td id="img2b"><img src="/photos/th/2.jpg" alt=""></td><td id="img2c"><img src="/photos/th/3.jpg" alt=""></td></tr>
</table>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>3. Three small images, floated left, right and text-aligned centrally</h2>
<p id="img3">
<img src="/photos/th/1.jpg" alt="" id="img3a">
<img src="/photos/th/3.jpg" alt="" id="img3b">
<img src="/photos/th/2.jpg" alt="" id="img3c">
</p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>4. Three small images, positioned left, right and text-aligned centrally</h2>
<p id="img4">
<img src="/photos/th/1.jpg" alt="" id="img4a">
<img src="/photos/th/2.jpg" alt="" id="img4b">
<img src="/photos/th/3.jpg" alt="" id="img4c">
</p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>



<h2>5. Three small images separated by margins the same size as the text gutter</h2>
<p>
<img src="/photos/th/1.jpg" alt=""><img src="/photos/th/3.jpg" alt="" id="img5"><img src="/photos/th/2.jpg" alt="">
</p>
<p>Pellentesque in felis quis tortor consectetuer condimentum. Phasellus nibh nibh, interdum sit amet, sagittis nec, cursus sit amet, dolor. Duis scelerisque tortor. Aenean nec turpis. Curabitur nulla mauris, gravida eu, ultrices id, aliquam nec, mauris. </p>


</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>