<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// format function
include($dr . "/includes/format.php");

$message = "";
$error = "";
$action = "Add";

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:""; 
$title = (isset($_REQUEST["title"]))?$_REQUEST["title"]:""; 
$ref_id = (isset($_REQUEST["ref_id"]))?$_REQUEST["ref_id"]:""; 
$filename = (isset($_REQUEST["filename"]))?$_REQUEST["filename"]:""; 
$live = (isset($_REQUEST["live"]))?$_REQUEST["live"]:""; 
$description = (isset($_REQUEST["description"]))?$_REQUEST["description"]:""; 
$submitAdd = (isset($_REQUEST["submitAdd"]))?$_REQUEST["submitAdd"]:""; 
$submitUpdate = (isset($_REQUEST["submitUpdate"]))?$_REQUEST["submitUpdate"]:""; 


$title = addslashes(trim($title));
$description = addslashes(trim($description));
$filename = addslashes(trim($filename));

// add new post 
if ($submitAdd) {
	$sql = "INSERT INTO blogs 
	(title, filename, live, description, ref_id, content_type)
	VALUES ('$title', '$filename', '$live', '$description', '$ref_id', 'sandbox')";
	$result = mysql_query($sql);
	$id = mysql_insert_id();
	if ($result) {
		$message = "Sandbox added successfully. id=".$id;
	} else {
		$error = "MySQL said: ".mysql_error();
		$message = "Failed to add sandbox.";
	}
}

// if there is a valid looking ID present
if (preg_match("/[0-9]+/",$id)) {
	$action = "Edit";
	// if submit has been pressed then update database accordingly
	if ($submitUpdate) {
	    $sql = "UPDATE blogs SET
	    title='$title', filename='$filename', live='$live', description='$description', ref_id='$ref_id'
	    WHERE blog_id='$id'";
	    $result = mysql_query($sql);
		if ($result) {
			$message = "Sandbox updated successfully.";
		} else {
			$error = "MySQL said: ".mysql_error();
			$message = "Failed to update sandbox.";
		}
	}

	// pull sandbox from database
	if (!isset($submitPreview)) {
		$sql = "SELECT title, filename, live, description, ref_id FROM blogs WHERE blog_id=$id";
		$result = mysql_query($sql);
		if ($mysandbox = mysql_fetch_array($result)) {;
			$title = $mysandbox["title"];
			$filename = $mysandbox["filename"];
			$live = $mysandbox["live"];
			$description = $mysandbox["description"];
			$ref_id = $mysandbox["ref_id"];
			$ref_id = ($ref_id == "0")?"":$ref_id;
		} else {
			$message = "Error pulling sandbox from database. Bad id?";
			$error = "MySQL said: ".mysql_error();
		}
	}
	
	// update categories
	if ($submitUpdate OR $submitAdd) {
		// first delete existing entries for the writing
		$sql = "DELETE from categorys_blogs WHERE
		 blog_id=$id";
		$result = mysql_query($sql);
	
		// then mark as sandbox category
		$sql = "INSERT INTO categorys_blogs
				 (blog_id, category_id)
				 VALUES ('$id', '28')";
		$result = mysql_query($sql);
	}
}

// do radio buttons
if ($live == "y") {
	$yeschecked = "checked='checked' ";
	$nochecked = "";
} else {
	$yeschecked = "";
	$nochecked = "checked='checked' ";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?=$action?> sandbox</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_sandboxes.inc")
?>
</div>
<div id="screen">
<h2><?=$action?> sandbox</h2>

<?php include($dr . "/includes/cms_textilehelp.inc"); ?>

<form method="post" action="<?=$_SERVER["PHP_SELF"] ?>" name="post">
<input type="hidden" name="id" value="<?=$id ?>";
<?php
if ($message) {echo "<p class='message'>$message</p>";}

if (!$error) {
	# format for form controls
	$title = stripslashes(str_replace("&", "&amp;", $title));
	$description = stripslashes(str_replace("&", "&amp;", $description));

	printf("<p>Title: <input type=\"text\" name=\"title\" value=\"%s\" size=\"50\" 	maxlength=\"100\"></p>\n", $title);
	printf("<p>Filename: <input type=\"text\" name=\"filename\" value=\"%s\" size=\"50\" 	maxlength=\"64\"></p>\n", $filename);
	printf("<p>Live: <label><input type=\"radio\" name=\"live\" value=\"y\" %s>yes</label> <label><input type=\"radio\" name=\"live\" value=\"n\" %s>no</label></p>", $yeschecked, $nochecked);
	echo "<p>Description:<br>";
	printf("<textarea name=\"description\" rows=\"5\" cols=\"45\">%s</textarea></p>\n",$description);
	printf("<p>Blog ID: <input type=\"text\" name=\"ref_id\" value=\"%s\" size=\"6\" 	maxlength=\"5\"></p>\n", $ref_id);

	echo "<p>";
		if (preg_match("/[0-9]+/",$id)) {
		echo "<input type='Submit' name='submitUpdate' value='Update sandbox' accesskey='u'>";
	} else {
		echo "<input type='Submit' name='submitAdd' value='Add sandbox' accesskey='p'>";
	}
	echo "</p>";
	
} else {
	echo "<p class='message'>$error</p>";
}
?>
</form>

</div>
</body>
</html>
