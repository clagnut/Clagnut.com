<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$activity_slug = "user_research";
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

<p class="leader">User Research involves finding out about the desires, needs and preferences of a website&#8217;s users.</p>
<p>User research is a vital part of user-centred design. It can take many forms, including surveys, one-on-one interviews, informal testing, and <a href="/does/contextual_inquiry">contextual inquiry</a> (observing users in their own environment).</p>


<div class="things n1">

<?php include("case-studies.inc.php"); ?>

</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
