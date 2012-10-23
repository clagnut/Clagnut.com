<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$page = pagination($data['case_studies']);

$title= "Our work | Clearleft &middot; User Experience Consultants";
include($dr . "head.inc.php");
?>

<body class="section-made">
<?php include($dr . "header.inc.php"); ?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/made/">Our work</a></p>
    <ul class="pagination">
        <li><a rel="prev" href="/made/<?php echo $page['prevHref'] ?>" title="<?php echo $page['prevTitle'] ?>"><?php echo $page['prevTitle'] ?></a></li>
        <li><a rel="next" href="/made/<?php echo $page['nextHref'] ?>" title="<?php echo $page['nextTitle'] ?>"><?php echo $page['nextTitle'] ?></a></li>
    </ul>
</nav>

<h1>We&#8217;ve helped organisations of all sizes get better results from their websites &amp; products</h1>

<p class="leader">We love new challenges, so we&#8217;ve worked right across the board from modest start-ups to global brands, local charities to media empires, ecommerce retailers to political activists.</p>


<div class="figures" style="margin-top:-1.66667em">
<ul class="n3">

<?php foreach( $data['case_studies'] as $slug => $case_study ): ?>

<li><figure>
<h3><a href="/made/<?php echo $slug; ?>"><?php echo $case_study['name']; ?></a></h3>
<a href="/made/<?php echo $slug; ?>"><img src="/i/made/thumb-<?php echo $slug; ?>.png" alt="" /></a>
<figcaption><?php echo $case_study['description']; ?></figcaption>
</figure></li>

<?php endforeach; ?>

</ul>
</div> <!-- /figures -->

<h3>Some of the organisations we've helped</h3>

<ul class="cloud">
<?php foreach( $data['case_studies'] as $slug => $case_study ): ?>

<li><a href="/made/<?php echo $slug; ?>"><img src="/i/made/logo-<?php echo $slug; ?>.png" alt="<?php echo $case_study['name']; ?>" /></a></li>

<?php endforeach; ?>
	<li>Family Investments</li>
	<li>Fontdeck</li>
	<li>Razoo</li>
	<li>BFI</li>
	<li>University of Wales</li>
	<li>Riverford Organic Vegetables</li>
	<li>Mozilla</li>
	<li>Firefox Add-ons</li>
	<li>Amnesty International</li>
	<li>38 Degrees</li>
	<li>Rate My Area</li>
	<li>St Paul's School</li>
	<li>Fontdeck</li>
	<li>NBC Universal</li>
	<li>Dennis Publishing</li>
	<li>Haymarket</li>
	<li>Scholastic</li>
	<li>Pearson Education</li>
</ul>



</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
