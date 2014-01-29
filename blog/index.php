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
<html lang="en-gb">

<head>
<?php include($dr . "head.inc.php"); ?>

    <title><?php echo $post_headtitle[$blog_id] . " | Clagnut"; ?></title>
    
    <meta name="description" content="<?php echo $post_description[$blog_id] ?>" />
    <meta name="keywords" content="<?php echo implode(',', $post_tags[$blog_id]) ?>" />
    <meta name="author" content="Richard Rutter" /> 
    
</head>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main class="post">

<article class="post">

<header>

<h1><?php echo $post_title[$blog_id] ?></h1>

<div class="meta">
<p class="published"><time datetime="<?php echo $post_isodate[$blog_id] ?>"><?php echo $post_postdate[$blog_id] ?></time></p>
<p class="categories">§<?php echo $post_categories[$blog_id] ?></p>

<nav>
<?php if ($post_recent[$blog_id]) { ?>
<a href="/blog/<?php echo $post_recent[$blog_id] ?>/" rel="next" title="Newer: ‟<?php echo $post_recenttitle[$blog_id] ?>”">&lsaquo;</a><?php } ?><?php if ($post_older[$blog_id]) { ?>
<a href="/blog/<?php echo $post_older[$blog_id] ?>/" rel="prev" title="Older: ‟<?php echo $post_oldertitle[$blog_id] ?>”">&rsaquo;</a>
<?php } ?>

</nav>
</div>
</header>

<section>
<?php
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
$maincontent = preg_replace($search, $replace, $post_maincontent[$blog_id]);
#$maincontent = $post_maincontent[$blog_id];
echo stripslashes($maincontent);
?>
</section>




<aside class="gallery group">
	<?php		
	getFlickr();
	if (isset($flickr)) {
		echo stripslashes($flickr);
	}
	?>
</aside>


<aside class="tags group">
	<p class="comment"><a href="https://twitter.com/intent/tweet?text=<?php echo $post_headtitle[$blog_id] ?> by @clagnut http://clagnut.com/blog/<?php echo $blog_id ?>"><img src="/i/icon-twitter.png" alt="" class="icon"> Comment via Twitter</a></p>
	
	<ul>
	<?php
	if (count($post_tags[$blog_id])>0) {
		foreach($post_tags[$blog_id] AS $tag) {
			echo "<li>#<a href='/search/?q=" . urlencode($tag) . "' rel='tag'>" . htmlentities($tag) . "</a></li>\n";
		}
	}
	if (count($post_machinetags[$blog_id])>0) {
		foreach($post_machinetags[$blog_id] AS $machinetag) {
			echo "<li class='machine-tag'><a href='/search?q=" . urlencode($machinetag) . "' rel='tag'>" . htmlentities($machinetag) . "</a></li>\n";
		}
	}
	?>
	</ul>
	
</aside>

<aside class="cluster relatedposts group">
	<h2><span>Possibly Related</span></h2>
	
		<?php echo stripslashes($post_related_posts[$blog_id]) ?>

</aside>

</article>


</main>

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
