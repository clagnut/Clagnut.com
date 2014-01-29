<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
$dr3 = str_replace("/includes/", "", $dr);

include_once($dr . "php_errors.inc.php");

include_once($dr . "path_to_db.inc.php");
include($dr2 . "/db_connect.php");
include($dr . "/format.php");
include($dr . "/cms_writerssfiles.php");

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:""; 
$del = (isset($_REQUEST["del"]))?$_REQUEST["del"]:""; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Edit Blogs</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include($dr . "/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/cms_options.inc");
include($dr . "/cms_blogs.inc")
?>
</div>
<div id="screen">
<h2>Edit a Blog</h2>
<?php

// if delete has been pressed and and id is present then delete
if ($del && $id) {
    $sql = "DELETE FROM blogs WHERE blog_id='$id'";
    $result = mysql_query($sql);
	if ($result) {
	    echo "<p>Blog deleted!</p>";
	    echo writefullrss();
		echo writesummariesrss();
	} else {
		echo "<p>Error deleting blog.</p>\n";
		echo "<p>".mysql_error()."</p>";
	}
}

// get list of blogs from database
$sql = "SELECT blog_id,title,DATE_FORMAT(blogdate, '%e %b %Y at %H:%i') FROM blogs WHERE content_type='blog' ORDER BY blogdate DESC";
$result = mysql_query($sql);
$myblog = mysql_fetch_array($result);
if($myblog) { // checks if any blogs have been returned from database
    echo "<ol>";
	do { // prints an blog's details
		$title = $myblog["title"];
		if ($title=="") {$title="&nbsp;__&nbsp;";}
		printf("<li value='%s'>[<a href=\"%s?del=1&id=%s\" onclick=\"return confirm('Are you sure you want to delete this post?')\">del</a>]
	     <a href=\"editblog.php?id=%s\">%s</a> %s</li>\n", $myblog["blog_id"],
    	 $_SERVER["PHP_SELF"], $myblog["blog_id"],
	     $myblog["blog_id"], $title, $myblog["DATE_FORMAT(blogdate, '%e %b %Y at %H:%i')"]);
	} while ($myblog = mysql_fetch_array($result)); // loops back through $myblog array for each blog returned from database
	echo "</ol>";
} else {
        echo "<p>No blogs as yet.</p>";
}
?>
</div>
</body>
</html>
