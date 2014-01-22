<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// format function
include($dr . "/includes/format.php");

$message = "";
$error = "";
$action = "Add";

# get query
$submitAdd = $_REQUEST['submitAdd'];
$submitUpdate = $_REQUEST['submitUpdate'];
$submitPreview = $_REQUEST['submitPreview'];
$id = $_REQUEST['id'];
$title = $_REQUEST['title'];
$filename = $_REQUEST['filename'];
$live = $_REQUEST['live'];
$subtext = $_REQUEST['subtext'];
$description = $_REQUEST['description'];
$maincontent_textile = $_REQUEST['maincontent_textile'];
$maincontent = $_REQUEST['maincontent'];
$sidebar_textile = $_REQUEST['sidebar_textile'];
$sidebar = $_REQUEST['sidebar'];
$styleswitch = $_REQUEST['styleswitch'];
$related = $_REQUEST['related'];
$writing = $_REQUEST['writing'];

// add new post 
if ($submitAdd) {
	$sql = "INSERT INTO blogs 
	(title, filename, live, subtext, description, maincontent_textile, maincontent, sidebar_textile, sidebar, styleswitch, related, content_type)
	VALUES ('$title', '$filename', '$live', '$subtext', '$description', '$maincontent_textile', '$maincontent', '$sidebar_textile', '$sidebar', '$styleswitch', '$related', 'writing')";
	$result = mysql_query($sql);
	$id = mysql_insert_id();
	if ($result) {
		$message = "Writing added successfully. id=".$id;
	} else {
		$error = "MySQL said: ".mysql_error();
		$message = "Failed to add writing.";
	}
}

// if there is a valid looking ID present
if (preg_match("/[0-9]+/",$id)) {
	$action = "Edit";
	// if submit has been pressed then update database accordingly
	if ($submitUpdate) {
	    $sql = "UPDATE blogs SET
	    title='$title', filename='$filename', live='$live', subtext='$subtext', description='$description', maincontent_textile='$maincontent_textile', maincontent='$maincontent', sidebar_textile='$sidebar_textile', sidebar='$sidebar', styleswitch='$styleswitch', related='$related'
	    WHERE blog_id='$id'";
	    $result = mysql_query($sql);
		if ($result) {
			$message = "Writing updated successfully.";
		} else {
			$error = "MySQL said: ".mysql_error();
			$message = "Failed to update writing.";
		}
	}

	// pull writing from database
	if (!$submitPreview) {
		$sql = "SELECT title, filename, live, subtext, description, maincontent_textile, maincontent, sidebar_textile, sidebar, styleswitch, related FROM blogs WHERE blog_id=$id";
		$result = mysql_query($sql);
		if ($mywriting = mysql_fetch_array($result)) {;
			$title = $mywriting["title"];
			$filename = $mywriting["filename"];
			$live = $mywriting["live"];
			$subtext = $mywriting["subtext"];
			$description = $mywriting["description"];
			$maincontent_textile = $mywriting["maincontent_textile"];
			$maincontent = $mywriting["maincontent"];
			$sidebar_textile = $mywriting["sidebar_textile"];
			$sidebar = $mywriting["sidebar"];
			$styleswitch = $mywriting["styleswitch"];
			$related = $mywriting["related"];
		} else {
			$message = "Error pulling writing from database. Bad id?";
			$error = "MySQL said: ".mysql_error();
		}
	}
	
	// update categories
	if ($submitUpdate OR $submitAdd) {
		// first delete existing entries for the writing
		$sql = "DELETE from categorys_blogs WHERE
		 blog_id=$id";
		$result = mysql_query($sql);
	
		// then insert categories
		if (is_array($category_ids)) {
			foreach ($category_ids AS $category_id) {
				$sql = "INSERT INTO categorys_blogs
				 (blog_id, category_id)
				 VALUES ('$id', '$category_id')";
				$result = mysql_query($sql);
			}
		}
	}


	// pull out categories for this writing

	$sql = "SELECT category_id FROM categorys_blogs WHERE blog_id = '$id'";
	$result = mysql_query($sql);
	if ($mycategory = mysql_fetch_array($result)) {
		do {
			$category_id_array[] = $mycategory["category_id"];
		} while ($mycategory = mysql_fetch_array($result));
	}	
}

// do radio buttons
if ($live == "y") {
	$yeschecked = " checked='checked' ";
	$nochecked = "";
} else {
	$yeschecked = "";
	$nochecked = " checked='checked' ";
}

if ($sidebar_textile == "y") {
	$st_yeschecked = " checked='checked' ";
	$st_nochecked = "";
} else {
	$st_yeschecked = "";
	$st_nochecked = " checked='checked' ";
}

if ($maincontent_textile == "n") {
	$mt_yeschecked = "";
	$mt_nochecked = " checked='checked' ";
} else {
	$mt_yeschecked = " checked='checked' ";
	$mt_nochecked = "";
}

if ($styleswitch == "y") {
	$styleswitch_checked = " checked='checked' ";
} else {
	$styleswitch_checked = "";
}

if ($related == "n") {
	$related_checked = " checked='checked' ";
} else {
	$related_checked = "";
}

// pull categories from db
$sql = "SELECT * FROM categorys ORDER BY category";
$catsresult = mysql_query($sql);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=$action?> Writing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
<script type="text/javascript">
function countchars() {
	count = document.post.description.value
	document.post.count.value = 280 - count.length
}
</script>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_writings.inc")
?>
</div>
<div id="screen">
<h2><?=$action?> writing</h2>

