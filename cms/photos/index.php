<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$my_max_file_size 	= "102400"; # in bytes
// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

if ($id) {
	$action = "Update";
} else {
	$action = "Add";
}

if ($Add) {
	$sql = "SHOW TABLE STATUS LIKE 'photos'";
    $result = mysql_query($sql);
    $showtable = mysql_fetch_array($result);
	$id = $showtable["Auto_increment"];
}

if ($id AND $the_photo != "none" AND ($Add OR $Update)) {
	$the_photo_name = '/home/clagnut/public_html/photos/big/'.$id.'.jpg';
	if (!$error) {
		if (!move_uploaded_file($HTTP_POST_FILES['the_photo']['tmp_name'],$the_photo_name)) {
			$error2 = "\n<p>Something barfed with the big photo.</p>";
		}
	}
}

if ($id AND $the_thumb != "none" AND ($Add OR $Update)) {
	$the_thumb_name = '/home/clagnut/public_html/photos/th/'.$id.'.jpg';
	if (!$error) {
		if (!move_uploaded_file($HTTP_POST_FILES['the_thumb']['tmp_name'],$the_thumb_name)) {
			$error3 = "\n<p>Something barfed with the thumbnail.</p>";
		}
	}
}

if (!$error2 && !$error3 && $id && $Add) {
	$sql = "INSERT INTO photos
	 (photo_id,title,orient,gallery1,gallery2,gallery3,description,date) VALUES
	 (NULL,'$title','$orient','$gallery1','$gallery2','$gallery3','$description','$date')";
	// run SQL against the DB
	$result = mysql_query($sql);
	if (mysql_affected_rows() > -1) {
		$success = "<p>$title added! id=$id</p>\n";
	} else {
		$error5 = mysql_error();
	}
}

if ($id && $Update) {
	$sql = "UPDATE photos SET
	 title='$title',
	 orient='$orient',
	 gallery1='$gallery1',
	 gallery2='$gallery2',
	 gallery3='$gallery3',
	 description='$description',
	 date='$date'
	 WHERE photo_id=$id";
	// run SQL against the DB
	$result = mysql_query($sql);
	if (mysql_affected_rows() > -1) {
		$success = "<p>$title updated! id=$id</p>\n";
	} else {
		$error4 = mysql_error();
	}
}

