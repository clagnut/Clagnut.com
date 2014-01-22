<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Add a Category</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc")
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_cats.inc");
?>
</div>
<div id="screen">
<h2>Add a category</h2>
<?php
// if submit button pressed then add a new category to the database
if ($submitAdd) {
	$sql = "INSERT INTO categorys 
	(category_id,category, filename, keywords)
	VALUES (NULL, '$category', '$filename', '$keywords')";
	$result = mysql_query($sql);
	echo "<p>$category added</p>";
}
?>
<!-- form to collect data contents of new category -->
<form method="post" action="<?php echo $PHP_SELF ?>">
<p>Category name: <input type="text" name="category" size="60" maxlength="255"></p>
<p>Filename: <input type="text" name="filename" size="33" maxlength="32"></p>
<p>Keywords (comma separated):<br>
<textarea name="keywords" cols="45" rows="3"></textarea></p>
<br>
<input type="Submit" name="submitAdd" value="Add category">
</form>
</div>
</body>
</html>
