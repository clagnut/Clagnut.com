<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$page = pagination($data['case_studies'], 'channel_4_news');
$case_study = getCaseStudy( 'channel_4_news', $data );

$title= $case_study['name'] . " | Clearleft &middot; Our work";
include($dr . "head.inc.php");
?>

<body class="section-made">
<?php include($dr . "header.inc.php"); ?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/made/">Our work</a> / <?php echo $case_study['name']; ?></p>
    <ul class="pagination">
        <li><a rel="prev" href="/made/<?php echo $page['prevHref'] ?>" title="<?php echo $page['prevTitle'] ?>"><?php echo $page['prevTitle'] ?></a></li>
        <li><a rel="next" href="/made/<?php echo $page['nextHref'] ?>" title="<?php echo $page['nextTitle'] ?>"><?php echo $page['nextTitle'] ?></a></li>
    </ul>
</nav>

<h1><?php echo $case_study['name']; ?></h1>

<aside>
<div class="boxout">
<ul class="keypoints xoxo">
	<li>Project duration <strong>6&nbsp;months</strong></li>
	<li><strong>Readership increased</strong> 34%</li>
	<li>Website <strong>integral to program</strong></li>
	<li>See <a href="http://www.channel4.com/news/"><strong>channel4.com/news</strong></a></li>
</ul>
</div>
</aside>

<p class="leader">Clearleft helped Channel&nbsp;4 reinvent their online news presence by understanding the journalists&#8217; processes, and building on the show’s personality and in-depth reporting of current&nbsp;affairs.</p>

<div class="figures">
<ul class="n0">
<li><figure><img src="/i/made/channel4_news/1.png" alt="Screenshot of home page" /></figure></li>
</ul>
</div>

<h3>The Problem</h3>
<p>The previous website for Channel&nbsp;4 News was centred around breaking news. This was at odds with the on-air brand which is focussd on in-depth, quality reporting. Consequently the website was failing to support the Channel&nbsp;4 News brand and readership was suffering.</p>

<h3>The Solution</h3>

<aside>
<blockquote>
<p><span class="qu">&#8220;</span>The new site has given the whole newsroom at ITN a real lift and helped make the integration into a totally multi-media outlet work so much better.&#8221;</p>
</blockquote>
<p class="byline">&mdash;&thinsp;Vicky Taylor, Commissioning Editor News and Current Affairs at Channel&nbsp;4</p>
</aside>

<h4>Contextual Research.</h4>
<p>Clearleft co-located at Channel&nbsp;4 offices in London to aid decision making and maximise project visibility. We also spent a significant amount of time with the news team at ITN, understanding their workflow and the nature of the newsroom.</p>

<h4>Rapid Idea Generation.</h4>
<p>After a series of workshops involving key stakeholders from Channel&nbsp;4 and ITN, our team moved into a period of rapid idea generation, sketching possible directions the service could take. These were displayed on a &#8216;sketch board&#8217; within Channel&nbsp;4&#8217;s offices, enabling passing feedback and engagement with our progress.</p>

<div class="figures">
<ul class="n3">
<li><figure><img src="/i/made/channel4_news/2.jpg" alt="Photo of design wall" />
<figcaption>Sketch wall</figcaption></figure></li>
<li><figure><img src="/i/made/channel4_news/4.jpg" alt="Screenshot of Style Guide" />
<figcaption>Modular design system</figcaption></figure></li>
<li><figure><img src="/i/made/channel4_news/7.jpg" alt="Screenshot of gravigation" />
<figcaption>Innovative footer-based navigation</figcaption></figure></li>
</ul>
</div>

<h4>Usability Testing.</h4>
<p>During ideation, we designed an innovative approach to footer-based navigation (dubbed &#8216;gravigation&#8217;) which focused the user on the content over browsing. Being a novel approach, we ran usability tests on the device &ndash; the results were good so the gravigation stayed.</p>

<h4>Visual Design.</h4>
<p>Working closely with Channel&nbsp;4&#8217;s creative team, we draw on the programmes unique bold on-air brand, tying the website into Channel&nbsp;4&#8217;s overall news proposition. We designed a modular design system which provided a framework for all pages, and enabled future pages to put togther by the editorial team.</p>

<div class="figures">
<ul class="n2">
<li><figure><img src="/i/made/channel4_news/6.jpg" alt="Screenshot of talent page" />
<figcaption>We worked hard to draw upon the on-air brand by heavily featuring the broadcast talent and giving these well known personalities a voice on the site.</figcaption></figure></li>
<li><figure><img src="/i/made/channel4_news/3.jpg" alt="Screenshot of special feature page" />
<figcaption>We created a framework for special feature pages which could be semi-automatically updated.</figcaption></figure></li>
</ul>
</div>

<h3>The Result</h3>

<aside>
<blockquote>
<p><span class="qu">&#8220;</span>Clearleft are one of the best agencies we&#8217;ve ever had the pleasure of working with.&#8221;</p>
</blockquote>
<p class="byline">&mdash;&thinsp;Stephen Hardingham, Channel&nbsp;4</p>
</aside>

<p>Our engagement lasted 6 months. The site was launched in September 2010 and readership increased by 34%.  The site is now an integral part of Channel&nbsp;4’s news offering and is always featured in the TV broadcast.</p>
<p>The web site has been extremely well received, with glowing articles appearing in the <a href="http://www.guardian.co.uk/media/pda/2010/sep/27/channel-4-news-website-relaunch">Guardian</a>, <a href="http://www.nma.co.uk/news/more-analytical-channel-4-news-site-goes-live/3018636.article">New Media Age</a> and others. Clearleft are now working with Channel&nbsp;4 on more of their big media properties.</p>

<div class="things n3">

<div class="group">
<h3>Team Members</h3>

<ul>
    <?php foreach( $case_study['people'] as $slug => $person ): ?>
	<li class="thing">
	<a href="/is/<?php echo $slug; ?>"><img src="/i/is/<?php echo $slug; ?>-80.jpg" alt="<?php echo $person['name']; ?>" /></a>
	<h5><a href="/is/<?php echo $slug; ?>"><?php echo $person['name']; ?></a></h5>
	<p><?php echo $person['role']; ?></p>
	</li>
    <?php endforeach; ?>
</ul>
</div> <!-- /group -->


<div class="group">
<h3>Activities</h3>

<ul class="cloud tags">
    <?php foreach( $case_study['activities'] as $slug => $activity ): ?>
    <li class="thing">
        <a href="/does/<?php echo $slug; ?>"><?php echo $activity['name']; ?></a>
    </li>
    <?php endforeach; ?>
</ul>

</div> <!-- /group -->


<div class="group">
<h3>Related Projects</h3>
<ul>
    <?php foreach( $case_study['cases'] as $slug => $case ): ?>
	<li class="thing">
	<h5><a href="/made/<?php echo $slug; ?>"><img src="/i/made/logo-<?php echo $slug; ?>.png" alt="<?php echo $case['name']; ?>" /></a></h5>
	<p><?php echo $case['description']; ?></p>
	</li>
    <?php endforeach; ?>
</ul>
</div> <!-- /group -->

</div> <!-- /things -->

</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