if ($id) {
	$photos = mysql_query("SELECT * FROM photos WHERE photo_id=$id LIMIT 1",$db);
	if ($myrow = mysql_fetch_array($photos)) {
		$title = $myrow["title"];
		$orient = $myrow["orient"];
		$gallery1 = $myrow["gallery1"];
		$gallery2 = $myrow["gallery2"];
		$gallery3 = $myrow["gallery3"];
		$description = $myrow["description"];
		$date = $myrow["date"];
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=$action ?> photo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php $dr = $_SERVER["DOCUMENT_ROOT"];
include($dr . "/includes/cms_headlinks.inc"); ?>
<script type="text/javascript">
function count(desc) {
	left = 160 - desc.length
	document.photoform.counter.value = left
}
</script>
</head>
<body onload="count(document.photoform.description.value)">
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_photos.inc")
?>
</div>
<div id="screen">
<h2><?=$action ?> photo</h2>
<?php
if ($id) {
	echo "<p><img src='/photos/th/$id.jpg' alt='$title' title='$title' style='float:right; width:104px'></p>\n";
}
echo $error;
echo $error2;
echo $error3;
echo $error4;
echo $success;

print "<form method='post' action='".$PHP_SELF."' name='photoform' ENCTYPE='multipart/form-data'>";
print "<input type='hidden' name='MAX_FILE_SIZE' value='".$my_max_file_size."'>\n";
print "<input type='hidden' name='id' value='".$id."'>\n";

print "<p>Title: <input type='text' name='title' size='51' maxlength='50' value='".$title."'></p>\n";
print "<p>Photo:<input name='the_photo' TYPE='file' SIZE='51' accept='image/*' ></p>\n";
print "<p>Thumb:<input name='the_thumb' TYPE='file' SIZE='51' accept='image/*' ></p>\n";

print "<p>Date: <input type='text' name='date' value='";
if(!$date) {$date = date("Y-m-d", time());}
echo $date;
print "'> yyyy-mm-dd</p>\n";

echo "<p>Description:<br>";
print "<textarea cols='41' rows='3' name='description' onkeypress='count(this.value)'>".$description."</textarea><br>\n";
echo "<input name='counter' size='4'></p>\n";

echo "<p>Orientation: <input type='radio' name='orient' value='l'";
if (!$orient OR $orient == "l") {echo " checked";}
echo  ">landscape\n";
echo "<input type='radio' name='orient' value='p'";
if ($orient == "p") {echo " checked";}
echo ">portrait</p>\n";

echo "<p>gallery 1:\n";
echo "<select name='gallery1'>\n";
echo "<option> - select - </option>\n";	/* get all galleries */
	$themelist1 = mysql_query("SELECT theme_id, filename, theme FROM themes ORDER BY theme",$db);
	if ($mytheme = mysql_fetch_array($themelist1)) {
		do {
			printf("<option value='%s'>%s</option>\n", $mytheme["filename"], $mytheme["theme"]);
			$thistheme = $mytheme["theme_id"];
			$gallerylist = mysql_query("SELECT gallery_id, gallery FROM gallerys WHERE themeID = $thistheme ORDER BY gallery",$db);
			if ($mygallery = mysql_fetch_array($gallerylist)) {
				do {
					printf("<option value='%s'", $mygallery["gallery_id"]);
					if($gallery1 == $mygallery["gallery_id"]) {echo " selected";}
					printf("> &nbsp; &nbsp; %s</option>", $mygallery["gallery"]);
				} while  ($mygallery = mysql_fetch_array($gallerylist));
			}
		} while  ($mytheme = mysql_fetch_array($themelist1));
	}
echo "</select>\n</p>\n";echo "<p>gallery 2:\n";
echo "<select name='gallery2'>\n";
echo "<option> - select - </option>";
	/* get all galleries */
	$themelist2 = mysql_query("SELECT theme_id, filename, theme FROM themes ORDER BY theme",$db);
	if ($mytheme = mysql_fetch_array($themelist2)) {
		do {
			printf("<option value='%s'>%s</option>\n", $mytheme["filename"], $mytheme["theme"]);
			$thistheme = $mytheme["theme_id"];
			$gallerylist = mysql_query("SELECT gallery_id, gallery FROM gallerys WHERE themeID = $thistheme ORDER BY gallery",$db);
			if ($mygallery = mysql_fetch_array($gallerylist)) {
				do {
					printf("<option value='%s'", $mygallery["gallery_id"]);
					if($gallery2 == $mygallery["gallery_id"]) {echo " selected";}
					printf("> &nbsp; &nbsp; %s</option>", $mygallery["gallery"]);
				} while  ($mygallery = mysql_fetch_array($gallerylist));
			}
		} while  ($mytheme = mysql_fetch_array($themelist2));
	}
echo "</select>\n</p>\n";echo "<p>gallery 3:\n";
echo "<select name='gallery3'>";
echo "<option> - select - </option>";
	/* get all galleries */
	$themelist3 = mysql_query("SELECT theme_id, filename, theme FROM themes ORDER BY theme",$db);
	if ($mytheme = mysql_fetch_array($themelist3)) {
		do {
			printf("<option value='%s'>%s</option>\n", $mytheme["filename"], $mytheme["theme"]);
			$thistheme = $mytheme["theme_id"];
			$gallerylist = mysql_query("SELECT gallery_id, gallery FROM gallerys WHERE themeID = $thistheme ORDER BY gallery",$db);
			if ($mygallery = mysql_fetch_array($gallerylist)) {
				do {
					printf("<option value='%s'", $mygallery["gallery_id"]);
					if($gallery3 == $mygallery["gallery_id"]) {echo " selected";}
					printf("> &nbsp; &nbsp; %s</option>", $mygallery["gallery"]);
				} while  ($mygallery = mysql_fetch_array($gallerylist));
			}
		} while  ($mytheme = mysql_fetch_array($themelist3));
	}
echo "</select>\n</p>\n";
?><input type="Submit" name="<?=$action?>" value="<?=$action?> photo">
</form>
</div>
</body>
</html>
