<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");
include($dr . "/includes/format.php");
include($dr . "/includes/cms_writerssfiles.php");

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:""; 
$del = (isset($_REQUEST["del"]))?$_REQUEST["del"]:""; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit blogmarks</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_blogmarks.inc");
?>
</div>
<div id="screen">
<h2>Edit a blogmark</h2>
<?php

// if delete has been pressed and an id is present then delete
if ($del && $id) {
    $sql = "DELETE FROM blogs WHERE blog_id='$id'";
    $result = mysql_query($sql);
	if ($result) {
	    echo "<p>Blogmark deleted!</p>";
	    echo writeblogmarkrss();
	} else {
		echo "<p>Error deleting blogmark.</p>\n";
		echo "<p>".mysql_error()."</p>";
	}
}

// get list of blogs from database
$sql = "SELECT blog_id, title, filename, description, via_title, via_url, blogdate FROM blogs WHERE content_type='blogmark' ORDER BY blogdate DESC, tstamp DESC";
$result = mysql_query($sql);
$myblog = mysql_fetch_array($result);
if($myblog) { // checks if any blogs have been returned from database
    echo "<ol>";
	do { // prints an blog's details
		$blog_id = $myblog["blog_id"];
		$link_title = htmlentities($myblog["title"]);
		$link_url = $myblog["filename"];
		$link_comment = $myblog["description"];
		$via_title = $myblog["via_title"];
		$via_url = $myblog["via_url"];
		$blogdate = $myblog["blogdate"];

		if ($link_title=="") {$link_title="&nbsp;__&nbsp;";}
		printf("<li value='%s'>[<a href=\"%s?del=1&amp;id=%s\" onclick=\"return confirm('Are you sure you want to delete this blogmark?')\">del</a>]
	     <a href=\"editblogmark.php?id=%s\">%s</a></li>\n", $blog_id,
    	 $_SERVER["PHP_SELF"], $blog_id, $blog_id, $link_title);
	} while ($myblog = mysql_fetch_array($result)); // loops back through $myblog array for each blog returned from database
	echo "</ol>";
} else {
        echo "<p>No blogmarks as yet.</p>";
}
?>
</div>
</body>
</html>
