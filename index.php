<?php
date_default_timezone_set("Europe/London");
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
$dr3 = str_replace("/includes/", "", $dr);

include_once($dr . "php_errors.inc.php");

include_once($dr . "path_to_db.inc.php");
			
// format post
include_once($dr . "format.php");

// get posts and comments
include_once($dr . "getposts.inc.php");

// get 3rd party data
include_once($dr . "thirdparties.inc.php");

// get content for home page
gethomecontent();

?>

<!DOCTYPE html>
<html lang="en-gb">

<head>
<?php include($dr . "head.inc.php"); ?>

<title>Clagnut by Richard Rutter</title>

<meta name="description" content="The online home and blog of Richard Rutter, cofounder of Clearleft and Fontdeck. Here he writes about web typography, human-centred design, Brighton, music and occasionally mountain biking. " />
<meta name="author" content="Richard Rutter" /> 

<!-- Twitter Card -->

<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@clagnut" />
<meta name="twitter:title" content="Clagnut by Richard Rutter" />
<meta name="twitter:description" content="The online home and blog of Richard Rutter, cofounder of Clearleft and Fontdeck. Here he writes about web typography, human-centred design, Brighton, music and cycling." />
<meta name="twitter:image" content="https://ampersand.s3.amazonaws.com/rr-twittercard.jpg" />

</head>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main class="home archive">

<article class="post">

<header>

<div class="hgroup">
<h2>An enthusiasm by</h2>
<h1>Richard Rutter</h1>
</div>

<div class="introblock">
<p><strong>Hello. I’m Richard, a designer, <a href="http://book.webtypography.net/">author</a> and <a href="/speaking">speaker</a> living by the sea in Brighton, UK. I’m co-founder of <a href="https://clearleft.com/">Clearleft</a>, a digital design consultancy.</strong></p>
<p>I love all things to do with human-centred design, typography, music and cycling. I occasionally write about them here.</p>
</div>

</header>


<section>
<div class="listing">

<h2 class="home-latest-posts">Latest Posts</h2>

<?php
if (isset($blogpostids)) {
	echo "<ul class='articles'>\n";
	# Print individual post title and descriptions
	foreach ($blogpostids AS $key => $blogpostid) {
		getpost($blogpostid);
		echo "<li><article>\n";
		echo "	<h3><a href=\"/blog/" . $blogpostid . "/\" rel=\"bookmark\">" . $post_title[$blogpostid] . " </a></h3>\n";
		
		$description = format($post_description[$blogpostid]);
		$description = str_replace(array("<p>","</p>"),array("",""),$description);
		
		echo "	<p class=\"summary\">" . $description . " </p>\n";
		echo "	<p class=\"date\">\n";
		echo "		<time datetime=\"" . $post_isodate[$blogpostid] . " \">" . $post_postdate[$blogpostid] . " </time>\n";
		echo "	</p>\n";
		echo "</article></li>\n";
	}
	echo "</ul>";
}
?> 

<nav class="pagination"><div></div><h5 class="older"><a href="/archive/">All posts</a></h5></nav>

</div>	

<aside class="categorylist">

<div class="elsewhere social">
<h3>Me Elsewhere</h3>
<ul>
<li><a href="https://twitter.com/clagnut" class="icon" rel="me"><img src="/i/icon-twitter.svg" alt="twitter"></a> <a href="https://twitter.com/clagnut" rel="me">Twitter</a></li>
    <li><a href="https://flickr.com/photos/clagnut" class="icon" rel="me"><img src="/i/icon-flickr.svg" alt="flickr"></a> <a href="https://flickr.com/photos/clagnut" rel="me">Flickr</a></li>
    <li><a href="https://github.com/clagnut" class="icon" rel="me"><img src="/i/icon-github.svg" alt="github"></a> <a href="https://github.com/clagnut" rel="me">Github</a></li>
    <li><a href="https://strava.com/athletes/clagnut" class="icon" rel="me"><img src="/i/icon-strava.svg" alt="strava"></a> <a href="https://strava.com/athletes/clagnut" rel="me">Strava</a></li>
	<li><a href="https://linkedin.com/in/richardrutter" class="icon" rel="me"><img src="/i/icon-linkedin.svg" alt="linkedin"></a> <a href="https://linkedin.com/in/richardrutter" rel="me">LinkedIn</a></li>
</ul>
</div>

<div class="elsewhere lastfm">
<h3>Latest listening</h3>

<?php
getLastfm();
if (isset($lastfm)) {
	echo stripslashes($lastfm);
}
?>

<ul>
    <li><a href="http://last.fm/user/clagnut" class="icon" rel="me"><img src="/i/icon-lastfm.svg" alt="lastfm"></a> <a href="http://last.fm/user/clagnut" rel="me">Last.fm</a></li>
</ul>
</div>

</aside>

</section>

</article>

</main>

<?php include($dr . "footer.inc.php"); ?>

</body>
</html>
