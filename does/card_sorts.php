<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$activity_slug = "card_sorts";
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

<p class="leader">Card Sorts are a form of user research used to inform and verify website structure and labelling.</p>
<p>We use card sort to exam how users group topics. It is a simple and effective technique where topics or site sections are written on index cards and participants are asked to group the cards, and provide a label for each group. A variation, called a closed card sort, asks the particpants to place the cards into predefined categories. Occasionally we run large card sorts online, but we prefer to run the tests in person, as this reveals deeper insights into peoples's expectations of content and functionality.</p>


<div class="things n1">

<?php include("case-studies.inc.php"); ?>

</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
