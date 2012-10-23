<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$person_slug = "kate_bulpitt";
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
<li><a href="http://adactio.com/" class="website" rel="me">Jeremy&#8217;s personal site</a></li>
<li><a href="http://twitter.com/adactio" class="twitter" rel="me">@adactio</a></li>
<li><a href="http://flickr.com/photos/adactio" class="flickr" rel="me">Flickr</a></li>
<li><a href="http://last.fm/user/adactio" class="lastfm" rel="me">Last.fm</a></li>
<li><a href="http://dribbble.com/adactio" class="dribbble" rel="me">Dribbble</a></li>
<li><a href="http://lanyrd.com/adactio" class="lanyrd" rel="me">Lanyrd</a></li>
<li><a href="http://speakerdeck.com/u/adactio" class="speakerdeck" rel="me">Speakerdeck</a></li>
<li><a href="http://www.slideshare.net/adactio" class="slideshare" rel="me">Slideshare</a></li>
<li><a href="http://uk.linkedin.com/in/adactio" class="linkedin" rel="me">LinkedIn</a></li>
<li><a href="http://pinboard.in/u:adactio" class="pinboard" rel="me">Pinboard</a></li>
<li><a href="http://huffduffer.com/adactio" class="huffduffer" rel="me">Huffduffer</a></li>
<li><a href="http://github.com/adactio" class="github" rel="me">Github</a></li>
</ul>
</aside>

<p class="leader">Leading couple of sentences summarising person's experience and expertise.</p>

<p>Before Clearleft... person worked for so-and-so doing some things for a list of prominent clients</p>

<p>At Clearleft... persons does these things to some great effect</p>

<p>At Clearleft, person has done stuff for these clients (linking to case studies were applicable). He/she is currently doing something for a generically-named client.</p>

<h3>Subheading by way of unique job title</h3>

<p>Person has these particular qualities unique within Clearleft.</p>

<p>Person also belongs to these organisations and does these things in the community, including speaking, etc.</p>

<h3>Away from the office</h3>

<p>Person is a rounded, interesting individual with these interests.</p>

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
