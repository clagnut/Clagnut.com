<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit Category</title>
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
<h2>Edit webcat</h2>
<form method="post" action="<?php echo $PHP_SELF ?>">
<?php
// if submit has been pressed then update database accordingly
if ($submitEdit) {
	$sql = "UPDATE webcats SET
    webcat='$webcat',
	description ='$description'
	WHERE webcat_id='$id'";
    $result = mysql_query($sql);
	echo "<p>$webcat modified.</p>";
}

// pull webcat from database
$sql = "SELECT webcat, description FROM webcats WHERE webcat_id=$id";
$result = mysql_query($sql);
$mywebcat = mysql_fetch_array($result);
printf("<p>Category name: <input type=\"text\" name=\"webcat\" value=\"%s\" size=\"60\" maxlength=\"255\"></p>\n", $mywebcat["webcat"]);
printf("<p>Description: <input type=\"text\" name=\"description\" value=\"%s\" size=\"80\" maxlength=\"255\"></p>\n", $mywebcat["description"]);
?>
<input type="hidden" name="id" value="<?=$id?>">
<input type="Submit" name="submitEdit" value="Submit changes">
</form>
</div>
</body>
</html>
