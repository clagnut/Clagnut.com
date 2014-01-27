<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
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
    
	<meta name="description" content="The online home and blog of Richard Rutter, cofounder of Clearleft and Fontdeck. Here he writes about web typography, user experience design, Brighton, music and occasionally mountain biking. " />
	<meta name="author" content="Richard Rutter" /> 
    
    <link rel="openid.server" href="http://www.myopenid.com/server" />
    <link rel="openid.delegate" href="http://clagnut.myopenid.com/" />
    <link rel="openid2.provider" href="http://www.myopenid.com/server" />
    <link rel="openid2.local_id" href="http://clagnut.myopenid.com/" />
    <meta name="verify-v1" content="IJz7pHnlmNG5vpLqcQlYqEKpcrz4tPaMqM+w2eTM5XE=" />
    
</head>


<body>
<?php 
include($dr . "header.inc.php");
?>

<main class="home">

<header>

<h2>An enthusiasm by</h2>
<h1>Richard Rutter</h1>

</header>

<article class="newestpost">
<?php getpost($blogpostids[0]); ?>
<p class="date"><time datetime="<?php echo $post_isodate[$blogpostids[0]] ?>"><?php echo $post_postdate[$blogpostids[0]] ?></time></p>
<h1><a href="/blog/<?php echo $blogpostids[0] ?>/" rel="bookmark"><?php echo $post_title[$blogpostids[0]] ?></a></h1>
<p><?php echo stripslashes($post_description[$blogpostids[0]]) ?></p>

<p class="more"><a href="/blog/<?php echo $blogpostids[0] ?>/">Read on</a> &rarr;</p>
</article>


<article class="favephoto">
<figure class="photo"><a href="http://flickr.com/photos/clagnut/17802430/"><img src="/i/flickr/f/1.jpg" alt=""></a><figcaption>Sea flooding into Ohso Social</figcaption></figure>

<?php
getHomeFlickr();
#echo stripslashes($homeflickr);
?>
</article>

<br style="clear:both"/>

<section class="live">

