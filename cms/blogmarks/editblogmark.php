<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// format function
include($dr . "/includes/format.php");
include($dr . "/includes/sendtohost.php");
include($dr . "/includes/cms_writerssfiles.php");

$message = "";
$error = "";

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:false;
$popup = (isset($_REQUEST["popup"]))?$_REQUEST["popup"]:false;
$link_title = (isset($_REQUEST["link_title"]))?$_REQUEST["link_title"]:false;
$link_url = (isset($_REQUEST["link_url"]))?$_REQUEST["link_url"]:false;
$link_comment = (isset($_REQUEST["link_comment"]))?$_REQUEST["link_comment"]:false;
$via_title = (isset($_REQUEST["via_title"]))?$_REQUEST["via_title"]:false;
$via_url = (isset($_REQUEST["via_url"]))?$_REQUEST["via_url"]:false;
$category_ids = (isset($_REQUEST["category_ids"]))?$_REQUEST["category_ids"]:false;
$tags = (isset($_REQUEST["tags"]))?$_REQUEST["tags"]:false;
$blogmarkdate = (isset($_REQUEST["blogmarkdate"]))?$_REQUEST["blogmarkdate"]:false;
$submitUpdate = (isset($_REQUEST["submitUpdate"]))?$_REQUEST["submitUpdate"]:false;
$submitAdd = (isset($_REQUEST["submitAdd"]))?$_REQUEST["submitAdd"]:false;

$link_title = addslashes(trim($link_title));
$link_url = addslashes(trim($link_url));
$link_comment = addslashes(trim($link_comment));
$via_title = addslashes(trim($via_title));
$via_url = addslashes(trim($via_url));
$tags = addslashes(trim($tags));


// add URL referrer title if this is a automated add
if ($popup == "true" && !$submitAdd && !$submitUpdate && $via_url != "") {
	if ($open=@fopen("$via_url","r")) {
		while(!feof($open)) {
	    	$line=@fgets($open, 1024);
			$string = $line;
			while(eregi( '<title>([^<]*)</title>(.*)', $string, $regs ) ) {
				$string = $regs[2];	
				break 2;
			}
		}
		$via_title = $regs[1];
	} else {
		$via_title = " - could not open referrer page -";
	}
}


// add new post 
if ($submitAdd) {
	$sql = "INSERT INTO blogs 
	(title,filename,description,via_title,via_url,blogdate, content_type, tags)
	VALUES ('$link_title', '$link_url', '$link_comment', '$via_title', '$via_url', '$blogmarkdate','blogmark', '$tags')";
	$result = mysql_query($sql);
	$id = mysql_insert_id();
	if (mysql_affected_rows() > 0) {
		$message = "Blogmark added. id=$id";
		
		# send to delicious
		$d_url = "url=".urlencode($link_url);
		$d_description = "description=".urlencode(stripslashes($link_title));
		$d_extended = "extended=".urlencode(stripslashes($link_comment));
		$d_tags = str_replace(" ", "", $tags);
		$d_tags = str_replace(",", " ", $d_tags);
		$d_tags = "tags=".urlencode(stripslashes($d_tags));
		$d_dt = "dt=".urlencode(strftime("%Y-%m-%dT%TZ"));
		$d_query = $d_url."&".$d_description."&".$d_extended."&".$d_tags."&".$d_dt;
		$d_url = "https://api.del.icio.us/v1/posts/add?" . $d_query;
		$delicious_submit = htmlentities(curl($d_url, "clagnut", "fugazi"));
		
		# send to ma.gnolia
		/*
		$m_title = "title=".urlencode(stripslashes($link_title));
		$m_description = "description=".urlencode(stripslashes($link_comment));
		$m_url = "url=".urlencode($link_url);
		$m_tags = "tags=".urlencode(stripslashes($tags));
		$m_private = "private=true";
		$m_apikey = "api_key=fdadc627ba5388c1e25e1f13e7f84ee4e13dbf28";
		$m_query = $m_title."&".$m_url."&".$m_description."&".$m_tags."&".$m_private."&".$m_apikey;
		$magnolia_submit = sendToHost('ma.gnolia.com','post','/api/rest/1/bookmarks_add',$m_query);
		*/
	} else {
		$message = "There was a problem trying to add the blogmark.<br>
		MySQL said: ".mysql_error().".";
	}
}

