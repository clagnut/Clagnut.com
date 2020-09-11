<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
$dr3 = str_replace("/includes/", "", $dr);

include_once($dr . "php_errors.inc.php");

include_once($dr . "path_to_db.inc.php");
include($dr2 . "/db_connect.php");

// format function
include($dr . "/format.php");
// ping function
include($dr . "/pingblog.inc");
include($dr . "/sendtohost.php");
include($dr . "/cms_writerssfiles.php");

$message = "";
$error = "";

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:"";
$title = (isset($_REQUEST["title"]))?$_REQUEST["title"]:"";
$whenlive = (isset($_REQUEST["whenlive"]))?$_REQUEST["whenlive"]:"";
$enable_comments = (isset($_REQUEST["enable_comments"]))?$_REQUEST["enable_comments"]:"";
$blogdate = (isset($_REQUEST["blogdate"]))?$_REQUEST["blogdate"]:"";
$description = (isset($_REQUEST["description"]))?$_REQUEST["description"]:"";
$maincontent = (isset($_REQUEST["maincontent"]))?$_REQUEST["maincontent"]:"";
$mainimage_src = (isset($_REQUEST["mainimage_src"]))?$_REQUEST["mainimage_src"]:"";
$mainimage_alt = (isset($_REQUEST["mainimage_alt"]))?$_REQUEST["mainimage_alt"]:"";
$socialimage_src = (isset($_REQUEST["socialimage_src"]))?$_REQUEST["socialimage_src"]:"";
$socialimage_alt = (isset($_REQUEST["socialimage_alt"]))?$_REQUEST["socialimage_alt"]:"";
$maincontent_textile = (isset($_REQUEST["maincontent_textile"]))?$_REQUEST["maincontent_textile"]:"";
$category_ids = (isset($_REQUEST["category_ids"]))?$_REQUEST["category_ids"]:"";
$tags = (isset($_REQUEST["tags"]))?$_REQUEST["tags"]:"";
$submitAdd = (isset($_REQUEST["submitAdd"]))?$_REQUEST["submitAdd"]:"";
$submitUpdate = (isset($_REQUEST["submitUpdate"]))?$_REQUEST["submitUpdate"]:"";
$submitPreview = (isset($_REQUEST["submitPreview"]))?$_REQUEST["submitPreview"]:"";

$title = addslashes(trim($title));
$description = addslashes(trim($description));
$maincontent = addslashes(trim($maincontent));
$tags = addslashes(trim($tags));

// add new post
if ($submitAdd && !$submitPreview) {
	if ($whenlive == "now") {
		$blogdate = "NOW()";
	} else {
		$blogdate = "'$blogdate'";
	}
	$sql = "INSERT INTO blogs
	(blog_id,title,description,mainimage_src, mainimage_alt,socialimage_src, socialimage_alt, maincontent, blogdate,content_type,enable_comments,tags,maincontent_textile)
//	VALUES ('$id', '$title', '$description', '$mainimage_src', '$mainimage_alt', '$socialimage_src', '$socialimage_alt', '$maincontent', $blogdate, 'blog', '$enable_comments', '$tags','$maincontent_textile')";
	$result = mysqli_query($db, $sql);
	if (mysqli_affected_rows($db) > 0) {
		$id = mysqli_insert_id($db);
		$message = "Post modified.";


		$hostname = $_SERVER["HTTP_HOST"];

		if(!strpos($hostname, ".dev")) {
			# send to delicious
			$d_url = "url=".urlencode("http://clagnut.com/blog/$id/");
			$d_description = "description=".urlencode(stripslashes($title));
			$d_extended = "extended=".urlencode(stripslashes($description));
			$d_tags = str_replace(" ", "", $tags);
			$d_tags = str_replace(",", " ", $d_tags);
			$d_tags = "tags=".urlencode(stripslashes($d_tags));
			$d_dt = "dt=".urlencode(strftime("%Y-%m-%dT%TZ"));
			$d_query = $d_url."&".$d_description."&".$d_extended."&".$d_tags."&".$d_dt;
			$d_url = "https://api.del.icio.us/v1/posts/add?" . $d_query;
			$delicious_submit = htmlentities(curl($d_url, "clagnut", "fugazi"));

			# send to ma.gnolia
			/*
			$m_title = "title=".urlencode(stripslashes($title));
			$m_description = "description=".urlencode(stripslashes($description));
			$m_url = "url=".urlencode("http://clagnut.com/blog/$id/");
			$m_tags = "tags=".urlencode(stripslashes($tags));
			$m_private = "private=true";
			$m_apikey = "api_key=fdadc627ba5388c1e25e1f13e7f84ee4e13dbf28";
			$m_query = $m_title."&".$m_url."&".$m_description."&".$m_tags."&".$m_private."&".$m_apikey;
			$magnolia_submit = sendToHost('ma.gnolia.com','post','/api/rest/1/bookmarks_add',$m_query);
			*/
		} else {
			echo "<p>not pinging cos it's a dev server</p>";
		}
	} else {
		$message = "There was a problem.<br>
		MySQL said: ".mysqli_error($db).".<br />".$sql;
	}
}

