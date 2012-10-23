<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$person_slug = "harry_brignull";
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
<li><a href="http://90percentofeverything.com" class="website" rel="me">Harry&#8217;s blog</a></li>
<li><a href="http://twitter.com/harrybr" class="twitter" rel="me">@harrybr</a></li>
<li><a href="http://last.fm/user/harrybr" class="lastfm" rel="me">Last.fm</a></li>
<li><a href="http://uk.linkedin.com/in/harrybrignull" class="linkedin" rel="me">LinkedIn</a></li>
<li><a href="http://lanyrd.com/harrybr" class="lanyrd" rel="me">Lanyrd</a></li>
<li><a href="https://speakerdeck.com/search?q=harry+brignull" class="speakerdeck" rel="me">Speakerdeck</a></li>
<li><a href="http://www.slideshare.net/harrybr" class="slideshare" rel="me">Slideshare</a></li>
</ul>
</aside>

<p class="leader">Harry is a UX designer with a background in psychology and research. With this platform, Harry designs empathetic, user-centred web sites which are easy and enjoyable to use.</p>

<p>Armed with an MSc in Human-Centred Computer Systems, Harry&#8217;s career began as a Research Fellow, and a PhD in Cognitive Science soon followed. Harry&#8217;s research brought together CSCW (Computer Supported Collaborative Work, what we now call social apps), ethnography, sociology and HCI (Human-Computer Interaction).</p>

<p>Harry went on to work as a UX consultant and UX lead for Amberlight, Flow Interactive and Madgex, designing solutions for major clients including Microsoft, Vodafone, the Guardian and the Washington Post.</p>

<p>At Clearleft, Harry uses these years of experience to help our clients develop their business objectives by building an understanding of  users&#8217; needs, and to help ensure the resultant designs are useful and enjoyable to use.</p>

<p>Since working at Clearleft, Harry has designed websites and apps for <abbr title="Design and Artists Copyright Society">DACS</abbr> and <a href="/made/theweek_app">Dennis Publishing</a>. He is currently redesigning the website for a major US environmental organisation.</p>

<h3>Exposing dark patterns</h3>

<p>Harry&#8217;s specialises in user research, workshop facilitation, early-stage interaction design and information architecture.  He is a member of the <abbr title="Usability Professionals Association">UPA</abbr> and the <abbr title="Interaction Design Association">IxDA</abbr>. He is a regular speaker and has presented at UX London, UX Brighton, Domainfest, CSCW and Interact among others.</p>

<p>Harry regular writes UX-related posts on his website, <a href="http://90percentofeverything.com">90% of Everything</a>. He runs <a href="http://darkpatterns.org">darkpatterns.org</a>, a community site which aims to name and shame web businesses that use dirty tricks to boost their conversion rates. Earlier in 2012 he launched the <a href="http://www.90percentofeverything.com/2012/06/21/dark-patterns-2012-awards-submissions-now-open/">Dark Patterns Awards</a>.</p>


<h3>Away from the office</h3>

<p>Harry is a devoted family man, with two beautiful kids who seem to take up all his spare time.</p>


<div class="things n3">


<div class="group">
<h3>Latest articles</h3>
<ul>

<li class="thing">
<h5><a href="http://www.90percentofeverything.com/2012/06/17/copywriting-a-life-saving-kit-a-fathers-day-guest-article/"><strong>90% of Everything</strong>: Copywriting: a life-saving kit</a></h5>
<p>Harry asks a multiple D&AD award-winning copy writer if advertising copywriting from the 60s, 70s and 80s might be of help to UX designers today.</p>
</li>

<li class="thing">
<h5><a href="http://www.alistapart.com/articles/dark-patterns-deception-vs.-honesty-in-ui-design/"><strong>A List Apart</strong>: Dark Patterns &ndash; Deception vs Honesty in UI Design</a></h5>
<p>Harry exposes the dark side of unethical web design practices.</p>
</li>

<li class="thing">
<h5><a href="http://www.netmagazine.com/features/big-question-should-we-design-browser-start"><strong>.net</strong>: Should we design in the browser from the start?</a></h5>
<p>Harry joins a panel of other experts to discuss the advantages and disadvantages of designing in the browser.</p>
</li>

</ul>
</div> <!-- /group -->


<?php include("lanyrd.inc.php"); ?>


<div class="group">

<h3>Published books</h3>

<ul> 
<li class="thing">None yet, but &#8216;Dark Patterns&#8217; is crying out for a brave publisher.</li>
</ul>

</div> <!-- /group -->


</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
