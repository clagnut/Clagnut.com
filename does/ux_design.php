<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$activity_slug = "ux_design";
$activity = $data['activities'][$activity_slug];
$page = pagination($data['activities'], $activity_slug);
$case_studies = getCaseStudiesForActivity( $activity_slug, $data );

$title= $activity['name'] . " | Clearleft &middot; What we do";
include($dr . "head.inc.php");
?>

<body class="section-does">
<?php include($dr . "header.inc.php");?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/does/">What we do</a> / <?php echo $activity['name']; ?></p>
    <ul class="pagination">
        <li><a rel="prev" href="/does/<?php echo $page['prevHref'] ?>" title="<?php echo $page['prevTitle'] ?>"><?php echo $page['prevTitle'] ?></a></li>
        <li><a rel="next" href="/does/<?php echo $page['nextHref'] ?>" title="<?php echo $page['nextTitle'] ?>"><?php echo $page['nextTitle'] ?></a></li>
    </ul>
</nav>

<h1><?php echo $activity['name']; ?></h1>

<p class="leader">User Experience Design (UXD) is a broad term we use to encompass designing how a person users a website or application.</p>
<p>User Experience Design includes defining a person&#8217;s journeys through the site; how he or she uses the site&#8217;s functions and how the pages are structured to help a person achieve their goals. Good UXD is all about user-centred design, that is to say putting people first.</p>


<div class="things n1">

<?php include("case-studies.inc.php"); ?>

</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