// if there is a valid looking ID present
if (preg_match("/[0-9]+/",$id)) {
	$formAction = "Edit";
	
	// if submit has been pressed then update database accordingly
	if ($submitUpdate) {
	    $sql = "UPDATE blogs SET
	    title='$link_title', filename='$link_url', description='$link_comment', via_title='$via_title', via_url='$via_url', tags='$tags'
	    WHERE blog_id='$id'";
		#echo "<textarea>".htmlentities($sql)."</textarea>";
		$result = mysql_query($sql);
		if (mysql_affected_rows() > 0) {
			$message = "Blogmark modified.";
		} elseif (mysql_error()) {
			$message = "There was a problem trying to update the blogmark.<br>
			MySQL said: ".mysql_error().".";
		} else {
			$message = "Blogmark not modified.<br>
			MySQL didn't report an error so there were probably no changes to make.";
		}
	}

	// pull blogmark from database
	$sql = "SELECT title, filename, description, via_title, via_url, blogdate, tags FROM blogs WHERE blog_id=$id";
	$result = mysql_query($sql);
	if ($myblogmark = mysql_fetch_array($result)) {;
		$link_title = $myblogmark["title"];
		$link_url = $myblogmark["filename"];
		$link_comment = $myblogmark["description"];
		$via_title = $myblogmark["via_title"];
		$via_url = $myblogmark["via_url"];
		$blogmarkdate = $myblogmark["blogdate"];
		$tags = $myblogmark["tags"];
		# formatting for form controls done further down...
	} else {
		$error = "Error pulling blogmark from database. Bad id?";
	}
	
	// update categories
	if ($submitUpdate OR $submitAdd) {
		// first delete existing entries for the blogmark
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
		// if update or insert OK then update RSS feed
		if ($error == "") {$error = writeblogmarkrss();}
	}

	
	// pull out categories for this blogmark

	$sql = "SELECT category_id FROM categorys_blogs WHERE blog_id = '$id'";
	$result = mysql_query($sql);
	if ($mycategory = mysql_fetch_array($result)) {
		do {
			$category_id_array[] = $mycategory["category_id"];
		} while ($mycategory = mysql_fetch_array($result));
	}	
} else { //we're in add mode

	$formAction = "Add";
	$blogmarkdate = date("Y-m-d");
}

// pull categories from db
$sql = "SELECT * FROM categorys ORDER BY category";
$catsresult = mysql_query($sql);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit blogmark</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript">
self.focus()
</script>
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
<script type="text/javascript" src="/js/maketags.js"></script>
</head>
<body onload="this.focus()">
<?php
if ($popup !=true) {
	echo "<div class='options'>\n";
	include($dr . "/includes/cms_options.inc");
	include($dr . "/includes/cms_blogmarks.inc");
	echo "</div>\n";
	echo "<div id='screen'>\n";
} else {
	echo "<div>\n";
}
?>

<h2><?php echo $formAction?> blogmark</h2>

<form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="blogmark">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="popup" value="<?php echo $popup ?>">
<?php
if ($message) {echo "<p class='message'>$message</p>\n";}
if ($error) {echo "<p class='message'>$error</p>\n";}
if (isset($delicious_submit)) {echo "<p class='message'>delicious: $delicious_submit</p>\n";}
if (isset($magnolia_submit)) {echo "<p class='message'>$magnolia_submit</p>\n";}
?>

<p>Link title: <input type="text" name="link_title" value="<?php echo $link_title?>" maxlength="255" size='64' /></p>
<p>Link URL: <input type="text" name="link_url" value="<?php echo $link_url?>" maxlength="255" size='64' /> <a href="<?php echo $link_url?>">test</a></p>
<p>Comment: <input type="text" name="link_comment" value="<?php echo $link_comment?>" size="64" /></p>
<p>Category:
<?php
	if ($mycategory = mysql_fetch_array($catsresult)) {
		echo "<select name='category_ids[]' multiple='multiple' size='6' onclick='makeTags(this, this.form)'>\n";
		do {
			$category_id = $mycategory["category_id"];
			$category = htmlentities($mycategory["category"]);
			printf("<option value='%s'", $category_id);
			if(isset($category_id_array) && (is_array($category_id_array) AND in_array($category_id, $category_id_array)) OR (is_array($category_ids) AND in_array($category_id, $category_ids))) {echo " selected='selected'";}
			printf(">%s</option>\n", $category);
		} while ($mycategory = mysql_fetch_array($catsresult));
		echo "</select>";
	} else {
		echo "no categories found\n";
	}

?>
</p>
<p>Tags: <input type="text" name="tags" value="<?php echo $tags?>" maxlength="128" size='64' /> <strong>comma</strong> separated</p>
<p>Date: <input type="text" name="blogmarkdate" value="<?php echo $blogmarkdate?>" maxlength="255" size="10" /> yyyy-mm-dd</p>
<?php
if (preg_match("/[0-9]+/",$id)) {
	echo "<input type='Submit' name='submitUpdate' value='Update blogmark' accesskey='u'>";
} else {
	echo "<input type='Submit' name='submitAdd' value='Add blogmark' accesskey='p'>";
}
?>
<input type="reset" />
</form>
</div>
</body>
</html>
