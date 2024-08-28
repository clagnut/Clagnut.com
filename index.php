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

<meta name="description" content="The online home and blog of Richard Rutter, cofounder of Clearleft and Fontdeck. Here he writes about web typography, human-centred design, Brighton, music and occasionally cycling. " />
<meta name="author" content="Richard Rutter" /> 

<!-- Twitter Card -->

<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@clagnut" />
<meta property="og:title" content="Clagnut by Richard Rutter" />
<meta property="og:description" content="The online home and blog of Richard Rutter, cofounder of Clearleft and Fontdeck. Here he writes about web typography, human-centred design, Brighton, music and occasionally cycling." />
<meta property="og:image" content="https://clagnut.com/i/rrutter.jpg" />
<meta property="og:image:alt" content="Photo of the author, a faintly smiling middle-aged white man" />

</head>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main class="home">

<div class="page">

<header>

<div class="stack center">

<h1>
<span>An enthusiasm by</span>
Richard Rutter
</h1>

<div class="stack intro">
<p><strong>Hello. I’m Richard, a designer, <a href="http://book.webtypography.net/">author</a> and <a href="/speaking">speaker</a> living by the sea in Brighton, UK. I’m co-founder of <a href="https://clearleft.com/">Clearleft</a>, a digital design consultancy.</strong></p>

<p>I love all things to do with human-centred design, typography, music and cycling. I occasionally write about them here.</p>
</div>

</div>

</header>



<div class="archive with-sidebar">

<div class="not-sidebar stack">

<h2>Latest Posts</h2>

<?php
if (isset($blogpostids)) {
	echo "<ul class='articles stack' role='list'>\n";
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

<nav class="pagination sidebyside equal"><div class="newer"><h5><a href="/archive/">All posts</a></h5></div></nav>

</div>	

<aside class="sidebar stack">

<h3>Me Elsewhere</h3>
<ul role="list">
	<li class="icon"><a href="https://twitter.com/clagnut" rel="me"><img src="/i/icon-twitter.svg" alt="twitter">Twitter</a></li>
	<li class="icon"><a href="https://mastodon.social/@Richr" rel="me"><img src="/i/icon-mastodon.svg" alt="mastodon">Mastodon</a></li>
    <li class="icon"><a href="https://flickr.com/photos/clagnut" rel="me"><img src="/i/icon-flickr.svg" alt="flickr">Flickr</a></li>
    <li class="icon"><a href="https://github.com/clagnut" rel="me"><img src="/i/icon-github.svg" alt="github">Github</a></li>
    <li class="icon"><a href="https://strava.com/athletes/clagnut" rel="me"><img src="/i/icon-strava.svg" alt="strava">Strava</a></li>
	<li class="icon"><a href="https://linkedin.com/in/richardrutter" rel="me"><img src="/i/icon-linkedin.svg" alt="linkedin">LinkedIn</a></li>
</ul>

<h3>Latest listening</h3>

<?php
getLastfm();
if (isset($lastfm)) {
	echo stripslashes($lastfm);
}
?>

<ul>
	<li class="icon"><a href="http://last.fm/user/clagnut" rel="me"><img src="/i/icon-lastfm.svg" alt="last fm">Last.fm</a></li>
</ul>
</div>

</aside>

</div>

</main>

<?php include($dr . "footer.inc.php"); ?>

</body>
</html>
