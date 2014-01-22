<?php
// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

if ($submittheme) {
	$sql = "UPDATE themes SET
     theme='$theme', filename='$filename', description='$description', photoID='$photoID'
     WHERE theme_id='$themeid'";
    $result = mysql_query($sql);
	$success =  "theme ".$theme." modified.";
}

if ($submitgallery) {
	$sql = "UPDATE gallerys SET
     gallery='$gallery', filename='$filename', description='$description', photoID='$photoID'
     WHERE gallery_id='$galleryid'";
    $result = mysql_query($sql);
	$success =  "gallery ".$gallery." modified.";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit theme</title>
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
<h2>Edit theme</h2>
<?php
print "<p><em>".$success."</em></p>\n";

/* show theme form if theme selected */
if ($themeid) {
	$themelist = mysql_query("SELECT * FROM themes WHERE theme_id = $themeid",$db);
	if ($mytheme = mysql_fetch_array($themelist)) {
	
		$descriptionamped = eregi_replace ("&", "&amp;", $mytheme["description"]);
	
		printf("<form method='get' action='%s'>\n", $PHP_SELF);
		printf("<input type='hidden' name='themeid' value='%s'>\n", $mytheme["theme_id"]);
		printf("<h3>theme: %s</h3>\n", $mytheme["theme"]);
		printf("<p>theme name: <input type='text' name='theme' size='51' maxlength='50' value='%s'></p>\n", $mytheme["theme"]);
		printf("<p>Filename: <input type='text' name='filename' size='51' maxlength='50' value='%s'></p>\n", $mytheme["filename"]);
		printf("<p>Description: <textarea cols='30' rows='3' name='description'>%s</textarea></p>\n", $descriptionamped);
		printf("<p>Photo: <img src='/photos/th/%s.jpg' width='104' height='104'><input type='text' name='photoID' size='5' maxlength='4' value='%s'></p>\n", $mytheme["photoID"], $mytheme["photoID"]);
		echo "<input type='Submit' name='submittheme' value='Update theme'>\n";
		echo "</form>\n";
		echo "<hr>\n";
	}
}


/* show gallery form if gallery selected */
if ($galleryid) {
	$gallerylist = mysql_query("SELECT * FROM gallerys WHERE gallery_id = $galleryid",$db);
	if ($mygallery = mysql_fetch_array($gallerylist)) {
	
		$descriptionamped = eregi_replace ("&", "&amp;", $mygallery["description"]);
	
		printf("<form method='get' action='%s'>\n", $PHP_SELF);
		printf("<input type='hidden' name='galleryid' value='%s'>\n", $mygallery["gallery_id"]);
		printf("<h3>gallery: %s</h3>\n", $mygallery["gallery"]);
		printf("<p>gallery name: <input type='text' name='gallery' size='51' maxlength='50' value='%s'></p>\n", $mygallery["gallery"]);
		printf("<p>Filename: <input type='text' name='filename' size='51' maxlength='50' value='%s'></p>\n", $mygallery["filename"]);
		printf("<p>Description: <textarea cols='30' rows='3' name='description'>%s</textarea></p>\n", $descriptionamped);
		printf("<p>Photo: <img src='/photos/th/%s.jpg' width='104' height='104'><input type='text' name='photoID' size='5' maxlength='4' value='%s'></p>\n", $mygallery["photoID"], $mygallery["photoID"]);
		echo "<input type='Submit' name='submitgallery' value='Update gallery'>\n";
		echo "</form>\n";
		echo "<hr>\n";
	}
}

/* list all galleries and gallerys */
$themelist = mysql_query("SELECT theme_id, filename, theme FROM themes ORDER BY theme",$db);
if ($mytheme = mysql_fetch_array($themelist)) {
	echo "<ul>\n";
	do {
		printf("<li><a href='%s?themeid=%s'>%s</a>", $PHP_SELF, $mytheme["theme_id"], $mytheme["theme"]);
		$thistheme = $mytheme["theme_id"];
		$gallerylist = mysql_query("SELECT gallery_id, gallery FROM gallerys WHERE themeID = $thistheme ORDER BY gallery",$db);
		if ($mygallery = mysql_fetch_array($gallerylist)) {
			echo "\n<ul>\n";
			do {
				printf("<li><a href='%s?galleryid=%s'>%s</a></li>\n", $PHP_SELF, $mygallery["gallery_id"], $mygallery["gallery"]);
			} while  ($mygallery = mysql_fetch_array($gallerylist));
			echo "</ul>\n";
		}
		echo "</li>\n";
	} while  ($mytheme = mysql_fetch_array($themelist));
	echo "</ul>\n";
}
?>

</div>
</body>
</html>
