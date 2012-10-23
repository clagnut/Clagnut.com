<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$person_slug = "paul_lloyd";
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
<li><a href="http://paulrobertlloyd.com/" class="website" rel="me">Paul&#8217;s blog</a></li>
<li><a href="http://twitter.com/paulrobertlloyd" class="twitter" rel="me">@paulrobertlloyd</a></li>
<li><a href="http://flickr.com/photos/paulrobertlloyd" class="flickr" rel="me">Flickr</a></li>
<li><a href="http://last.fm/user/paulrobertlloyd" class="lastfm" rel="me">Last.fm</a></li>
<li><a href="http://dribbble.com/paulrobertlloyd" class="dribbble" rel="me">Dribbble</a></li>
<li><a href="http://lanyrd.com/paulrobertlloyd" class="lanyrd" rel="me">Lanyrd</a></li>
<li><a href="http://speakerdeck.com/u/paulrobertlloyd" class="speakerdeck" rel="me">Speakerdeck</a></li>
</ul>
</aside>

<p class="leader">Paul began building his first website on 14th January 1999. That he remembers this date so vividly might explain why he's still designing websites well over a decade later.</p>

<p>Before Clearleft, Paul worked for Ning, a start-up in San Fransico California founded by Marc Andreessen of Netscape. As lead designer, he was responsible for developing the company's distinctive branding and designed their initial set of social products.</p>

<p>Paul is a designer who works with clients to understand their business goals, working to ensure that any branding and messaging is reflected accurately on their website. He loves collaborating with user experience designers to create effective and usable interfaces, and working alongside front-end developers to establish visual language systems that can be expressed in markup and CSS.</p>

<p>At Clearleft, Paul has designed websites for a wide variety of clients including <a href="/made/channel_4_news">Channel 4 News</a>, <a href="/made/universal_networks">NBC Universal</a> and BBC Radio 4. Being an accomplished all-rounder, Paul designed and built a new site for <abbr title="Design and Artists Copyright Society">DACS</abbr> and crafted the user experience and visual design for <a href="/made/theweek_app">Dennis Publishing</a>, <a href="/made/gumtree">Gumtree</a> and Mozilla among others. Paul is responsible for the overall design direction of the <a href="http://fontdeck.com/">Fontdeck</a> webfont service. He is currently redesigning the website for a major American environmental organisation.</p>

<h3>Expert in responsive design &amp; design systems</h3>

<p>Paul is fascinated by the concept of responsive web design, especially from the perspective of how this informs workflow; moving from linear (and sometimes segregated) processes to those that are more agile and collaborative. Paul was an invited expert at the <a href="http://www.responsivesummit.com/">Responsive Summit</a>.</p>

<p>Paul is also interested in design systems such as the BBC's Global Experience Language (GEL) and writes a <a href="http://gelled.info/">blog critiquing GEL</a> implementations. Paul firmly believes that by developing common design and interaction patterns, we can combine the systems of the web and visual design to great effect.</p>

<p>Paul is extremely active in the web design community. He <a href="http://lanyrd.com/profile/paulrobertlloyd/past/speaking/">speaks</a> on a wide range subjects at events including Geek in the Park, Oxford Geek Nights and APA Digital Breakfast. Paul co-founded <a href="http://multipack.co.uk/">Multipack</a>, a community for web designers and developers in Birmingham.</p>

<h3>Away from the office</h3>

<p>Paul has become increasingly attracted to running, and earlier this year completed the Brighton marathon. Paul loves to travel, especially <a href="http://www.flickr.com/photos/paulrobertlloyd/sets/72157622893099814/">by train</a>; he also enjoys a spot of karting. Paul will be volunteering at this year's Olympic and Paralympic games.</p>


<div class="things n3">


<div class="group">
<h3>Latest articles</h3>
<ul>
<li class="thing">
<h5><a href="http://24ways.org/201105"><strong>24 Ways</strong>: Collaborative Development for a Responsively Designed Web</a></h5>
<p>Paul writes about the importance of goodwill between designers and developers, emphasizing constant contact and mutual appreciation.</p>
</li>

<li class="thing">
<h5><a href="http://www.netmagazine.com/tutorials/build-responsive-site-week-designing-responsively-part-1"><strong>.net</strong>: Responsive Web Design Tutorial</a></h5>
<p>Paul goes through the responsive design process, soup to nuts.</p>
</li>

<li class="thing">
<h5><a href="http://paulrobertlloyd.com/2012/02/offscreen/"><strong>Offscreen</strong>: A day in the life</a></h5>
<p>Paul was featured in Offscreen, a beautiful new magazine that focuses on the personalities behind the pixels.</p>
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
