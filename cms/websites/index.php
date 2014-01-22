<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:false; 
$del = (isset($_REQUEST["del"]))?$_REQUEST["del"]:false;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit Websites</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_websites.inc")
?>
</div>
<div id="screen">
<h2>Edit a Website</h2>
<?php
// if delete has been pressed and and id is present then delete
if ($del=="website" && $id) {
    $sql = "DELETE FROM websites WHERE website_id='$id'";
    $result = mysql_query($sql);
    echo "<p>Website deleted!</p>";
}
if ($del=="webcat" && $id) {
    $sql = "DELETE FROM webcat WHERE webcat_id='$id'";
    $result = mysql_query($sql);
    echo "<p>Category deleted!</p>";
}

// get list of categories from database
$sql = "SELECT webcat_id,webcat FROM webcats";
$result = mysql_query($sql);
$mywebcat = mysql_fetch_array($result);

if($mywebcat) { // checks if any webcats have been returned from database
    echo "<ul>";
	do { // prints an webcat's details
		$webcat = $mywebcat["webcat_id"];
		printf("<li><h3>[<a href=\"%s?del=webcat&id=%s\">del</a>] <a href=\"editwebcat.php?id=%s\">%s</a></h3>\n", $_SERVER["PHP_SELF"], $webcat, $webcat, $mywebcat["webcat"]);

		// get list of websites from database
		$sql2 = "SELECT website_id,name,url,description FROM websites WHERE webcatID = $webcat ORDER BY name ASC";
		$result2 = mysql_query($sql2);
		$mywebsite = mysql_fetch_array($result2);
		if($mywebsite) { // checks if any websites have been returned from database
		    echo "<ul>";
		    do { // prints an website's details
				printf("<li>[<a href=\"%s?del=website&id=%s\">del</a>] <a href=\"editwebsite.php?id=%s\">%s</a> (<a href=\"%s\">%s</a>)<br>%s</li>\n", $_SERVER["PHP_SELF"], $mywebsite["website_id"], $mywebsite["website_id"], $mywebsite["name"], $mywebsite["url"], $mywebsite["url"], $mywebsite["description"]);
			} while ($mywebsite = mysql_fetch_array($result2)); // loops back through $mywebsite array for each website returned from database
	    	echo "</ul>";
		} else {
	        echo "<p>No websites as yet. <a href='/cms/websites/addwebsite.php'>Add website</a></p>";
		}
		echo "</li>\n";
	} while ($mywebcat = mysql_fetch_array($result)); // loops back through $mywebcat array for each webcat returned from database    echo "</ul>";
} else {
        echo "<p>No categories as yet. <a href='/cms/websites/addwebcat.php'>Add category</a></p>";
}
?>
</div>
</body>
</html>