// if there is a valid looking ID present
if (preg_match("/[0-9]+/",$id)) {

	// if submit has been pressed then update database accordingly
	if ($submitUpdate && !$submitPreview) {
		if ($whenlive == "now") {
			$blogdate = "NOW()";
		} else {
			$blogdate = "'".$blogdate."'";
		}
	    $sql = "UPDATE blogs SET
	    title='$title', blogdate=$blogdate, description='$description', maincontent='$maincontent', mainimage_src='$mainimage_src', socialimage_src='$socialimage_src', socialimage_alt='$socialimage_alt', maincontent_textile='$maincontent_textile', mainimage_alt='$mainimage_alt', enable_comments='$enable_comments', tags='$tags'
	    WHERE blog_id='$id'";
		#echo "<textarea>".htmlentities($sql)."</textarea>";
		$result = mysqli_query($db, $sql);
		if (mysqli_affected_rows($db) > 0) {
			$message = "Post modified.";
		} elseif (mysqli_error($db)) {
			$message = "There was a problem.<br>
			MySQL said: ".mysqli_error($db).".";
		} else {
			$message = "Post not modified.<br>
			MySQL didn't report an error so there were probably no changes to make.";
		}
		// if update or insert OK then update RSS feed
		if ($error == "") {
			$message .= "<br />" . writefullrss();
			$message .= "<br />" . writesummariesrss();
		}
	}

	// pull blog from database
	if (!$submitPreview) {
		$sql = "SELECT title, enable_comments, description, maincontent, maincontent_textile, mainimage_src, mainimage_alt, socialimage_src, socialimage_alt, blogdate, tags, DATE_FORMAT(blogdate, '%e %b %Y at %H:%i') AS date FROM blogs WHERE blog_id=$id";
		$result = mysqli_query($db, $sql);
		if ($myblog = mysqli_fetch_array($result)) {;
			$blogdate = $myblog["blogdate"];
			$date = $myblog["date"];
			$title = $myblog["title"];
			$description = $myblog["description"];
			$maincontent = $myblog["maincontent"];
			$maincontent_textile = $myblog["maincontent_textile"];
			$mainimage_src = $myblog["mainimage_src"];
			$mainimage_alt = $myblog["mainimage_alt"];
			$socialimage_src = $myblog["socialimage_src"];
			$socialimage_alt = $myblog["socialimage_alt"];
			$tags = $myblog["tags"];
			$enable_comments = $myblog["enable_comments"];
			$thenchecked = "checked='checked' ";
			# formatting for form controls done further down...
		} else {
			$error = "Error pulling blog from database. Bad id?";
		}
	}

	// update categories
	if (!$submitPreview AND ($submitUpdate OR $submitAdd)) {
		// first delete existing entries for the blog
		$sql = "DELETE from categorys_blogs WHERE
		 blog_id=$id";
		$result = mysqli_query($db, $sql);

		// then insert categories
		if (is_array($category_ids)) {
			foreach ($category_ids AS $category_id) {
				$sql = "INSERT INTO categorys_blogs
				 (blog_id, category_id)
				 VALUES ('$id', '$category_id')";
				$result = mysqli_query($db, $sql);
			}
		}
	}

	// pull out categories for this blog

	$sql = "SELECT category_id FROM categorys_blogs WHERE blog_id = '$id'";
	$result = mysqli_query($db, $sql);
	if ($mycategory = mysqli_fetch_array($result)) {
		do {
			$category_id_array[] = $mycategory["category_id"];
		} while ($mycategory = mysqli_fetch_array($result));
	}
} else { //we're in add mode
	// do date live radio buttons
	if ($whenlive == "date") {
		$thenchecked = "checked='checked' ";
		$nowchecked = "";
	} else {
		$thenchecked = "";
		$nowchecked = "checked='checked' ";
		$blogdate = date("Y-m-d H:i:s");
	}
}

