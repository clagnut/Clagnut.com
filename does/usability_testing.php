<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$activity_slug = "usability_testing";
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

<p class="leader">Usability Testing is a technique employed to refine designs by watching real people attempt specific tasks.</p>
<p>Clearleft runs usability tests whenever we can to inform and confirm our design decisions. It is extremely valuable watching real people use what we have designed as it provides insights not obtainable in any other way. Clearleft uses a low cost &#8216;guerilla&#8217; form of usability testing for which we designed our <a href="http://silverbackapp.com">Silverback</a> usability testing software (it&#8217;s used by <abbr class="smcp">NASA</abbr> and Twitter to name but two).</p>


<div class="things n1">

<?php include("case-studies.inc.php"); ?>

</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
