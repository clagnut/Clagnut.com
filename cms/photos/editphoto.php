<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

if ($gallery_id) {$id = $gallery_id;}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit theme</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
<style type="text/css">
#photolist LI {
	list-style:none;
	width:110px;
	float:left;
	margin:5px;
}

#photolist LI IMG {
	border-width:1px;
}
</style>
<script type="text/javascript">
// get themes
themes = new Array()
<?php
$themelist = mysql_query("SELECT theme_id, theme FROM themes ORDER BY theme",$db);
if ($mytheme = mysql_fetch_array($themelist)) {
	$CurrentRecord = 0;
	do {
		$CurrentRecord++;
		$theme_id = $mytheme["theme_id"];
		$theme = addslashes($mytheme["theme"]);
		echo "themes[$CurrentRecord]=['$theme_id','$theme']\n";
	} while ($mytheme = mysql_fetch_array($themelist));
}
?>
// get gallerys
gallerys = new Array()
<?php
$gallerylist = mysql_query("SELECT gallery_id, gallery, themeID FROM gallerys ORDER BY gallery",$db);
if ($mygallery = mysql_fetch_array($gallerylist)) {
	$CurrentRecord = 0;
	do {
		$CurrentRecord++;
		$gallery_id = $mygallery["gallery_id"];
		$gallery = addslashes($mygallery["gallery"]);
		$themeID = $mygallery["themeID"];
		echo "gallerys[$CurrentRecord]=['$gallery_id','$themeID','$gallery']\n";
	} while ($mygallery = mysql_fetch_array($gallerylist));
}
?>

function setThemes() {
	// reset all select boxes
	document.nav.theme_id.options.length = 0
	document.nav.gallery_id.options.length = 0
	var myNewOption = new Option('< select a theme');
	document.nav.gallery_id.options[0] = myNewOption;
	
	// load in themes from arrays
	for (i=0; i<themes.length-1; i++) {
		n = i+1
		id = themes[n][0]
		title = themes[n][1]
		var myNewOption = new Option(title, id);
		document.nav.theme_id.options[i] = myNewOption;
	}
}

function setGallerys(theme_id) {
	// reset box
	document.nav.gallery_id.options.length = 0
	
	// load in gallerys from array
	numgals = 0
	for (i=0; i<gallerys.length-1; i++) {
		n = i+1
		cat_id = gallerys[n][1]
		if (cat_id == theme_id) {
			id = gallerys[n][0];
			title = gallerys[n][2];
			var myNewOption = new Option(title, id);
			document.nav.gallery_id.options[numgals] = myNewOption;
			numgals++;
		}		
	}
	if (numgals == 0) {
		var myNewOption = new Option("No gallerys set", "");
		document.nav.gallery_id.options[0] = myNewOption;
	}
}

</script>
</head>
<body onload="setThemes(); setGallerys(document.nav.theme_id.options[document.nav.theme_id.selectedIndex].value)">
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_photos.inc")
?>
</div>
<div id="screen">
<h2>Edit photo</h2>
<form name="nav" action="<?=$PHP_SELF?>">
<p>Theme:
<select id="theme_id" name="theme_id" onchange="setGallerys(this.options[this.selectedIndex].value)">
<option>Getting themes...</option>
</select>

Gallery:
<select id="gallery_id" name="gallery_id">
<option>&lt; select a theme</option>
</select>
<input type="submit" value="Go">
</p>
</form>


<?php
/* show theme form if theme selected */
if ($id) {
	$photolist = mysql_query("SELECT photo_id, title, filename FROM photos WHERE gallery1 = $id OR gallery2 = $id OR  gallery3 = $id",$db);
	if ($myphoto = mysql_fetch_array($photolist)) {
		echo "<ul id='photolist'>\n";
		do {
			$photo_id = $myphoto["photo_id"];
			$title = $myphoto["title"];
			echo "<li><a href='index.php?id=$photo_id'><img src='/photos/th/$photo_id.jpg' alt='$title' title='$title'></a></li>\n";
		} while ($myphoto = mysql_fetch_array($photolist));
		echo "</ul>";
	}
}


?>

</div>
</body>
</html>
