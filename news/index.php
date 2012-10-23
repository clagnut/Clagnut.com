<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$page = pagination($data['case_studies']);

$title= "News | Clearleft &middot; User Experience Consultants";
include($dr . "head.inc.php");
?>

<body class="section-news">
<?php include($dr . "header.inc.php"); ?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/news/">What we&#8217;ve been up to recently</a></p>
    <ul class="pagination">
        <li><a rel="prev" href="/news/92" title="dConstruct 2012">dConstruct 2012</a></li>
        <li><a rel="next" href="/news/94" title="Ampersand 2012 sold out!">Ampersand 2012 sold out!</a></li>
    </ul>
</nav>

<h1>This is the news</h1>

<p><a href="http://feeds.feedburner.com/clearleftnews" rel="alternate" type="application/rss+xml" title="RSS Feed"><img src="/i/icons/feed-16x16.png" alt="" style="vertical-align:middle" /> RSS Feed</a></p>




</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
