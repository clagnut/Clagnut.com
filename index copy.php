<?php
// Turn on PHP Error Reporting
 ini_set("display_errors","2");
 ERROR_REPORTING(E_ALL);


$dr = $_SERVER["DOCUMENT_ROOT"];
include_once($dr . "/includes/path_to_db.inc.php");
			
// format post
include_once($dr . "/includes/format.php");

// get posts and comments
include_once($dr . "/includes/getposts.inc.php");

// get 3rd party data
include_once($dr . "/includes/thirdparties.inc.php");

// get content for home page
gethomecontent();
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Clagnut is Richard Rutter</title>

<link rel="openid.server" href="http://www.myopenid.com/server" />
<link rel="openid.delegate" href="http://clagnut.myopenid.com/" />
<link rel="openid2.provider" href="http://www.myopenid.com/server" />
<link rel="openid2.local_id" href="http://clagnut.myopenid.com/" />
<meta name="verify-v1" content="IJz7pHnlmNG5vpLqcQlYqEKpcrz4tPaMqM+w2eTM5XE=" />

<?php
include($dr . "/includes/headlinks.inc.php");
include($dr . "/includes/rsslinks.inc");
?>

<meta name="author" content="Richard Rutter" /> 
<meta name="copyright" content="All Copyright Richard Rutter" />
<meta name="description" content="Web design and development information and links; an online journal, blog if you insist, of Richard Rutter." />
<meta name="keywords" content="richard, rutter, web, site, design, development, build, producer, information, architect, html, css, multimap, ukbloggers, jalfrezi, cuzza, htmlbyexample, pompeii, interactive, canis, education, w3c, citria, Brighton, Kemp Town" />
<meta name="dmoz.id" content="Computers/Internet/On_the_Web/Weblogs/Personal/C" />

<link rel="meta" type="application/rdf+xml" title="FOAF" href="foaf.rdf" />

<meta name="geo.position" content="50.8182;-0.1152" />
<meta name="geo.region" content="GB-BNH" />
<meta name="geo.placename" content="Brighton" />
<meta name="geo.country" content="GB" />

</head>
<body id="home">

<div id="header">
<div class="wrapper">

	<div class="primary">
	<p><strong>This is the online home of Richard Rutter</strong>, a website designer. 
Here he writes about information architecture, accessibility, design, Brighton, music and occasionally mountain biking. </p>
	</div> <!-- /primary-->
	
	<div class="secondary promo">
	<?php /*
	<a href="http://uxlondon.com/"><img src="/images/uxlondon-81.png" alt="User experience conference and workshops" /></a>
	<p><strong><a href="http://uxlondon.com/">UX London</a></strong>. Three&nbsp;days of inspirational workshops for web designers.</p>
    */
    ?>
	<a href="http://fontdeck.com/"><img src="/images/fontdeck-81.png" alt="Fontdeck" /></a>
	<p><strong><a href="http://fontdeck.com/">Real fonts for your website</a></strong>. Quality, professional typefaces reliably delivered.</p>
	</div> <!-- /secondary-->
	
	<div class="tertiary">
	<form action="/search" method="get">
	<div>
	<input type="text" id="q" name="q" class="valueprompt" title="Search" />
	<input type="submit" value="Go" id="go" />
	</div>
	</form> 
	</div> <!-- /tertiary-->
	
</div> <!-- /wrapper-->
</div> <!-- /header-->

<div id="masthead">
<div class="wrapper">

	<div class="primary">
	<h1><img src="/images/clagnut-logo-home.png" alt="Clagnut" /></h1>
	<p>Published in Brighton, UK</p>
	</div> <!-- /primary-->

</div> <!-- /wrapper-->
</div> <!-- /masthead-->

