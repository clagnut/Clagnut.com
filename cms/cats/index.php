<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Edit Categories</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_cats.inc")
?>
</div>
<div id="screen">
<h2>Edit a Category</h2>
<?php
// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// if delete has been pressed and and id is present then delete
if ($del && $id) {
    $sql = "DELETE FROM categorys WHERE category_id='$id'";
    $result = mysql_query($sql);
    echo "<p>category deleted!</p>";
}

// get list of categorys from database
$sql = "SELECT category_id,category FROM categorys ORDER BY category";
$result = mysql_query($sql);
$mycategory = mysql_fetch_array($result);
if($mycategory) { // checks if any categorys have been returned from database
    echo "<ul>";
	do { // prints an category's details
		$category = $mycategory["category"];
		if ($category=="") {$category="&nbsp;__&nbsp;";}
		printf("<li>[<a href=\"%s?del=1&id=%s\">del</a>]
	     <a href=\"editblogcat.php?id=%s\">%s</a></li>\n",
    	 $PHP_SELF, $mycategory["category_id"],
	     $mycategory["category_id"], $category);
	} while ($mycategory = mysql_fetch_array($result)); // loops back through $mycategory array for each category returned from database    echo "</ul>";
} else {
        echo "<p>No categorys as yet.</p>";
}
?>
</div>
</body>
</html>
