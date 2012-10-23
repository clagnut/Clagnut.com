<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$activity_slug = "design_workshops";
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

<p class="leader">Design Workshops are collaborative activities performed early in the project and see the client working in conjunction with our designers.</p>
<p>Design workshops help uncover functionality and priorities through structured but fun design games. Our designers will work directly with representatives from the client, involving them in the creative process, helping us see the problem from many angles in a short timescale, and giving stakeholders a deeper interest in the design process.</p>


<div class="things n1">

<?php include("case-studies.inc.php"); ?>

</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
