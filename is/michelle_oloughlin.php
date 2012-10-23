<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$person_slug = "michelle_oloughlin";
$person = $data['people'][$person_slug];
$page = pagination($data['people'], $person_slug);
$case_studies = getCaseStudiesForPerson( $person_slug, $data );

$title= $person['name'] . " | Clearleft &middot; Who we are";
include($dr . "head.inc.php");
?>

<body class="section-is">
<?php include($dr . "header.inc.php"); ?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/is/">Who we are</a> / <?php echo $person['name']; ?></p>
    <ul class="pagination">
        <li><a rel="prev" href="/is/<?php echo $page['prevHref'] ?>" title="<?php echo $page['prevTitle'] ?>"><?php echo $page['prevTitle'] ?></a></li>
        <li><a rel="next" href="/is/<?php echo $page['nextHref'] ?>" title="<?php echo $page['nextTitle'] ?>"><?php echo $page['nextTitle'] ?></a></li>
    </ul>
</nav>

<h1><?php echo $person['name']; ?>, <?php echo $person['role']; ?></h1>


<aside>
<div class="figures">
<figure><img src="/i/is/<?php echo $person_slug; ?>.jpg" alt="<?php echo $person['name']; ?>" />
</div>


<h3>Elsewhere on the web</h3>
<ul class="elsewhere">
<li><a href="http://me-ow.co.uk/" class="website" rel="me">Michelle&#8217;s personal site</a></li>
<li><a href="http://twitter.com/micholoughlin" class="twitter" rel="me">@micholoughlin</a></li>
<li><a href="http://flickr.com/photos/hello.mich" class="flickr" rel="me">Flickr</a></li>
<li><a href="http://uk.linkedin.com/pub/michelle-o-loughlin/31/207/8a9" class="linkedin" rel="me">LinkedIn</a></li>
<li><a href="http://lanyrd.com/micholoughlin" class="lanyrd" rel="me">Lanyrd</a></li>
</ul>
</aside>

<p class="leader">Michelle has been designing interactive TV and websites since 1999. She is a massively talented visual designer with true UX sensibilities.</p>

<p>Michelle has a long and varied history, working as both a UX designer and visual designer in New Zealand and London. She has for a huge range of clients including universities, Buckingham Palace, and the UK Foreign &amp; Commonwealth Office.</p>

<p>Michelle works closely with clients to create the perfect visual look for their website and ensuring brand consistency, pushing the brand where possible. Michelle's UX experience means she works extremelty effectively alongside the UX designers, generating ideas, defining interactions and refining user journeys. Ultimately Michelle creates modular design patterns which are used across large and complex sites.</p>

<p>Since working at Clearleft, Michelle has designed websites for <a href="/made/itv_food">ITV Food</a>, Family Investments, What Car, Shopify and <a href="/made/wellcome">Wellcome Library</a>. She is currently redesigning an asset management application for an international broadcaster.</p>

<h3>Visual designer with UX sensibilities</h3>

<p>Michelle designs sites that not only look great, but make complex things feel simple through clear visual design. Shes completely at home working on large websites with the many design and UX challenges they bring.</p>

<p>Out in the design community, Michelle is a key part of the support team for <a href="http://lanyrd.com/series/shesays/">SheSays Brighton</a>.</p>

<h3>Away from the office</h3>

<p>Michelle loves the outdoors and the sea, so you're likely to find her out walking or sailing at weekends. She also has a very strange obsession with sausage dogs.</p>

<div class="things n3">

<?php /* 
<div class="group">
<h3>Latest articles</h3>
</div> <!-- /group -->
 */ ?>

<?php include("lanyrd.inc.php"); ?>


<?php /* 
<div class="group">
<h3>Published books</h3>
</div> <!-- /group -->
 */ ?>


</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
