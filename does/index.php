<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$page = pagination($data['activities']);

$title= "What we do | Clearleft &middot; User Experience Consultants";
include($dr . "head.inc.php");
?>

<body class="section-does">
<?php include($dr . "header.inc.php"); ?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/is/">What we do</a></p>
    <ul class="pagination">
        <li><a rel="prev" href="/does/<?php echo $page['prevHref'] ?>" title="<?php echo $page['prevTitle'] ?>"><?php echo $page['prevTitle'] ?></a></li>
        <li><a rel="next" href="/does/<?php echo $page['nextHref'] ?>" title="<?php echo $page['nextTitle'] ?>"><?php echo $page['nextTitle'] ?></a></li>
    </ul>
</nav>

<h1>We use our experience to design&nbsp;yours</h1>

<p class="leader">We help organisations radically improve their websites and create exciting new digital products. We combine a unique lean approach with our knowledge of human behaviour and the principles of user-centred&nbsp;design.</p>

<div class="things n1 boxout">

<div class="group n3">
<h2>The way we do things</h2>
<ul>

<li class="thing">
<h3>Experience is everything.</h3>
<p>You’ll work directly with world-leading UX consultants. We won’t fob you off with junior designers or layers of account management.</p>
</li>


<li class="thing">
<h3>Research paves the way.</h3>
<p>We need to understand your problem before we can solve it. We’ll research with customers and stakeholders early on.</p>
</li>


<li class="thing">
<h3>Communication over reports.</h3>
<p>Our streamlined approach of ‘pictures and conversations’ keeps developers happy and helps your budget go a long way.</p>
</li>

<li class="thing">
<h3>Analyse & iterate to improve.</h3>
<p>We'll use feedback loops to incrementally improve designs and occasionally to adjust the course of an entire project.</p>
</li>

<li class="thing">
<h3>Beauty is not skin deep.</h3>
<p>We design delightful interfaces. This isn’t style over substance &ndash; every design decision improves the experience for your customers.</p>
</li>

<li class="thing">
<h3>Products should last.</h3>
<p>We invest time in crafting elegant, modular design systems. These are easier to implement and maintain in the long term.</p>
</li>
</ul>

</div> <!-- /group -->

</div> <!-- /things -->

<h3>Areas of Expertise</h3>
<p>We draw upon a large range of techniques, services and tools in our design work. Here's a few of them:</p>

<ul class="cloud tags">

<?php foreach( $data['activities'] as $slug => $activity ) { ?>

<li><a href="<?php echo $slug; ?>"><?php echo $activity['name']; ?></a></li>

<?php } ?>

</ul>


<div class="things n2">
<h2>Did you know we also&hellip;</h2>

<div class="group hcalendar">
<h3>Run conferences</h3>
<ul>
<li class="thing vevent">
<h5><a href="http://uxlondon.com/" class="url summary"><img src="/i/made/logo-channel_4_news.png" alt="UX London" /></a></h5>
<p class="meta">
<span class="location">London, UK</span> &mdash;
<abbr class="dtstart" title="2012-04-18">18</abbr>&ndash;<abbr class="dtend" title="2012-04-20">20 April 2012</abbr>
</p>
<p class="description">3 days of inspiration, education and skills development for user experience&nbsp;designers.</p>
</li>

<li class="thing vevent">
<h5><a href="http://ampersandconf.com/" class="url summary"><img src="/i/made/logo-channel_4_news.png" alt="Ampersand" /></a></h5>
<p class="meta">
<span class="location">Brighton, UK</span> &mdash;
<abbr class="dtstart" title="2012-06-15">15 June 2012</abbr>
</p>
<p class="description">The web typography conference, combining the worlds of web and type&nbsp;design.</p>
</li>

<li class="thing vevent">
<h5><a href="http://dconstruct.org/" class="url summary"><img src="/i/made/logo-channel_4_news.png" alt="dConstruct" /></a></h5>
<p class="meta">
<span class="location">Brighton, UK</span> &mdash;
<abbr class="dtstart" title="2012-09-07">7 September 2012</abbr>
</p>
<p class="description">9 amazing speakers apply themselves to playing with the Future of&nbsp;Design.</p>
</li>
</ul>

</div> <!-- /group -->

<div class="group">
<h3>Design products</h3>

<ul>
<li class="thing">
<img src="/i/books/webaccessibility.png" alt="" />
<h5><a href="http://siverbackapp.com/">Silverback</a></h5>
<p class="meta">Guerilla usability testing software for designers and&nbsp;developers.</p>
</li>

<li class="thing">
<img src="/i/books/html5.png" alt="" />
<h5><a href="http://fontdeck.com">Fontdeck</a></h5>
<p class="meta">The professional webfont solution bringing great typography to the&nbsp;web.</cite></p>
</li>
</ul>
</div> <!-- /group -->


</div> <!-- /things -->



</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