<div id="content" class="wrapper">
	<div class="hfeed">
	<div class="primary hentry">
		<?php getpost($blogpostids[0]); ?>
		
		<h1 class="entry-title"><a href="/blog/<?php echo $blogpostids[0] ?>/" rel="bookmark"><?php echo $post_title[$blogpostids[0]] ?></a></h1>
		
		<div class="meta">
		<p class="published"><abbr title="<?php echo $post_isodate[$blogpostids[0]] ?>"><?php echo $post_postdate[$blogpostids[0]] ?></abbr></p>
		<p class="comments"><a href="/blog/<?php echo $blogpostids[0] ?>/#comments" rel="bookmark"><?php echo $post_numcomments[$blogpostids[0]] . " comment"; echo plural($post_numcomments[$blogpostids[0]]);?></a></p>
		</div>
		
		<div class="entry-content">	
		<div class="segment">
		<?php
		$maincontent = stripslashes($post_maincontent[$blogpostids[0]]);
		$maincontent = trim(preg_replace("/<p class='imgholder inline'>.*<\/p>/", "", $maincontent)); // remove all inline images
		$maincontent = trim(preg_replace("/<p class='imgholder'>.*<\/p>/", "", $maincontent)); // remove all other images
		$maincontent = preg_replace("/^<p>/", "<p><span class='para'>&para; </span>", $maincontent); // stick in an opening pilcrow
		echo $maincontent;
		?>
		<p class="more"><a href="/blog/<?php echo $blogpostids[0] ?>/">more</a></p>
		</div>
	
		</div>  <!-- /.entry-content -->
	
	</div> <!-- /primary hentry-->
	
	<div class="secondary">
		<div class="imgholder">
		<?php
		getHomeFlickr();
		echo stripslashes($homeflickr);
		?>
		</div>
		
		
		<?php
		
		foreach ($blogpostids AS $key => $blogpostid) {
			if ($key > 0 && $key < count($blogpostids)-1) {
				getpost($blogpostid);
				echo "<div class=\"hentry\">\n";
				echo "	<h2 class=\"entry-title\"><a href=\"/blog/" . $blogpostid . "/\" rel=\"bookmark\">" . $post_title[$blogpostid] . " </a></h2>\n";
				echo "	<p class=\"meta\">\n";
				echo "		<span class=\"published\"><abbr title=\"" . $post_isodate[$blogpostid] . " \">" . $post_postdate[$blogpostid] . " </abbr></span>\n";
				echo "		<span class=\"comments\"><a href=\"/blog/" . $blogpostid . "/#comments\">" . $post_numcomments[$blogpostid] . " comment";
				echo plural($post_numcomments[$blogpostid]);
				echo "</a></span>\n";
				echo "	</p>\n";
				echo "	<div class=\"entry-summary\">\n";
				echo "	<p>" . $post_description[$blogpostid] . " </p>\n";
				echo "	<p class=\"more\"><a href=\"/blog/$blogpostid/\">more</a></p>\n";
				echo "	</div>  <!-- /.entry-summary -->\n";
				echo "</div> <!-- /hentry-->\n";
			}
		}
		?>
		
		
	</div> <!-- /secondary-->
	</div> <!-- /hfeed-->
	
	<div class="tertiary">
	
	<div class="hfeed">
		
	<h2>Ruminations <a href="http://twitter.com/clagnut" rel="me"><img src="/images/twitter.gif" alt="Twitter" title="Twitter" /></a></h2>
	
	<?php
	getTwitter();
	echo stripslashes($twitter);
	?>
	</div> <!-- /hfeed -->
	
	<h2>Current listening <a href="http://www.last.fm/user/clagnut" rel="me"><img src="/images/lastfm.gif" alt="Last.fm" title="Last.fm" /></a></h2>
	
	<?php
	getLastfm();
	echo stripslashes($lastfm);
	?>
	
	<h2>Blogmarks <a href="/blogmarks/"><img src="/images/more.png" title="more blogmarks" alt="more blogmarks" class="more" /></a></h2>
	<?php
	echo $blogmarks;
	?>
	
	</div> <!-- /tertiary-->

</div> <!-- /content-->

<div id="appendix" class="wrapper">

	<div class="primary">
		<h2>One year ago in the Blog</h2>
		<?php
		$yearagoid = $blogpostids[count($blogpostids)-1];
		if ($yearagoid > 0) {
			getpost($yearagoid);
		?>
		<div class="hentry">
			<h2 class="entry-title"><a href="/blog/<?php echo $yearagoid ?>/" rel="bookmark"><?php echo $post_title[$yearagoid] ?></a></h2>
			
			<p class="meta">
				<span class="published"><abbr title="<?php echo $post_isodate[$yearagoid] ?>"><?php echo $post_postdate[$yearagoid] ?></abbr></span>
				<span class="comments"><a href="/blog/<?php echo $blogpostids[4] ?>/#comments"><?php echo $post_numcomments[$yearagoid] . " comment"; echo plural($post_numcomments[$yearagoid]);?></a></span>
			</p>
			
			<div class="entry-summary">
			<p><?php echo $post_description[$yearagoid] ?></p>
			<p class="more"><a href="/blog/">more</a></p>
			</div>  <!-- /.entry-summary -->
		</div> <!-- /hentry-->	
		<?php
		} else {
		?>
		<p>Nothing was posted this time last year. Have a browse of the <a href="/archive/">Blog archive</a> instead.</p>
		<?php
		}
		?>
	</div> <!-- /primary -->
	
	<div class="secondary">
		<div class="sub1">
		<h2>Latest photos <a href="http://flickr.com/photos/clagnut/" rel="me"><img src="/images/flickr.gif" alt="Flickr" title="My photostream on Flickr" /></a></h2>
		<?php
		getlatestFlickr();
		echo $latestflickr;
		?>
		</div>
		
		<div class="sub2">
		<h2>I wrote some books</h2>
		<ul class="books">
			<li>
				<a href="http://www.amazon.co.uk/exec/obidos/ASIN/1590596382/jalfrezi-21/"><img src="/images/accessibility-book.png" alt="Book cover" />Web Accessibility</a>
			</li>
			<li>
				<a href="http://www.amazon.co.uk/exec/obidos/ASIN/1590595815/jalfrezi-21/"><img src="/images/blog-design-book.png" alt="Book cover" />Blog Design Solutions</a>
			</li>
		</ul>
		
		<?php // <p class="more"><a href="/about/books/">more books</a></p> ?>
		</div>
	</div> <!-- /secondary-->
	
	
	<div class="tertiary">
		<h2>Music purchases <a href="/music/"><img src="/images/more.png" title="more bought music" alt="more bought music" class="more" /></a></h2>
		<?php
			echo $latestmusic;
		?>
	</div> <!-- /tertiary-->

</div> <!-- /appendix-->

<?php include($dr . "/includes/footer.inc.php"); ?>

</body>
</html>
