<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// format function
include($dr . "/includes/format.php");
include($dr . "/includes/cms_writerssfiles.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Publish RSS feeds</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
?>
</div>
<div id="screen">
<h2>Publish RSS feeds</h2>
<?php
echo "<p>".writefullrss()."</p>";
echo "<p>".writesummariesrss()."</p>";
echo "<p>".writeblogmarkrss()."</p>";
?>

<ul>
	<li><a href="/feeds/fullposts.xml">Full posts feed</a> [<a href="http://feedvalidator.org/check.cgi?url=http://clagnut.com/feeds/fullposts.xml">validate</a>]</li>
	<li><a href="/feeds/summaries.xml">Summaries feed</a> [<a href="http://feedvalidator.org/check.cgi?url=http://clagnut.com/feeds/summaries.xml">validate</a>]</li>
	<li><a href="/feeds/blogmarks.xml">Blogmarks feed</a> [<a href="http://feedvalidator.org/check.cgi?url=http://clagnut.com/feeds/blogmarks.xml">validate</a>]</li>
</ul>

</div>
</body>
</html>
