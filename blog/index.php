<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:false; 

if(!$id) {
	Header("Location: /archive/");
	// Header("Location: /blog/index.php?id=1484");
}

$blog_id = $id;

include_once($dr . "path_to_db.inc.php");
			
// format post
include_once($dr . "format.php");

// get posts and comments
include_once($dr . "getposts.inc.php");

// get 3rd party data
include_once($dr . "thirdparties.inc.php");


getpost($blog_id);

?>

<!DOCTYPE html>
<html lang="en-GB">

<head>
<?php include($dr . "head.inc.php"); ?>

    <title><?php echo $post_headtitle[$blog_id] . " | Clagnut by Richard Rutter"; ?></title>
    
    <meta name="description" content="<?php echo $post_description[$blog_id] ?>" />
    <meta name="keywords" content="<?php echo implode(',', $post_tags[$blog_id]) ?>" />
    <meta name="author" content="Richard Rutter" />  
    
    <!-- Twitter Card -->
    <?php
    $twittercard = "summary_large_image";
	if(isset($post_socialimage_url) && $post_socialimage_url[$blog_id] != "") {
		$socialimage_url = $post_socialimage_url[$blog_id];
		$socialimage_alt = $post_socialimage_alt[$blog_id];
	} else {
		if(isset($post_mainimage_url) && $post_mainimage_url[$blog_id] != "") {
			$socialimage_url = $post_mainimage_url[$blog_id];
			$socialimage_alt = $post_mainimage_alt[$blog_id];
		} else {
			$socialimage_url = "https://ampersand.s3.amazonaws.com/rr-twittercard.jpg";
			$socialimage_alt = "Photo of the author, Richard Rutter";
			$twittercard = "summary";
		}
	}
	?>	
	
    <meta name="twitter:card" content="<?php echo $twittercard ?>" />
    <meta name="twitter:site" content="@clagnut" />
    <meta name="twitter:title" content="<?php echo $post_headtitle[$blog_id] ?>" />
    <meta name="twitter:description" content="<?php echo $post_description[$blog_id] ?>" />
	<meta name="twitter:image" content="<?php echo $socialimage_url ?>" />
	<meta name="twitter:image:alt" content="<?php echo $socialimage_alt ?>" />
    
</head>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main>

<article class="post">

<header>

<h1><?php echo $post_title[$blog_id] ?></h1>

<div class="meta">
<p class="published"><time datetime="<?php echo $post_isodate[$blog_id] ?>"><?php echo $post_postdate[$blog_id] ?></time></p>
<ul class="categories">
<?php echo trim($post_categories[$blog_id]) ?>
</ul>

</div>
</header>


<section>
<div class="prose">
<?php
/*
$word = "[A-Za-z0-9_,.;:&#']+";
$search = array(
	"/^<p>($word) ($word) ($word)/i",
	"/^<figure(.*)<\/figure>\s*<p>($word) ($word) ($word)/i",
	"/<section>\s*<p>($word) ($word) ($word)/i",
	"/<section>\s*<figure(.*)<\/figure>\s*<p>($word) ($word) ($word)/i"
);
$replace = array(
	"<p><span class='opener'>$1 $2 $3</span>",
	"<figure$1</figure> <p><span class='opener'>$2 $3 $4</span>",
	"<section><p><span class='opener'>$1 $2 $3</span>",
	"<section><figure$1</figure> <p><span class='opener'>$2 $3 $4</span>"
);
*/
#$maincontent = preg_replace($search, $replace, $post_maincontent[$blog_id]);
#$maincontent = $post_maincontent[$blog_id];
$maincontent = $post_maincontent[$blog_id];

echo stripslashes($post_mainimage[$blog_id]);
echo stripslashes($maincontent);
?>
</div> <!-- /.prose -->
</section>


<?php		/*
getFlickr();
if (isset($flickr)) {
	echo "<aside class=\"gallery group\">";
	echo stripslashes($flickr);
	echo "</aside>";
} */
?>



<aside class="tags">	
<span class="hash">#</span>
<ul>
	<?php
	$numtags = count($post_tags[$blog_id]);
	$tagcounter = 0;
	if ($numtags>0) {
		foreach($post_tags[$blog_id] AS $tag) {
			$tagcounter++;
			echo "<li><a href='/search/?q=" . urlencode($tag) . "' rel='tag'>" . htmlentities($tag) . "</a>";
			if ($tagcounter != $numtags) {
				echo ", ";
			}
			echo "</li>\n";
		}
	}
	/*
	if (count($post_machinetags[$blog_id])>0) {
		foreach($post_machinetags[$blog_id] AS $machinetag) {
			echo "<li class='machine-tag'><a href='/search?q=" . urlencode($machinetag) . "' rel='tag'>" . htmlentities($machinetag) . "</a></li>\n";
		}
	}
	*/
	
	
	?>
</ul>
		
<p class="comment"><a href="https://twitter.com/intent/tweet?text=<?php echo $post_headtitle[$blog_id] ?> by @clagnut http://clagnut.com/blog/<?php echo $blog_id ?>"><img src="/i/icon-twitter.svg" alt="" class="icon"> Comment via Twitter</a></p>
	
</aside>




<aside class="relatedposts">
	<h2>Related Posts</h2>
	
		<?php echo stripslashes($post_related_posts[$blog_id]) ?>
	
</aside>


<aside class="next-prev">


<ul class="articles">

<?php if ($post_older[$blog_id]) { ?>
<li><h5 class="older">Previous</h5>
<article>
<h3><a href="/blog/<?php echo $post_older[$blog_id] ?>/" rel="prev" title="Older post"><?php echo $post_oldertitle[$blog_id] ?></a></h3>
<p class="date"><time datetime="<?php echo $post_olderunixdate[$blog_id] ?>"><?php echo $post_olderblogdate[$blog_id] ?></time></p>
</article></li>
<?php } else echo "<li></li>"; ?>

<?php if ($post_recent[$blog_id]) { ?>
<li><h5 class="newer">Next</h5>
<article>
<h3><a href="/blog/<?php echo $post_recent[$blog_id] ?>/" rel="next" title="Newer post"><?php echo $post_recenttitle[$blog_id] ?></a></h3>
<p class="date"><time datetime="<?php echo $post_recentunixdate[$blog_id] ?>"><?php echo $post_recentblogdate[$blog_id] ?></time></p>
</article></li>
<?php } else echo "<li></li>"; ?>
</ul>

</aside>

</article>


</main>



<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
