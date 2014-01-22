<?php
// If magic quotes is turned on then strip slashes
if (get_magic_quotes_gpc()) {
  foreach ($_POST as $key => $value) {
    $_POST[$key] = stripslashes($value);
  }
}

$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// format function
include($dr . "/includes/format.php");
// ping function
//include($dr . "/includes/pingmeal.inc");
//include($dr . "/includes/sendtohost.php");
//include($dr . "/includes/cms_writerssfiles.php");

$message = "";
$error = "";

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:false; 
$meal = (isset($_REQUEST["meal"]))?$_REQUEST["meal"]:false; 
$mealdate = (isset($_REQUEST["mealdate"]))?$_REQUEST["mealdate"]:false; 
$description = (isset($_REQUEST["description"]))?$_REQUEST["description"]:false; 
$rating = (isset($_REQUEST["rating"]))?$_REQUEST["rating"]:false; 
$source_id = (isset($_REQUEST["source_id"]))?$_REQUEST["source_id"]:false; 
$newsource = (isset($_REQUEST["newsource"]))?$_REQUEST["newsource"]:false; 
$isbn = (isset($_REQUEST["isbn"]))?$_REQUEST["isbn"]:false; 
$tags = (isset($_REQUEST["tags"]))?$_REQUEST["tags"]:false; 
$url = (isset($_REQUEST["url"]))?$_REQUEST["url"]:false; 
$submitAdd = (isset($_REQUEST["submitAdd"]))?$_REQUEST["submitAdd"]:false; 
$submitUpdate = (isset($_REQUEST["submitUpdate"]))?$_REQUEST["submitUpdate"]:false; 

$meal = addslashes(trim($meal));
$description = addslashes(trim($description));
$tags = addslashes(trim($tags));
$newsource = addslashes(trim($newsource));

$message = "";

// add new post 
if ($submitAdd) {
	if($source_id == 'new') {
		$sql = "INSERT INTO sources (source_id,source,isbn) VALUES (NULL,'$newsource','$isbn')";
		$result = mysql_query($sql);
		if (mysql_affected_rows() == -1) {
			$message .= "Something barfed when adding a new source. MySQL said:<br>".mysql_error();
		} else {
			$source_id = mysql_insert_id();
		}
	}
	
	$sql = "INSERT INTO meals 
	(meal_id,meal,description,rating,mealdate,source_id,tags,url)
	VALUES (NULL, '$meal', '$description', '$rating', '$mealdate', '$source_id', '$tags', '$url')";
	$result = mysql_query($sql);
	if (mysql_affected_rows() > 0) {
		$id = mysql_insert_id();
		$message .= "Meal added.<br/>";
		
		/*
		# send to delicious
		$d_url = "url=".urlencode("http://clagnut.com/meal/$id/");
		$d_description = "description=".urlencode(stripslashes($title));
		$d_extended = "extended=".urlencode(stripslashes($description));
		$d_tags = "tags=".urlencode(stripslashes($tags));
		$d_dt = "dt=".urlencode(strftime("%Y-%m-%dT%TZ"));
		$d_query = $d_url."&".$d_description."&".$d_extended."&".$d_tags."&".$d_dt;
		$d_url = "https://api.del.icio.us/v1/posts/add?" . $d_query;
		$delicious_submit = htmlentities(curl($d_url, "clagnut", "fugazi"));
		
		# send to ma.gnolia
		$m_title = "title=".urlencode(stripslashes($title));
		$m_description = "description=".urlencode(stripslashes($description));
		$m_url = "url=".urlencode("http://clagnut.com/meal/$id/");
		$m_tags = str_replace(" ", ",", $tags);
		$m_tags = "tags=".urlencode(stripslashes($m_tags));
		$m_private = "private=true";
		$m_apikey = "api_key=fdadc627ba5388c1e25e1f13e7f84ee4e13dbf28";
		$m_query = $m_title."&".$m_url."&".$m_description."&".$m_tags."&".$m_private."&".$m_apikey;
		$magnolia_submit = sendToHost('ma.gnolia.com','post','/api/rest/1/bookmarks_add',$m_query);
		*/
	} else {
		$message .= "There was a problem adding the meal.<br>
		MySQL said: ".mysql_error().".<br />".$sql;
	}
}

// if there is a valid looking ID present
if (preg_match("/[0-9]+/",$id)) {
	
	// if submit has been pressed then update database accordingly
	if ($submitUpdate) {
	    $sql = "UPDATE meals SET
	    meal='$meal', mealdate='$mealdate', description='$description', rating='$rating', source_id='$source_id', tags='$tags', url='$url'
	    WHERE meal_id='$id'";
		$result = mysql_query($sql);
		if (mysql_affected_rows() > 0) {
			$message .= "Meal modified.<br>";
		} elseif (mysql_error()) {
			$message .= "There was a problem.<br>
			MySQL said: ".mysql_error().".<br/>";
		} else {
			$message .= "Meal not modified.<br>
			MySQL didn't report an error so there were probably no changes to make.";
		}
		/*
		// if update or insert OK then update RSS feed
		if ($error == "") {
			$message .= "<br />" . writefullrss();
			$message .= "<br />" . writesummariesrss();
		}
		*/
	}

	// pull meal from database
	$sql = "SELECT meal, source_id, description, rating, mealdate, tags, url, DATE_FORMAT(mealdate, '%Y-%m-%d') AS date FROM meals WHERE meal_id=$id";
	$result = mysql_query($sql);
	if ($mymeal = mysql_fetch_array($result)) {;
		$mealdate = $mymeal["mealdate"];
		$date = $mymeal["date"];
		$meal = $mymeal["meal"];
		$description = $mymeal["description"];
		$rating = $mymeal["rating"];
		$tags = $mymeal["tags"];
		$url = $mymeal["url"];
		$source_id = $mymeal["source_id"];
		# formatting for form controls done further down...
	} else {
		$error = "Error pulling meal from database. Bad id?";
	}

}

