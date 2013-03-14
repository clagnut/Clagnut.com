<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
$title= "User Experience Consultants &amp; Web Design Agency | Clearleft &middot; Brighton, UK";
$data = require_once($dr.'data.php');

include($dr . "head.inc.php");
?>

<body class="section-home">
<?php include($dr . "header.inc.php"); ?>

<div id="main">
<h1>We create digital experiences that are easy &amp; delightful to&nbsp;use</h1>

<p class="leader">We use our experience to design yours. We’ve helped organisations of all sizes get better results from their websites and products. We love the web and we love design.</p>

<div class="figures strip">
<ul class="n0">
<?php
$n = 1;
foreach( $data['case_studies'] as $slug => $case_study ):
if ($n>4) break;
?>

<li><figure><a href="/made/<?php echo $slug; ?>"><img src="/i/made/thumb-<?php echo $slug; ?>.png" alt="<?php echo $case_study['name']; ?>" class="thumb" />
<img src="/i/pattern-orig.png" class="mask" alt="" />
</a></figure></li>

<?php 
$n++;
endforeach;
?>

</ul>
</div>


<p style="margin-top:2.66666666666667em">Read more about <a href="/does/">what we do and our philosophy</a> to design. Judge for yourself the <a href="/made/">work and results</a> we&#8217;ve achieved for other clients, and meet our <a href="/is">highly experienced team</a> who just love to&nbsp;design.</p>

<div class="things n1">

<div class="group n3">

<h2><a href="http://feeds.feedburner.com/clearleftnews" rel="alternate" type="application/rss+xml" title="RSS Feed" style="float:right"><img src="/i/icons/feed-16x16.png" alt="RSS Feed" style="vertical-align:top" /></a>What we&#8217;ve been up to recently</h2>

<ul class="hfeed">

<li class="thing">
<article class="hentry" id="post-94">
<abbr title="2012-05-10T18:31:05" class="published">10th May 2012</abbr>
<h3 class="entry-title"><a href="/news/94/">Ampersand 2012 sold out!</a></h3>
<div class="entry-content">
<p>We&#8217;re thrilled to say that this year&#8217;s Ampersand conference has now sold out!  We&#8217;re looking forward to welcoming everyone to Brighton next month for our second year of type-enthused festivities.</p>
<p>  If you&#8217;ve nabbed a ticket you can check out the full schedule on the rather lovely <a href="http://2012.ampersandconf.com/">Ampersand site</a>.  And if you haven&#8217;t snagged a place, we do have a <a href="http://ampersand2012.eventbrite.com/?ebtv=C">waiting list</a> you can join (and keep your fingers crossed!).</p>
</div>
</article>
</li>


<li class="thing">
<article class="hentry" id="post-93">
<abbr title="2012-05-10T18:31:05" class="published">10th May 2012</abbr>
<h3 class="entry-title"><a href="/news/93/">UX London</a></h3>
<div class="entry-content">
We had a fantastic time at this year&#8217;s UX London.  We&#8217;d like to thank our brilliant speakers, super sponsors, and &ndash; of course &ndash; tip top attendees, who seemed to thoroughly enjoy themselves.  If you were able to join us, we hope you came away with plenty of UX inspiration&#8230; which looks to be the case having seen some delegates&#8217; blog posts and sketchnotes, like <a href="http://www.flickr.com/photos/25896906@N06/sets/72157629865406695/">these</a> by Michele Ide-Smith at RedGate Software (we love seeing attendees&#8217; posts about the event, so please send yours on to us!).  Also, we&#8217;re posting the speakers&#8217; slides as we receive them, so you can check those out on the <a href="http://2012.uxlondon.com/">UX London site</a>.
</div>
</article>
</li>


<li class="thing">
<article class="hentry" id="post-92">
<abbr title="2012-04-23T17:39:47" class="published">23rd April 2012</abbr>
<h3 class="entry-title"><a href="/news/92/">dConstruct 2012</a></h3>
<div class="entry-content">
<p>Thank you to everyone who came along to UX London last week. We had a splendid time and we hope you did too.</p>

<p>With barely a pause for breath, we’re already preparing for our other upcoming events. There are still <a href="http://ampersand2012.eventbrite.com/">some tickets available</a> for <a href="http://2012.ampersandconf.com/">Ampersand</a> in June and we’ve just announced <a href="http://2012.dconstruct.org/">the line-up for this year’s dConstruct</a> in September. Just look at that stellar constellation of names, including the one and only <a href="http://2012.dconstruct.org/conference/burke/">James Burke</a>!</p>

<p>Tickets will be £130 plus VAT and they go on sale on May 29th. And don’t forget: we’ll also be hosting <a href="http://2012.dconstruct.org/workshops/">four superb workshops</a> in the run-up to the conference.</p>
</div>
</article>
</li>


</ul>

</div> <!-- /group -->

</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