// pull categories from db
$sql = "SELECT * FROM categorys ORDER BY category";
$catsresult = mysqli_query($db, $sql);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit Blog</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
include($dr . "/cms_headlinks.inc");
?>
<script type="text/javascript">
function countchars() {
	count = document.post.description.value
	document.post.count.value = 250 - count.length
}
</script>
<script type="text/javascript" src="/js/maketags.js"></script>
</head>
<body onload="countchars(); self.focus()">
<div class="options">
<?php
include($dr . "/cms_options.inc");
include($dr . "/cms_blogs.inc")
?>
</div>
<div id="screen">
<h2>Edit blog</h2>

<?php include($dr . "/cms_textilehelp.inc"); ?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" name="post">
<input type="hidden" name="id" value="<?php echo $id ?>">
<?php
if ($message) {echo "<p class='message'>$message</p>";}
if (isset($delicious_submit)) {echo "<p class='message'>$delicious_submit</p>\n";}
if (isset($magnolia_submit)) {echo "<p class='message'>$magnolia_submit</p>\n";}

if ($submitAdd && !$submitPreview) {
	echo "<p>pingomatic says: ".pingBlogs("Clagnut", "http://www.clagnut.com/", true, "rpc.pingomatic.com", "")."</p>";
}
if (!$error && $submitPreview) {
	# pre-format for preview
	$title = stripslashes($title);
	$description = stripslashes($description);
	$maincontent = stripslashes($maincontent);
	$mainimage_alt = format(stripslashes($mainimage_alt));
	$mainimage_alt = str_replace(array("<p>","</p>"),array("",""),$mainimage_alt);
?>
	<ul id='preview'>
		<li><h3><?php echo str_replace(array("<p>","</p>"),array("",""),format($title))?></h3>
			<p><img src='/images/<?php echo $mainimage_src ?>' alt='<?php echo $mainimage_alt ?>'></p>
			<div id='desc'><?php echo format($description)?></div>
		</li>
		<li>
			<?php echo format($maincontent)?>
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
	$title = stripslashes(htmlspecialchars($title));
	$description = stripslashes(htmlspecialchars($description));
	$maincontent = stripslashes(htmlspecialchars($maincontent));
	$mainimage_alt = stripslashes(htmlspecialchars($mainimage_alt));
	$mainimage_src = stripslashes(htmlspecialchars($mainimage_src));
	$socialimage_src = stripslashes(htmlspecialchars($socialimage_src));
	$socialimage_alt = stripslashes(htmlspecialchars($socialimage_alt));
	$date = (isset($date))?$date:"";
	$nowchecked = (isset($nowchecked))?$nowchecked:"";
	$thenchecked = (isset($thenchecked))?$thenchecked:"";
	printf("<p>ID: <input type=\"text\" name=\"id\" value=\"%s\" size=\"4\"></p>\n", $id);
	printf("<p>Title: <input type=\"text\" name=\"title\" value=\"%s\" size=\"50\" 	maxlength=\"100\"> %s</p>\n", $title, $date);
	printf("<p>Live date: <label><input type=\"radio\" name=\"whenlive\" value=\"now\" %s>now</label> <label><input type=\"radio\" name=\"whenlive\" value=\"date\" %s>on this date:</label><input type=\"text\" name=\"blogdate\" value=\"%s\" size=\"40\" maxlength=\"100\" onclick=\"document.forms[0].whenlive[1].checked=true\"></p>", $nowchecked, $thenchecked, $blogdate);
	echo "<p>Enable comments? <label><input type='radio' name='enable_comments' value='yes' ";
	if ($enable_comments != "no") {echo "checked='checked'";}
	echo "/>yes</label>";
	echo "<label><input type='radio' name='enable_comments' value='no' ";
	if ($enable_comments == "no") {echo "checked='checked'";}
	echo  "/>no</label>";
	echo "</p>";
	echo "<p>Textile enabled? <label><input type='radio' name='maincontent_textile' value='y' ";
	if ($maincontent_textile != "n") {echo "checked='checked'";}
	echo "/>yes</label>";
	echo "<label><input type='radio' name='maincontent_textile' value='n' ";
	if ($maincontent_textile == "n") {echo "checked='checked'";}
	echo  "/>no</label>";
	echo "</p>";
	echo "<p>Description:<br>";
	printf("<textarea name=\"description\" rows=\"3\" cols=\"45\" onkeypress='countchars()' onkeyup='countchars()'>%s</textarea><br><input name='count' type='text' size='4'></p>\n",$description);
	echo "<p>Main image:<br>";
	printf("/images/<input type='text' name=\"mainimage_src\" value='%s' size='30'> alt: <input name='mainimage_alt' type='text' value='%s' size='50'></p>\n",$mainimage_src, $mainimage_alt);
	
	echo "<p>Social image:<br>";
	printf("/images/<input type='text' name=\"socialimage_src\" value='%s' size='30'> alt: <input name='socialimage_alt' type='text' value='%s' size='50'></p>\n",$socialimage_src, $socialimage_alt);
	echo "<p>Main content:<br>";
	printf("<textarea name=\"maincontent\" rows=\"20\" 	cols=\"45\">%s</textarea></p>\n",$maincontent);

	if (preg_match("/[0-9]+/",$id)) {
		echo "<input type='Submit' name='submitUpdate' value='Update' accesskey='u'>";
	} else {
		echo "<input type='Submit' name='submitAdd' value='Post' accesskey='p'>";
	}
	echo "\n<input type='Submit' name='submitPreview' value='Preview' accesskey='r'>";

	echo "<fieldset>\n<legend>Category</legend>\n";
	if ($mycategory = mysqli_fetch_array($catsresult)) {
		do {
			$category_id = $mycategory["category_id"];
			$category = $mycategory["category"];
			printf("<label><input type='checkbox' name='category_ids[]' value='%s' onclick='makeTags(this, this.form)'", $category_id);
			if((isset($category_id_array) AND is_array($category_id_array) AND in_array($category_id, $category_id_array)) OR (is_array($category_ids) AND in_array($category_id, $category_ids))) {echo " checked='checked'";}
			printf(">%s</label>\n", $category);
		} while ($mycategory = mysqli_fetch_array($catsresult));
	}
	echo "<p style='clear:left'><a href='/cms/cats/addblogcat.php'>Add a new category</a></p>\n";
	echo "</fieldset>\n";
	echo "<p>Tags: <textarea name='tags' rows='2' cols='45'>$tags</textarea> <strong>comma</strong> separated</p>\n";

	if (preg_match("/[0-9]+/",$id)) {
		echo "<input type='hidden' name='submitUpdate' value='Update'>
		<input type='Submit' value='Update' accesskey='u'>";
	} else {
		echo "<input type='hidden' name='submitAdd' value='Post'>
		<input type='Submit' value='Post' accesskey='p'>";
	}
	echo "\n<input type='Submit' name='submitPreview' value='Preview' accesskey='r'>";
} else {
	echo "<p class='message'>$error</p>";
}
?>
</form>
</div>
</body>
</html>