// pull categories from db
$sql = "SELECT * FROM sources ORDER BY source";
$sourcesresult = mysql_query($sql);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit meal</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_food.inc")
?>
</div>
<div id="screen">
<h2>Edit meal</h2>

<?php include($dr . "/includes/cms_textilehelp.inc"); ?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" name="post">
<input type="hidden" name="id" value="<?php echo $id ?>">
<?php
if ($message) {echo "<p class='message'>$message</p>";}
if (isset($delicious_submit)) {echo "<p class='message'>$delicious_submit</p>\n";}
if (isset($magnolia_submit)) {echo "<p class='message'>$magnolia_submit</p>\n";}

if ($submitAdd) {
	//echo "<p>pingomatic says: ".pingmeals("Clagnut", "http://www.clagnut.com/", true, "rpc.pingomatic.com", "")."</p>";
}

if (!$error) {
	
	# format for form controls
	$meal = stripslashes(htmlspecialchars($meal));
	$description = stripslashes(htmlspecialchars($description));
	$tags = stripslashes(htmlspecialchars($tags));
	$url = htmlspecialchars($url);
	$date = ($mealdate)?$date:date("Y-m-d");
	printf("<p>Meal: <input type=\"text\" name=\"meal\" value=\"%s\" size=\"50\" maxlength=\"256\">\n", $meal);
	printf("Date: <label><input type=\"text\" name=\"mealdate\" value=\"%s\" size=\"12\" /></label></p>", $date);
?>
	<fieldset id="rating">
	<legend>Rating</legend>
	<label><input type="radio" name="rating" value="1" <?php echo($rating == 1)?"checked='checked'":''; ?>/> 1</label>
	<label><input type="radio" name="rating" value="2" <?php echo($rating == 2)?"checked='checked'":''; ?>/> 2</label>
	<label><input type="radio" name="rating" value="3" <?php echo($rating == 3)?"checked='checked'":''; ?>/> 3</label>
	<label><input type="radio" name="rating" value="4" <?php echo($rating == 4)?"checked='checked'":''; ?>/> 4</label>
	<label><input type="radio" name="rating" value="5" <?php echo($rating == 5)?"checked='checked'":''; ?>/> 5</label>
	</fieldset>
<?php
	echo "<p>Notes:<br>";
	printf("<textarea name=\"description\" rows=\"5\" cols=\"45\">%s</textarea></p>\n",$description);

	echo "<p>Tags (comma separated):<textarea name='tags' rows='2' cols='45'>$tags</textarea></p>\n";
	
	printf("<p>URL of recipe: <label><input type=\"text\" name=\"url\" value=\"%s\" size=\"50\" /></label></p>", $url);
?>	
	<fieldset>
	<legend>Source of recipe</legend>
	<p>Source:
	<select name="source_id">
	<option value="new"> - new - </option>
	<?php
	/* get all source strings from db and display in drop down */
	$sourcelist = mysql_query("SELECT * FROM sources ORDER BY source",$db);
	if ($myrow = mysql_fetch_array($sourcelist)) {
		do {
			printf("<option value='%s'", $myrow["source_id"]);
			if($source_id == $myrow["source_id"]) {echo " selected='selected'";}
			printf(">%s</option>\n", $myrow["source"]);
		} while  ($myrow = mysql_fetch_array($sourcelist));
	}
	?>
	</select>
	<input type="text" name="newsource" size="40" maxlength="255" value="<?php echo $newsource ?>" />
	</p>
	<?php
	$isbn = "";
	if (preg_match("/[0-9]+/",$id)) {
		$sourcelist = mysql_query("SELECT isbn FROM sources WHERE source_id = '$source_id'",$db);
		if ($myrow = mysql_fetch_array($sourcelist)) {
			do {
				$isbn = $myrow["isbn"];
			} while  ($myrow = mysql_fetch_array($sourcelist));
		}
	}
		
	printf("<p>ISBN/URL: <input type=\"text\" name=\"isbn\" value=\"%s\" size=\"20\" maxlength=\"128\"></p>\n", $isbn);
	
	?>
	</fieldset>
<?php	
	
	if (preg_match("/[0-9]+/",$id)) {
		echo "<input type='hidden' name='submitUpdate' value='Update'>
		<input type='Submit' value='Update' accesskey='u'>";
	} else {
		echo "<input type='hidden' name='submitAdd' value='Post'>
		<input type='Submit' value='Post' accesskey='p'>";
	}
} else {
	echo "<p class='message'>$error</p>";
}
?>
</form>
</div>
</body>
</html>
