<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Add a Website</title>
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
include($dr . "/includes/cms_websites.inc");
?>
</div>
<div id="screen">
<h2>Add a website</h2>
<?php
// connect to database
$db = mysql_connect("localhost", "clagnut", "fugazi");
mysql_select_db("clagnut",$db);// if submit button pressed then add a new website to the database
if ($submitAdd) {	$description = eregi_replace ("--", "&#8211;", $description);
	$description = str_replace("'", "&#8217;", $description);
	$description = str_replace(" '", " &#8216;", $description);
	$sql = "INSERT INTO websites 
	(website_id,webcatID,name,url,description)
	VALUES (NULL, '$webcatID', '$name', '$url', '$description')";
	$result = mysql_query($sql);
	echo "<p>$name added</p>";
}
?><!-- form to collect data contents of new website -->
<!-- form submits to itself -->
<form method="post" action="<?php echo $PHP_SELF ?>">
<p>Name: <input type="text" name="name" size="60" maxlength="255"></p>
<p>URL: <input type="text" name="url" size="60" maxlength="255" value="http://"></p>
<?php
// get list of categories from database
$sql = "SELECT webcat_id,webcat FROM webcats";
$result = mysql_query($sql);
$mywebcat = mysql_fetch_array($result);if($mywebcat) { // checks if any webcats have been returned from database
    echo "<p>Category: <select name='webcatID'>";
    do { // prints an webcat's details
		$webcat = $mywebcat["webcat_id"];
		printf("<option value='%s'>%s</option>\n", $webcat, $mywebcat["webcat"]);
	} while ($mywebcat = mysql_fetch_array($result));
	echo "</select></p>\n";
} else {
        echo "<p>No categories as yet. <a href='/cms/websites/addwebcat.php'>Add category</a></p>";
}
?>
<p>Description:<br>
<textarea name="description" rows="2" cols="45"></textarea></p>
<br>
<input type="Submit" name="submitAdd" value="Add website">
</form>
</div>
</body>
</html>
