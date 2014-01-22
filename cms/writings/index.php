<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

# get query
$id = $_REQUEST['id'];
$del = $_REQUEST['del'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Edit Writings</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_writings.inc")
?>
</div>
<div id="screen">
<h2>Edit a Writing</h2>
<?php
// if delete has been pressed and and id is present then delete
if ($del && $id) {
    $sql = "DELETE FROM blogs WHERE blog_id='$id'";
    $result = mysql_query($sql);
    echo "<p>Writing deleted!</p>";
	include($dr . "/includes/pingwewritings.inc");
}

// get list of writings from database
$sql = "SELECT blog_id, title FROM blogs WHERE content_type='writing' ORDER BY title";
$result = mysql_query($sql);
$mywriting = mysql_fetch_array($result);
if($mywriting) { // checks if any writings have been returned from database
    echo "<ol>";
	do { // prints an writing's details
		$title = $mywriting["title"];
		$writing_id = $mywriting["blog_id"];
		if ($title=="") {$title="&nbsp;__&nbsp;";}
		printf("<li value='%s'>[<a href=\"%s?del=1&id=%s\" onclick=\"return confirm('Are you sure you want to delete this post?')\">del</a>]
	     <a href=\"editwriting.php?id=%s\">%s</a></li>\n", $mywriting["writing_id"],
    	 $PHP_SELF, $writing_id, $writing_id, $title);
	} while ($mywriting = mysql_fetch_array($result)); // loops back through $mywriting array for each writing returned from database
	echo "</ol>";
} else {
        echo "<p>No writings as yet.</p>";
}
?>
</div>
</body>
</html>
