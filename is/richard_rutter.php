<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$person_slug = "richard_rutter";
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
<li><a href="http://clagnut.com" class="website" rel="me">Richard&#8217;s blog</a></li>
<li><a href="http://webtypography.net" class="website" rel="me">WebTypography.net</a></li>
<li><a href="http://twitter.com/clagnut" class="twitter" rel="me">@clagnut</a></li>
<li><a href="http://lanyrd.com/clagnut" class="lanyrd" rel="me">Lanyrd</a></li>
<li><a href="http://uk.linkedin.com/in/richardrutter" class="linkedin" rel="me">LinkedIn</a></li>
<li><a href="http://flickr.com/photos/clagnut" class="flickr" rel="me">Flickr</a></li>
<li><a href="http://pinboard.in/u:clagnut" class="pinboard" rel="me">Pinboard</a></li>
<li><a href="http://dribbble.com/clagnut" class="dribbble" rel="me">Dribbble</a></li>
<li><a href="http://huffduffer.com/clagnut" class="huffduffer" rel="me">Huffduffer</a></li>
<li><a href="http://last.fm/user/clagnut" class="lastfm" rel="me">Last.fm</a></li>
</ul>
</aside>

<p class="leader">Richard started designing websites way back in 1994. Since founding Clearleft with <a href="/is/andy_budd">Andy Budd</a> and <a href="/is/jeremy_keith">Jeremy Keith</a>, he has retained his role as a user experience designer, working with clients and their customers to translate their ideas into new and improved websites and applications. </p>

<p>Richard began his career designing the UX of web sites for Barclaycard, as well as numerous dot com start ups. He moved on to become the user experience lead at Multimap, Europe&#8217;s most popular mapping site, which was recently acquired by Microsoft. </p>

<p>
At Clearleft his work includes redesigning the <a href="/made/riverford">Riverford Organics</a> web site, creating a new ecommerce presence for Pearson Education, improving student help for the Open University, designing a radical new location-based search for Gumtree and streamlining Amnesty International&#8217;s operations. He is currently redesigning a video-on-demand service for a major broadcaster.
</p>

<p>Richard was named as one of Wired UK&#8217;s top 100 digital power brokers.</p>

<h3>Web typography evangelist</h3>

<p>
Richard has a deep love and fascination for typography. He created Clearleft&#8217;s Fontdeck web service, in partnership with OmniTI. As a self-appointed web typography evangelist, Richard is chief organiser of Clearleft&#8217;s annual Ampersand web typography conference. He also put together <a href="http://webtypography.net/">webtypography.net</a> which translates Bringhurst&#8217;s typographic guidelines into CSS. He has a web typography book in the works with Five Simple Steps.
</p>

<p>
Richard is a member of the <abbr title="Interaction Design Association">IxDA</abbr>, London <abbr title="Information Architecture">IA</abbr> group and <abbr title="Association Typographique International">ATypI</abbr>. He has spoken at <a href="http://lanyrd.com/profile/clagnut/past/speaking/">numerous conferences</a> on prototyping and typography, including An Event Apart, UIE&#8217;s Web App Summit and UX London.
</p>

<h3>Away from the office</h3>

<p>Richard is an avid Chelsea FC fan, regularly shouting from the stands at Stamford Bridge. He used to describe himself as a mountain biker, but family commitments mean that’s mostly limited to cycling into work.</p>
<p>For some reason Richard still buys CDs and vinyl, and he occasionally records new episodes for ClagTunes, his music podcast. He writes about the web and typography on his blog. His favourite font is currently Premiera designed by Thomas Gabriel of Typejockeys.</p>


<div class="things n3">


<div class="group">
<h3>Latest articles</h3>
<ul>
<li class="thing">
<h5><a href="http://www.webdesignermag.co.uk/magazine-issues/web-designer-198-now-on-sale/"><strong>Web Designer</strong>: The Future of Fonts</a></h5>
<p>Richard highlights the latest techniques and tools for web font and typography glory.</p>
</li>

<li class="thing">
<h5><a href="http://blog.fontdeck.com/post/23997061678/cookies"><strong>Fontdeck blog</strong>: Cookies and EU Law</a></h5>
<p>An overview of the requirements on web site owners with regard to EU cookie regulations.</p>
</li>

</ul>
</div> <!-- /group -->

<?php include("lanyrd.inc.php"); ?>

<div class="group">
<h3>Published books</h3>

<ul class="books">
<li class="thing">
<img src="/i/books/webaccessibility.jpg" alt="" />
<h5><a href="http://www.amazon.co.uk/exec/obidos/ASIN/1590596382/jalfrezi-21/">Web Accessibility: Web Standards &amp; Regulatory Compliance</a></h5>
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
