<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$page = pagination($data['people']);

$title= "Who we are | Clearleft &middot; User Experience Consultants";
include($dr . "head.inc.php");
?>

<body class="section-is">
<?php include($dr . "header.inc.php"); ?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/is/">Who we are</a></p>
    <ul class="pagination">
        <li><a rel="prev" href="/is/<?php echo $page['prevHref'] ?>" title="<?php echo $page['prevTitle'] ?>"><?php echo $page['prevTitle'] ?></a></li>
        <li><a rel="next" href="/is/<?php echo $page['nextHref'] ?>" title="<?php echo $page['nextTitle'] ?>"><?php echo $page['nextTitle'] ?></a></li>
    </ul>
</nav>

<h1>We love the web and we love design &ndash; it&#8217;s part of who we&nbsp;are</h1>

<p class="leader">You&#8217;ll work directly with the most experienced talent in the industry. Over the years, all of our close-knit team has worked with clients big and small. We are asked to speak at events around the world, we&#8217;re featured in influential publications and we&#8217;ve even written a few&nbsp;books.</p>


<div class="figures">
<ul class="n3">

<?php foreach( $data['people'] as $slug => $person ) { ?>

<li><figure><a href="<?php echo $slug; ?>"><img src="/i/is/<?php echo $slug; ?>.jpg" alt="" /></a>
<figcaption><a href="<?php echo $slug; ?>"><?php echo $person['name']; ?></a>, <?php echo $person['role']; ?></figcaption></figure></li>

<?php } ?>

</ul>
</div> <!-- /figures -->

<?php /* bye bye
<h3>Clearleft Alumni</h3>
<p>Still part of the family: <a href="andy_hume">Andy Hume</a>, <a href="sophie_barrett">Sophie Barrett</a>, <a href="natalie_downe">Natalie Downe</a>, <a href="paul_annett">Paul Annett</a>.</p>
*/ ?>

</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
