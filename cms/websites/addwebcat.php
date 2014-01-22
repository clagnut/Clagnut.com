<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Add a Category</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
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
<h2>Add a webcat</h2>
<?php
// if submit button pressed then add a new webcat to the database
if ($submitAdd) {	$sql = "INSERT INTO webcats 
	(webcat_id,webcat,description)
	VALUES (NULL, '$webcat', '$description')";
	$result = mysql_query($sql);
	echo "<p>$webcat added</p>";
}
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
<p>Category name: <input type="text" name="webcat" size="60" maxlength="255"></p>
<p>Description: <input type="text" name="description" size="80" maxlength="255"></p>
<br>
<input type="Submit" name="submitAdd" value="Add category">
</form>
</div>
</body>
</html>
