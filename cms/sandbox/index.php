<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:""; 
$del = (isset($_REQUEST["del"]))?$_REQUEST["del"]:""; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Edit sandboxes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_sandboxes.inc")
?>
</div>
<div id="screen">
<h2>Edit a sandbox</h2>
<?php
// if delete has been pressed and and id is present then delete
if ($del && $id) {
    $sql = "DELETE FROM blogs WHERE blog_id='$id'";
    $result = mysql_query($sql);
    echo "<p>sandbox deleted!</p>";
}

// get list of sandboxes from database
$sql = "SELECT blog_id,title FROM blogs WHERE content_type='sandbox' ORDER BY title";
$result = mysql_query($sql);
$mysandbox = mysql_fetch_array($result);
if($mysandbox) { // checks if any sandboxes have been returned from database
    echo "<ol>";
	do { // prints an sandbox's details
		$title = $mysandbox["title"];
		$sandbox_id = $mysandbox["blog_id"];
		if ($title=="") {$title="&nbsp;__&nbsp;";}
		printf("<li value='%s'>[<a href=\"%s?del=1&id=%s\" onclick=\"return confirm('Are you sure you want to delete this post?')\">del</a>]
	     <a href=\"editsandbox.php?id=%s\">%s</a></li>\n", $sandbox_id,
    	 $_SERVER["PHP_SELF"], $sandbox_id, $sandbox_id, $title);
	} while ($mysandbox = mysql_fetch_array($result)); // loops back through $mysandbox array for each sandbox returned from database
	echo "</ol>";
} else {
        echo "<p>No sandboxes as yet.</p>";
}
?>
</div>
</body>
</html>
