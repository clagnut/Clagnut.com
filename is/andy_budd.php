<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$person_slug = "andy_budd";
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
<li><a href="http://andybudd.com" class="website" rel="me">Andy&#8217;s blog</a></li>
<li><a href="http://twitter.com/andybudd" class="twitter" rel="me">@andybudd</a></li>
<li><a href="http://lanyrd.com/andybudd" class="lanyrd" rel="me">Lanyrd</a></li>
<li><a href="http://uk.linkedin.com/in/andybudd" class="linkedin" rel="me">LinkedIn</a></li>
<li><a href="http://flickr.com/photos/andybudd" class="flickr" rel="me">Flickr</a></li>
<li><a href="http://last.fm/user/andybudd" class="lastfm" rel="me">Last.fm</a></li>
<li><a href="http://www.new.facebook.com/profile.php?id=502823855" class="facebook" rel="me">Facebook</a></li>
</ul>
</aside>

<p class="leader">Andy started designing websites in 1994. He founded Clearleft with <a href="/is/richard_rutter">Richard Rutter</a> and <a href="/is/jeremy_keith">Jeremy Keith</a> in 2005 and now sets the company direction, cultivating relationships with clients and promoting the work we do at Clearleft.</p>

<p>Andy began his career at Message, a small design studio in Brighton. Here Andy honed his skills as a visual designer and front-end developer. It was during this time that Andy was a major contributor to the pioneering Web Standards movement, culminating in his best selling book, &#8220;CSS Mastery&#8221;.</p>

<p>At Clearleft, Andy&#8217;s experience and understanding of what makes a successful digital project finds him providing advice and strategic consultancy to clients, as well as planning and troubleshooting projects with the Clearleft team.</p>

<p>Andy was named as one of Wired UK&#8217;s top 100 digital power brokers.</p>

<h3>Mentor and evangelist</h3>

<p>Andy spends a significant proportion of his time promoting the design industry at conferences and in the wider media. He is an advisor for .net magazine and a invited judge for past <abbr title="British Interactive Media Association">BIMA</abbr> and .net awards. He is an organiser of the <a href="http://brightondigitalfestival.co.uk">Brighton Digital Festival</a> as well as the originator of Clearleft&#8217;s popular design conferences, <a href="http//dconstruct.org">dConstruct</a> and <a href="http://uxlondon.com">UX London</a>.</p>

<p>Andy donates his time as a mentor at events including Seedcamp. His was a guest lecturer at New York’s School of Visual Arts, and is a mentor at London&#8217;s School of Communication Arts, helping young web designers find their way in the business.</p>

<p>
Andy has spoken at <a href="http://lanyrd.com/profile/andybudd/past/speaking/">numerous conferences</a> including An Event Apart, South by Southwest, UX Australia and Inspire.
</p>

<h3>Away from the office</h3>

<p>Andy loves to travel and gets away five or six times a year, usually combining business with pleasure around the world. He used to teach diving and recently returned from a trip to Sipadan-Mabul. Hand-in-hand with travel goes a love of cooking &ndash; if you need a good vegetarian recipe, you need look no further.</p>

<p>Andy is a big movie fan, one of the main reasons for Clearleft&#8217;s monthly movie nights. Despite being a movie fan, Andy&#8217;s favourite film is <a href="http://www.imdb.com/title/tt0104299/">Freejack</a>.</p>


<div class="things n3">


<div class="group">
<h3>Latest articles</h3>
<ul>
<li class="thing">
<h5><a href="http://www.netmagazine.com/interviews/andy-budd-dconstruct-2012"><strong>.net</strong>: Andy Budd on dConstruct 2012</a></h5>
<p>The Clearleft founder talks to Craig Grannell about the popular Brighton web design conference and &#8216;playing with the future&#8217;.</p>
</li>

<li class="thing">
<h5><a href="http://52weeksofux.com/post/495997061/ux-insights-an-interview-with-andy-budd"><strong>UX Insights</strong>: an interview with Andy Budd</a></h5>
<p>An interview with Andy as part of a discourse on designing for real people.</p>
</li>

</ul>
</div> <!-- /group -->


<?php include("lanyrd.inc.php"); ?>


<div class="group">
<h3>Published books</h3>

<ul class="books">
<li class="thing">
<img src="/i/books/cssmastery.jpg" alt="" />
<h5><a href="http://cssmastery.com">CSS Mastery</a></h5>
<p class="meta">published by <cite>Friends of ED</cite></p>
</li>

<li class="thing">
<img src="/i/books/blogdesignsolutions.jpg" alt="" />
<h5><a href="http://www.amazon.co.uk/exec/obidos/ASIN/1590595815/jalfrezi-21/">Blog Design Solutions</a></h5>
<p class="meta">published by <cite>Friends of ED</cite></p>
</li>
</ul>
</div> <!-- /group -->


</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
