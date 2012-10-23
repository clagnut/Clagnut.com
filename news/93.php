<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);

$title= "UX London | Clearleft &middot; News";
include($dr . "head.inc.php");
?>

<body class="section-news">
<?php include($dr . "header.inc.php");?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/news/">What we&#8217;ve been up to recently</a></p>
    <ul class="pagination">
        <li><a rel="prev" href="/news/92" title="dConstruct 2012">dConstruct 2012</a></li>
        <li><a rel="next" href="/news/94" title="Ampersand 2012 sold out!">Ampersand 2012 sold out!</a></li>
    </ul>
</nav>

<h1>UX London</h1>

<p>We had a fantastic time at this year&#8217;s UX London.  We&#8217;d like to thank our brilliant speakers, super sponsors, and &ndash; of course &ndash; tip top attendees, who seemed to thoroughly enjoy themselves.  If you were able to join us, we hope you came away with plenty of UX inspiration&#8230; which looks to be the case having seen some delegates&#8217; blog posts and sketchnotes, like <a href="http://www.flickr.com/photos/25896906@N06/sets/72157629865406695/">these</a> by Michele Ide-Smith at RedGate Software (we love seeing attendees&#8217; posts about the event, so please send yours on to us!).  Also, we&#8217;re posting the speakers&#8217; slides as we receive them, so you can check those out on the <a href="http://2012.uxlondon.com/">UX London site</a>.
</p>


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
