<?php
date_default_timezone_set("Europe/London");
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

include_once($dr . "path_to_db.inc.php");
include($dr2 . "/db_connect.php");

// get variables from query
$themonth = (isset($_REQUEST["themonth"]))?$_REQUEST["themonth"]:FALSE; 
$theyear = (isset($_REQUEST["theyear"]))?$_REQUEST["theyear"]:FALSE; 
$category_id = (isset($_REQUEST["category_id"]))?$_REQUEST["category_id"]:FALSE; 
$filename = (isset($_REQUEST["filename"]))?$_REQUEST["filename"]:FALSE;
$page = (isset($_REQUEST["page"]))?$_REQUEST["page"]:1;

$themonth = (preg_match("/[0-9]+/", $themonth))?$themonth:FALSE;
$theyear = (preg_match("/[0-9]+/", $theyear))?$theyear:FALSE;
$category_id = (preg_match("/[0-9]+/", $category_id))?$category_id:FALSE;
$filename = (preg_match("/[a-z_]+/", $filename))?$filename:FALSE;
$page = (preg_match("/[0-9]+/", $page))?$page:1;

// format function
include($dr . "format.php");

// get category_id
if ($filename) {
	$sql = "SELECT category_id FROM categorys WHERE filename='$filename'";
	$result = mysqli_query($db, $sql);
	if ($mycategory = mysqli_fetch_array($result)) {
		$category_id = $mycategory["category_id"];
	}	
}

// check if category_id exists
$category_filter = false;
if (preg_match("/[0-9]+/",$category_id)) {
	$category_filter = true;
}

// pull category list from db and stick into an array
$sql = "SELECT categorys_blogs.category_id as category_id, category, categorys.filename as filename, count(  *  )  AS num FROM blogs, categorys_blogs, categorys WHERE blogs.content_type =  'blog' AND blogs.blog_id = categorys_blogs.blog_id AND categorys_blogs.category_id = categorys.category_id GROUP  BY 1 ORDER  BY category ASC ";
$result = mysqli_query($db, $sql);
if ($mycategory = mysqli_fetch_array($result)) {
	do {
		$id = $mycategory["category_id"];
		$category = htmlentities($mycategory["category"]);
		$filename = $mycategory["filename"];
		$num = $mycategory["num"];
		$categorys[$id] = $category;
		$filenames[$id] = $filename;
		$numentries[$id] = $num;
	} while ($mycategory = mysqli_fetch_array($result));
	
	$category = ($category_id)?$categorys[$category_id]:NULL;
}
if (!isset($category) && $category_filter) {$category = "Unknown category";}

// Check month & year exist and are valid, else set to today
$monthtext = "";
if($theyear && $themonth) {
	if (!preg_match("/[1-2][0-9][0-9][0-9]/",$theyear)) {$theyear = date("Y");}
	if (!preg_match("/[0-1][0-9]/",$themonth)) {$themonth = date("m");}
	$thedate = mktime(23,59,59,$themonth,1,$theyear);
	$themonth = date("m",$thedate);
	$theyear = date("Y",$thedate);
	$monthtext=date("F",$thedate);
}

// offset for pagination
$postsperpage = 20;
$offset = ($page * $postsperpage) - $postsperpage;
$next = $page + 1;
$prev = $page - 1;

function displayTitle($category, $monthtext, $theyear) {
	if ($category) {
		return $category . " <span>blog&nbsp;posts</span>";
	}
	if ($monthtext && $theyear) {
		return $monthtext." ".$theyear . " <span>blog&nbsp;posts</span>";
	}
	return "Blog Archive";
	
}

// pull blogs from database

if ($category_filter) {
	// query for category filter
	$sql = "SELECT blogs.blog_id, title, description, maincontent, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs, categorys_blogs WHERE blogs.blog_id = categorys_blogs.blog_id AND categorys_blogs.category_id = $category_id AND blogdate < NOW() AND content_type='blog' ORDER by blogdate DESC";
} else if ($themonth && $theyear) {
	// query for date filter
	$sql = "SELECT blog_id, title, description, maincontent, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs WHERE YEAR(blogdate)=$theyear AND MONTH(blogdate)=$themonth AND blogdate < NOW() AND content_type='blog' ORDER by blogdate ASC";
} else {
	// query for most recent posts
	$sql = "SELECT blog_id, title, description, maincontent, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs WHERE blogdate < NOW() AND content_type='blog' ORDER by blogdate DESC LIMIT 20 OFFSET $offset";
}

$result = mysqli_query($db, $sql);
// stick all posts into an array

if ($myblog = mysqli_fetch_array($result)) {
	do {
		$postdate = $myblog["postdate"];
		$maincontent = stripslashes($myblog["maincontent"]);
		$description = stripslashes($myblog["description"]);
		$title = format(stripslashes($myblog["title"]));
		$title = str_replace(array("<p>","</p>"),array("",""),$title);		
		$id = $myblog["blog_id"];
		$post_postdate[$id] = $postdate;
		$post_isodate[$id] = $postdate;
		$post_title[$id] = $title;
		$post_description[$id] = makeDescription($maincontent,$description);
	} while ($myblog = mysqli_fetch_array($result));
}
?>

<!DOCTYPE html>
<html lang="en-gb">

<head>
<?php include($dr . "head.inc.php"); ?>

    <title><?php echo strip_tags(displayTitle($category, $monthtext, $theyear)); ?> | Clagnut by Richard Rutter</title>
    
    <meta name="description" content="<?php echo strip_tags(displayTitle($category, $monthtext, $theyear)) ?>" />
    <meta name="author" content="Richard Rutter" /> 
    
</head>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main class="archive">

<article class="post">

<header>

<h1><?php echo displayTitle($category, $monthtext, $theyear)?></h1>

</header>


<section>
<div class="listing">

<?php
if (isset($post_postdate)) {
	echo "<ul class='articles' role='list'>\n";
	# Print individual post title and descriptions
	foreach($post_postdate AS $blogpostid => $date) {
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
} else {
	if ($category_filter) {
		echo "<p>I haven&#8217;t posted any blog entries in this category.</p>";
	} else if ($themonth && $theyear) {
		echo "<p>I didn&#8217;t post any blog entries during this month.</p>";
	} else {
		echo "<p>No blog entries found on this page.</p>";
	}
}

if(!$category_filter AND !$themonth) {

	echo "<nav class='pagination'>";
	if ($next>2) {
		echo "<h5 class='newer'><a href='/archive/$prev'>Newer posts</a></h5>";
	} else echo "<div></div>";
	if (isset($post_postdate) && count($post_postdate) >= $postsperpage) {
		echo "<h5 class='older'><a href='/archive/$next'>Older posts</a></h5>";
	} else echo "<div></div>";
	echo "</nav>";

}
?> 

</div>	

<aside class="categorylist">

	<h2>Categories</h2>
	<ul role='list'>
	<?php
	# list categories
	foreach ($categorys AS $id => $cat) {
		if ($id == $category_id) {
			echo "<li>$cat &middot; $numentries[$id]</li>";
		} else {
			echo "<li><a href='/archive/$filenames[$id]/'>$cat</a> &middot; $numentries[$id]</li>";
		}
	}
	?>
	</ul>

</aside>

</section>

</main>

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
