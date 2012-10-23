<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$person_slug = "ben_sauer";
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
<li><a href="http://www.redbeard.org.uk" class="website" rel="me">Ben&#8217;s blog</a></li>
<li><a href="http://twitter.com/bensauer" class="twitter" rel="me">@bensauer</a></li>
<li><a href="http://lanyrd.com/bensauer" class="lanyrd" rel="me">Lanyrd</a></li>
<li><a href="http://uk.linkedin.com/in/bensauer" class="linkedin" rel="me">LinkedIn</a></li>
</ul>
</aside>

<p class="leader">Ben has been involved in web design since 1994. He uses his considerable experience to help our clients define and rethink their digital strategy.</p>

<p>Before joining Clearleft, Ben was a freelance UX consultant and founder member of the Escape Committee design cooperative. He has an English degree but has also worked as a web developer, affording him that winning combination of humanities and engineering.</p>

<p>Over the years Ben improved websites for travel companies, educators, publishers and  charities including Amnesty. His last freelance project was applying his web usability testing skills to a print product (one with a <em>very</em> small typeface!).</p>

<p>At Clearleft, Ben makes the interfaces between people and their digital things more humane. He is currently redesigning the website for a leading British university.</p>

<h3>Strategic designer</h3>

<p>As a UX designer, Ben particularly excels at developing digital strategy within organisations, in particular he helps plan and design the impact a particular business culture has on users and customers.</p>


<h3>Away from the office</h3>

<p>Besides changing nappies and diverting tantrums with voodoo kid persuasion, Ben enjoys running and making music with aluminium guitars. He grew up in the world of motorsport but has left it behind, despite having once beaten Jensen Button (true).

<p>P.S. Sauer rhymes with power, as in Jack Bauer.</p>

<div class="things n3">


<div class="group">
<h3>Latest articles</h3>
<ul>
<li class="thing">
<h5><a href="http://www.redbeard.org.uk/2012/06/14/hands-on-my-experiences-usability-testing-a-printed-booklet/">Hands on! My experiences usability testing a printed booklet</a></h5>
<p>Ben describes the set-up and experience of usability testing a printed product.</p>
</li>

</ul>
</div> <!-- /group -->


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
