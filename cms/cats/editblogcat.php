<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Edit Category</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc")
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
<h2>Edit category</h2>
<form method="post" action="<?php echo $PHP_SELF ?>"><?php
// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// if submit has been pressed then update database accordingly
if ($submitEdit) {
	$sql = "UPDATE categorys SET
    category='$category', filename='$filename', keywords='$keywords' WHERE category_id='$id'";
    $result = mysql_query($sql);
	echo "<p>$category modified.</p>";
}

// pull category from database
$sql = "SELECT category, filename, keywords FROM categorys WHERE category_id=$id";
$result = mysql_query($sql);
$mycategory = mysql_fetch_array($result);
printf("<p>Category name: <input type=\"text\" name=\"category\" value=\"%s\" size=\"60\" maxlength=\"255\"></p>\n", $mycategory["category"]);
printf("<p>Filename: <input type=\"text\" name=\"filename\" value=\"%s\" size=\"60\" maxlength=\"32\"></p>\n", $mycategory["filename"]);
printf("<p>Keywords (comma separated):<br>
<textarea name=\"keywords\" cols=\"45\" rows=\"3\">%s</textarea></p>", $mycategory["keywords"]);
?>
<input type="hidden" name="id" value="<?=$id?>">
<input type="Submit" name="submitEdit" value="Submit changes">
</form>
</div>
</body>
</html>
