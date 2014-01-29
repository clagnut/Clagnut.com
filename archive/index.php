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

// format function
include($dr . "format.php");

// get category_id
if ($filename) {
	$sql = "SELECT category_id FROM categorys WHERE filename='$filename'";
	$result = mysql_query($sql);
	if ($mycategory = mysql_fetch_array($result)) {
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
$result = mysql_query($sql);
if ($mycategory = mysql_fetch_array($result)) {
	do {
		$id = $mycategory["category_id"];
		$category = htmlentities($mycategory["category"]);
		$filename = $mycategory["filename"];
		$num = $mycategory["num"];
		$categorys[$id] = $category;
		$filenames[$id] = $filename;
		$numentries[$id] = $num;
	} while ($mycategory = mysql_fetch_array($result));
	
	$category = ($category_id)?$categorys[$category_id]:NULL;
}
if (!isset($category) && $category_filter) {$category = "Unknown category";}

// Check month & year exist and are valid, else set to today
if (!preg_match("/[1-2][0-9][0-9][0-9]/",$theyear)) {$theyear = date("Y");}
if (!preg_match("/[0-1][0-9]/",$themonth)) {$themonth = date("m");}
$thedate = mktime(23,59,59,$themonth,1,$theyear);
$themonth = date("m",$thedate);
$theyear = date("Y",$thedate);
$monthtext=date("F",$thedate);

// pull date of first blog from database
$sql = "SELECT DATE_FORMAT(blogdate,'%e %M %Y') AS firstpostdate FROM blogs WHERE blogdate < NOW() AND content_type='blog' AND blogdate > 0 ORDER by blogdate ASC LIMIT 1";
$result = mysql_query($sql);
if ($myblog = mysql_fetch_array($result)) {
	$enddate = strtotime($myblog["firstpostdate"]);
}

function displayTitle($category, $monthtext, $theyear) {
	if ($category) {
		return $category;
	} else {
		return $monthtext." ".$theyear;
	}
}

// pull blogs from database

if ($category_filter) {
	// query for category filter
	$sql = "SELECT blogs.blog_id, title, description, maincontent, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs, categorys_blogs WHERE blogs.blog_id = categorys_blogs.blog_id AND categorys_blogs.category_id = $category_id AND blogdate < NOW() AND content_type='blog' ORDER by blogdate DESC";
} else {
	// query for date filter
	$sql = "SELECT blog_id, title, description, maincontent, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs WHERE YEAR(blogdate)=$theyear AND MONTH(blogdate)=$themonth AND blogdate < NOW() AND content_type='blog' ORDER by blogdate ASC";
}

$result = mysql_query($sql);
// stick all posts into an array
if ($myblog = mysql_fetch_array($result)) {
	do {
		$postdate = $myblog["postdate"];
		$maincontent = $myblog["maincontent"];
		$description = $myblog["description"];
		$title = format($myblog["title"]);
		$title = str_replace(array("<p>","</p>"),array("",""),$title);
		$id = $myblog["blog_id"];
		$blogdate[$id] = $postdate;
		$blogtitle[$id] = $title;
		$blogdesc[$id] = makeDescription($maincontent,$description);
	} while ($myblog = mysql_fetch_array($result));
}
?>

<!DOCTYPE html>
<html lang="en-gb">

<head>
<?php include($dr . "head.inc.php"); ?>

    <title><?php echo displayTitle($category, $monthtext, $theyear); ?> | Clagnut Archive</title>
    
    <meta name="description" content="Blog posts about <?php echo $category ?>" />
    <meta name="author" content="Richard Rutter" /> 
    
</head>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main class="archive">

<header>

<h1><?php echo displayTitle($category, $monthtext, $theyear)?></h1>

<div class="meta">
<nav>
<?php

// Do next/prev links
	
if ($category_filter) {
	// next/prev category
	foreach ($categorys AS $id => $cat) {	
		if (isset($thiscat) AND !isset($nextcat)) {$nextcat=$id;}
		if ($id == $category_id) {
			$thiscat=$id;
			if(isset($prev)) {$prevcat = $prev;}
		}
		$prev = $id;
	}
	if(!isset($prevcat)) {$prevcat = $id;}
	if(!isset($nextcat)) {reset($categorys); $nextcat = key($categorys);}
	printf("<a href='/archive/%s/' rel='next' title='%s'>&lsaquo;</a>\n",$filenames[$nextcat], $categorys[$nextcat]);
	printf("<a href='/archive/%s/' rel='prev' title='%s'>&rsaquo;</a>\n",$filenames[$prevcat], $categorys[$prevcat]);
} else {

	// next/prev date
	$nextdate = mktime(23,59,59,date("m",$thedate)+1,1,date("Y",$thedate));
	$prevdate = mktime(23,59,59,date("m",$thedate),0,date("Y",$thedate));

	if($nextdate < time()) {
		printf("<a href='/archive/%s/%s/' title='%s'>&lsaquo;</a>\n", date("Y",$nextdate), 	date("m",$nextdate), date("F Y",$nextdate));
	}

	if($prevdate > $enddate) {
		printf("<a href='/archive/%s/%s/' title='%s'>&rsaquo;</a>\n", date("Y",$prevdate), date("m",$prevdate), date("F Y",$prevdate));
	} else {echo "&nbsp;";}
}

?>

</nav>
</div>
</header>

<section class="relatedposts archive">

<?php		
	if ($category_filter) {
	// query for category filter
	$sql = "SELECT blogs.blog_id, title, description, maincontent, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs, categorys_blogs WHERE blogs.blog_id = categorys_blogs.blog_id AND categorys_blogs.category_id = $category_id AND blogdate < NOW() AND content_type='blog' ORDER by blogdate DESC";
} else {
	// query for date filter
	$sql = "SELECT blog_id, title, description, maincontent, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs WHERE YEAR(blogdate)=$theyear AND MONTH(blogdate)=$themonth AND blogdate < NOW() AND content_type='blog' ORDER by blogdate ASC";
}

$result = mysql_query($sql);
// stick all posts into an array
if ($myblog = mysql_fetch_array($result)) {
	do {
		$postdate = $myblog["postdate"];
		$maincontent = $myblog["maincontent"];
		$description = $myblog["description"];
		$title = format($myblog["title"]);
		$title = str_replace(array("<p>","</p>"),array("",""),$title);
		
		$id = $myblog["blog_id"];
		$post_postdate[$id] = $postdate;
		$post_isodate[$id] = $postdate;
		$post_title[$id] = $title;
		$post_description[$id] = makeDescription($maincontent,$description);
	} while ($myblog = mysql_fetch_array($result));
}

if (isset($blogdate)) {
# Print individual post title and descriptions
	foreach($post_postdate AS $blogpostid => $date) {
		echo "<article>\n";
		echo "	<p class=\"date\">\n";
		echo "		<time datetime=\"" . $post_isodate[$blogpostid] . " \">" . $post_postdate[$blogpostid] . " </time>\n";
		echo "	</p>\n";
		echo "	<h1><a href=\"/blog/" . $blogpostid . "/\" rel=\"bookmark\">" . $post_title[$blogpostid] . " </a></h1>\n";
		echo "	<p class=\"summary\">" . $post_description[$blogpostid] . " </p>\n";
		echo "</article>\n";
	}
} else {
	if ($category_filter) {
		echo "<p>I haven&#8217;t posted any blog entries in this category.</p>";
	} else {
		echo "<p>I didn&#8217;t post any blog entries during this month.</p>";
	}
}
?>
</section>


<aside>
<?php
/*
	<h2>Archive</h2>
	
	tabbed years each with a list of months
*/
?>

	<h2>Categories</h2>
	<ul>
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


</main>

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