<?php include($dr . "/includes/cms_textilehelp.inc"); ?>

<form method="post" action="<?=$PHP_SELF ?>" name="post">
<input type="hidden" name="id" value="<?=$id ?>" />
<?php
if ($message) {echo "<p class='message'>$message</p>";}

if (!$error && $submitPreview) {
	# pre-format for preview
	$title = stripslashes($title);
	$description = stripslashes($description);
	$subtext = stripslashes($subtext);
	$maincontent = stripslashes($maincontent);
?>
	<ul id='preview'>
		<li><h3><?=str_replace(array("<p>","</p>"),array("",""),format($title))?></h3>
			<div id='desc'>
			<h4>Subtext</h4>
			<?=format($subtext)?>
			<h4>Description</h4>
			<?=format($description)?></div>
		</li>
		<li>
			<?php
			if ($maincontent_textile=='y') {
				print (format($maincontent));
			} else {
				echo $maincontent;
			}
			?>
		</li>
	</ul>
<?php 
	if (preg_match("/[0-9]+/",$id)) {
		echo "<input type='Submit' name='submitUpdate' value='Update'>\n";
	} else {
		echo "<input type='Submit' name='submitAdd' value='Post'>\n";
	}
	echo "<p><br /></p>";
}

if (!$error) {
	# format for form controls
	$title = stripslashes(str_replace("&", "&amp;", $title));
	$description = stripslashes(str_replace("&", "&amp;", $description));
	$subtext = stripslashes(str_replace("&", "&amp;", $subtext));
	$maincontent = stripslashes(str_replace("&", "&amp;", $maincontent));
	$sidebar = stripslashes(str_replace("&", "&amp;", $sidebar));

	printf("<p>Title: <input type=\"text\" name=\"title\" value=\"%s\" size=\"50\" 	maxlength=\"100\"> %s</p>\n", $title, $date);
	printf("<p>Filename: <input type=\"text\" name=\"filename\" value=\"%s\" size=\"50\" 	maxlength=\"64\"></p>\n", $filename);
	printf("<p>Live: <label><input type=\"radio\" name=\"live\" value=\"y\"%s />yes</label> <label><input type=\"radio\" name=\"live\" value=\"n\"%s />no</label></p>", $yeschecked, $nochecked);
	echo "<p>Sub-text:<br>";
	printf("<textarea name=\"subtext\" rows=\"3\" cols=\"45\">%s</textarea></p>\n",$subtext);
	echo "<p>Description:<br>";
	printf("<textarea name=\"description\" rows=\"3\" cols=\"45\">%s</textarea></p>\n",$description);
	echo "<p>Main content:<br>";
	printf("Textile? <label><input type=\"radio\" name=\"maincontent_textile\" value=\"y\"%s />yes</label> <label><input type=\"radio\" name=\"maincontent_textile\" value=\"n\"%s />no</label><br>", $mt_yeschecked, $mt_nochecked);
	printf("<textarea name=\"maincontent\" rows=\"35\" 	cols=\"45\">%s</textarea></p>\n",$maincontent);
	echo "<p>Sidebar:<br>";
	printf("Textile? <label><input type=\"radio\" name=\"sidebar_textile\" value=\"y\"%s />yes</label> <label><input type=\"radio\" name=\"sidebar_textile\" value=\"n\"%s />no</label><br>", $st_yeschecked, $st_nochecked);
	printf("<textarea name=\"sidebar\" rows=\"25\" 	cols=\"45\">%s</textarea></p>\n",$sidebar);
	echo "<fieldset><legend>Sidebar options</legend>\n";
	printf("<label><input type=\"checkbox\" name=\"styleswitch\" value=\"y\" %s> show style switcher</label>", $styleswitch_checked);
	printf("<label><input type=\"checkbox\" name=\"related\" value=\"y\" %s> show related</label>", $related_checked);
	echo "</fieldset>";

	echo "<p>";
	if (preg_match("/[0-9]+/",$id)) {
		echo "<input type='Submit' name='submitUpdate' value='Update' accesskey='u'>";
	} else {
		echo "<input type='Submit' name='submitAdd' value='Post' accesskey='p'>";
	}
	echo "\n<input type='Submit' name='submitPreview' value='Preview' accesskey='r'>";
	echo "</p>";
	
	echo "<fieldset id='categories'>\n<legend>Category</legend>\n";
	if ($mycategory = mysql_fetch_array($catsresult)) {
		do {
			$category_id = $mycategory["category_id"];
			$category = $mycategory["category"];
			printf("<label><input type='checkbox' name='category_ids[]' value='%s'", $category_id);
			if((is_array($category_id_array) AND in_array($category_id, $category_id_array)) OR (is_array($category_ids) AND in_array($category_id, $category_ids))) {echo " checked='checked'";}
			printf(">%s</label>\n", $category);
		} while ($mycategory = mysql_fetch_array($catsresult));
	} 
	
	echo "<p style='clear:left'><a href='/cms/cats/addwritingcat.php'>Add a new category</a></p>\n";
	echo "</fieldset>\n";
	
	echo "<p>";
		if (preg_match("/[0-9]+/",$id)) {
		echo "<input type='Submit' name='submitUpdate' value='Update' accesskey='u'>";
	} else {
		echo "<input type='Submit' name='submitAdd' value='Post' accesskey='p'>";
	}
	echo "\n<input type='Submit' name='submitPreview' value='Preview' accesskey='r'>";
	echo "</p>";
	
} else {
	echo "<p class='message'>$error</p>";
}
?>
</form>

</div>
</body>
</html>
