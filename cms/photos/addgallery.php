<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Add theme</title>
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
include($dr . "/includes/cms_photos.inc")
?>
</div>
<div id="screen">
<h2>Add theme</h2>

<?php
// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

if ($submittheme) {
	$sql = "INSERT INTO themes
	 (theme_id,theme,description,filename) VALUES
	 (NULL,'$theme','$description','$filename')";

	// run SQL against the DB

	$result = mysql_query($sql);
	
	printf("<p>%s added!</p>",$theme);
	
}

if ($submitgallery) {
	$sql = "INSERT INTO gallerys
	 (gallery_id,gallery,description,filename,photoID,themeID) VALUES
	 (NULL,'$gallery','$description','$filename','$photoID','$themeID')";

	// run SQL against the DB

	$result = mysql_query($sql);
	
	printf("<p>%s added!</p>",$gallery);
	
}
?>

<form method="get" action="<?php echo $PHP_SELF?>">

<p>theme name: <input type="text" name="theme" size="51" maxlength="50"></p>
<p>Filename: <input type="text" name="filename" size="51" maxlength="50"></p>
<p>Description: <textarea cols="30" rows="3" name="description">&lt;p&gt;&lt;/p&gt;</textarea></p>
<p>Photo: <input type="text" name="photoID" size="5" maxlength="4"></p>

<input type="Submit" name="submittheme" value="Add theme">

</form>
<hr>

<h2>Add gallery</h2>

<form method="get" action="<?php echo $PHP_SELF?>">

<p>gallery name: <input type="text" name="gallery" size="51" maxlength="50"></p>
<p>Filename: <input type="text" name="filename" size="51" maxlength="50"></p>
<p>Description: <textarea cols="30" rows="3" name="description">&lt;p&gt;&lt;/p&gt;</textarea></p>
<p>Photo: <input type="text" name="photoID" size="5" maxlength="4"></p>
<p>theme:
<select name="themeID">
<?php
	/* get all galleries */
	$themelist = mysql_query("SELECT theme_id, theme FROM themes ORDER BY theme",$db);
	if ($mytheme = mysql_fetch_array($themelist)) {
		do {
			printf("<option value='%s'>%s</option>", $mytheme["theme_id"], $mytheme["theme"]);
		} while  ($mytheme = mysql_fetch_array($themelist));
	}
?>
</select>
</p>

<input type="Submit" name="submitgallery" value="Add gallery">

</form>

</div>
</body>
</html>
