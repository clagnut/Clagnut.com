<?php
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
<?php
getHomeFlickr();
echo stripslashes($homeflickr);
?>
</article>


<section class="live">
	<section class="cluster twitter">
	<h2><span><a href="http://twitter.com/clagnut" rel="me"><img src="/i/icon-twitter.png" alt="Follow me on Twitter" title="@clagnut" class="icon" /></a> @clagnut</span></h2>
		 
		 
	<?php
	getTwitter();
	if (isset($twitter)) {
		echo stripslashes($twitter);
	} else {
		echo "<article><p>No tweets available. Probably a fail whale scenario.</p></article>";
	}
	?>

</section>
	<div class="ambient"> <!-- td -->
		<section class="cluster lastfm">
	<h2><span><a href="http://www.last.fm/user/clagnut" rel="me"><img src="/i/icon-lastfm.png" alt="Last.fm" title="Last.fm" class="icon" /></a> Listening</span></h2>		 
	
	<?php
	getLastfm();
	if (isset($lastfm)) {
		echo stripslashes($lastfm);
	}
	?>
	
</section>	
		<section class="cluster kennedy">
	<h2><span><a href="http://kennedyapp.com"><img src="/i/icon-kennedy.png" alt="Kennedy App" title="Kennedy App" class="icon" /></a> A Moment</span></h2>		 
		 	

	<article>
		<?php		
		# Get latest moment from Kennedy
		include($dr3 . "/kennedy/moments.php");
		
		$moments = getMoments($dr3);
		if(is_array($moments) && count($moments)>0) {
			$moment = $moments[0];
			echo formatMoment($moment);
		} else {
			echo "<p>No moments available.</p>";
		}
		?>
	</article>
	
</section>	
		<section class="cluster thisismyjam">
	<h2><span><a href="https://www.thisismyjam.com/clagnut"><img src="/i/icon-jam.png" alt="ThisIsMyJam" title="ThisIsMyJam" class="icon" rel="me" /></a> Current Jam</span></h2>		 
		 
	<article>
	<script src="http://www.thisismyjam.com/includes/js/medallion.js"></script>
	<script>Jam.Medallion.insert({"username":"clagnut","imageSize":"medium"});</script>
	</article>	
	
</section>	
	</div>
	<div class="mylatest">
		<section class="cluster latestposts">
	<h2><span>Latest Posts</span></h2>
	<ul class='articles'>
	<?php
	
	foreach ($blogpostids AS $key => $blogpostid) {
		if ($key > 0 && $key < count($blogpostids)) {
			getpost($blogpostid);
			echo "<li><article>\n";
			echo "	<p class=\"date\">\n";
			echo "		<time datetime=\"" . $post_isodate[$blogpostid] . " \">" . $post_postdate[$blogpostid] . " </time>\n";
			echo "	</p>\n";
			echo "	<h1><a href=\"/blog/" . $blogpostid . "/\" rel=\"bookmark\">" . $post_title[$blogpostid] . " </a></h1>\n";
			echo "	<p class=\"categories\">" . $post_categories[$blogpostid] . " </p>\n";
			echo "</article></li>\n";
		}
	}
	?>
	</ul>

</section>
		<section class="gallery cluster latestphotos">
	<h2><span><a href="http://flickr.com/photos/clagnut" rel="me"><img src="/i/icon-flickr" alt="Flickr" title="Flickr" class="icon" /></a> Latest Photos</span></h2>
	
	<?php
	getlatestFlickr();
	if (isset($latestflickr)) {
		echo stripslashes($latestflickr);
	}
	?>
</section>
	</div>
</section>

</main>

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