<section class="cluster twitter">
	<h2><span><a href="http://twitter.com/clagnut" rel="me"><img src="/i/icon-twitter.png" alt="Follow me on Twitter" title="@clagnut" class="icon" /></a> @clagnut</span></h2>
		 
		 
	<article>
	<time><a href="#">7h ago</a></time>
	<p>“Mid Century Modern Nightmare” by Neon Neon is my new jam. Listen: http://t.thisismyjam.com/clagnut/_7lt3m6t …</p>
	</article>
	
	<article>
	<time><a href="#">8h ago</a></time>
	<p>Wondering if @SimonKirbyMP has an opinion about why http://www.care-data.info/  means parts of our medical records are being sold off?</p>
	</article>
	
	<article>
	<time><a href="#">8h ago</a></time>
	<p>For info about care.data and how to opt out (it's easy) see: http://care-data.info  everyone's right to #privacy</p>
	</article>
	
	<article>
	<time><a href="#">Jan 19</a></time>
	<p>They're not just about the theme to The Bridge. http://t.thisismyjam.com/clagnut/_7llzxtx … (via @Wordridden)</p>
	</article>
	
	<article>
	<time><a href="#">Jan 17</a></time>
	<p>Surprise surprise, it's muddy out there #mtb pic.twitter.com/zC1CTrbodW</p>
	</article>
	
	<article>
	<time><a href="#">Jan 17</a></time>
	<p>Changing my Strava default sport from running to cycling http://www.strava.com/athletes/975083</p>
	</article>
	
	<article>
	<time><a href="#">Jan 17</a></time>
	<p>Changing my Strava default sport from running to cycling #strava</p>
	</article>
	
	<article>
	<time><a href="#">8h ago</a></time>
	<p>For info about care.data and how to opt out (it's easy) see: http://care-data.info  everyone's right to #privacy</p>
	</article>
	
	<article>
	<time><a href="#">Jan 19</a></time>
	<p>They're not just about the theme to The Bridge. http://t.thisismyjam.com/clagnut/_7llzxtx … (via @Wordridden)</p>
	</article>
</section>

<section class="cluster lastfm">
	<h2><span><a href="http://www.last.fm/user/clagnut" rel="me"><img src="/i/icon-lastfm.png" alt="Last.fm" title="Last.fm" class="icon" /></a> Listening</span></h2>		 
		 
	<article>
	<p><a href="http://www.last.fm/music/Courtney+Barnett/_/Avant+Gardener"><img src="/i/92461921.png" alt="The Double EP: A Sea of Split Peas" class="album_cover" /> Ticker-tape of the Unconscious</a> by <cite>Stereolab</cite></p>
	</article>	 
		 
	<article>
	<p><a href="http://www.last.fm/music/Courtney+Barnett/_/Avant+Gardener"><img src="/i/92461921.png" alt="The Double EP: A Sea of Split Peas" class="album_cover" /> Avant Gardener</a> by <cite>Courtney Barnett In The House</cite></p>
	</article> 
		 
	<article>
	<p><a href="http://www.last.fm/music/Courtney+Barnett/_/Avant+Gardener"><img src="/i/92461921.png" alt="The Double EP: A Sea of Split Peas" class="album_cover" /> Ticker-tape of the Unconscious</a> by <cite>Stereolab</cite></p>
	</article>	 
		 
	<article>
	<p><a href="http://www.last.fm/music/Courtney+Barnett/_/Avant+Gardener"><img src="/i/92461921.png" alt="The Double EP: A Sea of Split Peas" class="album_cover" /> Avant Gardener</a> by <cite>Courtney Barnett</cite></p>
	</article>
		 
	<article>
	<p><a href="http://www.last.fm/music/Courtney+Barnett/_/Avant+Gardener"><img src="/i/92461921.png" alt="The Double EP: A Sea of Split Peas" class="album_cover" /> Avant Gardener</a> by <cite>Courtney Barnett</cite></p>
	</article>
	
</section>	

<section class="cluster kennedy">
	<h2><span><a href="http://kennedyapp.com"><img src="/i/icon-kennedy.png" alt="Kennedy App" title="Kennedy App" class="icon" /></a> A Moment</span></h2>		 
		 
	<article>
	<time>Jan 17</time>
	<p>At ten to nine on a drizzley<br/>
	Friday morning in <i>Coffee@33</i>,<br/>
	I was <strong>mulling over the end of my running, and a permanent switch back to cycling</strong><br/>
	 while listening to Four Tet's <cite>Rounds</cite>.<br/>
	 Meanwhile the news headline read <a href="http://www.bbc.co.uk/news/world-us-canada-25770317#sa-ns_mchannel=rss&ns_source=PublicRSS20-sa"><q>Obama to reveal curbs on NSA spying</q></a>.
</p>
	</article>	
	
</section>	

<section class="cluster thisismyjam">
	<h2><span><a href="https://www.thisismyjam.com/clagnut"><img src="/i/icon-jam.png" alt="ThisIsMyJam" title="ThisIsMyJam" class="icon" rel="me" /></a> Current Jam</span></h2>		 
		 
	<article>
	<script src="http://www.thisismyjam.com/includes/js/medallion.js"></script>
	<script>Jam.Medallion.insert({"username":"clagnut","imageSize":"medium"});</script>
	</article>	
	
</section>	

</section> <!-- /live -->

<section class="cluster relatedposts latestposts">
	<h2><span>Latest Posts</span></h2>
	
	<?php
	
	foreach ($blogpostids AS $key => $blogpostid) {
		if ($key > 0 && $key < count($blogpostids)) {
			getpost($blogpostid);
			echo "<article>\n";
			echo "	<p class=\"date\">\n";
			echo "		<time datetime=\"" . $post_isodate[$blogpostid] . " \">" . $post_postdate[$blogpostid] . " </time>\n";
			echo "	</p>\n";
			echo "	<h1><a href=\"/blog/" . $blogpostid . "/\" rel=\"bookmark\">" . $post_title[$blogpostid] . " </a></h1>\n";
			echo "	<p class=\"categories\">" . $post_categories[$blogpostid] . " </p>\n";
			echo "</article>\n";
		}
	}
	?>
	

</section>

<section class="gallery cluster latestphotos">
	<h2><span><a href="http://flickr.com/photos/clagnut" rel="me"><img src="/i/icon-flickr" alt="Flickr" title="Flickr" class="icon" /></a> Latest Photos</span></h2>
	<figure class="photo"><a href="http://flickr.com/photos/clagnut/17802430/"><img src="/i/flickr/m/1.jpg" alt="Crabbing"></a><figcaption>Crabbing</figcaption></figure>
	<figure class="photo"><a href="http://flickr.com/photos/clagnut/17802565/"><img src="/i/flickr/m/2.jpg" alt="Passenger ferry"></a><figcaption>Passenger ferry pulling out</figcaption></figure>
	<figure class="photo"><a href="http://flickr.com/photos/clagnut/17801254/"><img src="/i/flickr/m/3.jpg" alt="Herring gull"></a><figcaption>Herring gull</figcaption></figure>
	<figure class="photo"><a href="http://flickr.com/photos/clagnut/17800540/"><img src="/i/flickr/m/4.jpg" alt="70 Pocket Penguins"></a><figcaption>70 Pocket Penguins</figcaption></figure>	
</section>

</main>

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
