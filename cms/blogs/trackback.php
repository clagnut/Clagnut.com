<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// format function
include($dr . "/includes/format.php");

// get variables from query
$id = $_REQUEST["id"];

// if there is a valid looking ID present
if (preg_match("/[0-9]+/",$id)) {
	
	// pull blog from database
	$sql = "SELECT title, description, maincontent FROM blogs WHERE blog_id=$id";
	$result = mysql_query($sql);
	if ($myblog = mysql_fetch_array($result)) {;
		$title = $myblog["title"];
		$description = $myblog["description"];
		$maincontent = $myblog["maincontent"];
		# formatting for form controls done further down...
	} else {
		$error = "Error pulling blog from database. Bad id?";
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Send Trackback</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include($dr . "/includes/cms_headlinks.inc"); ?>
</head>
<body onload="this.focus()">
<h2>Send Trackback</h2>

<form action="/cms/blogs/trackback_ping.php" method="post">
<?php
if ($error) {echo "<p class='message'>$error</p>";}

$title = strip_tags(format($title));
$description = strip_tags(makeDescription($maincontent,$description));

# format for form controls
$title = stripslashes(htmlentities($title));
$description = stripslashes(htmlentities($description));
?>

<p><label>title: <input type="text" name="title" value="<?=$title?>" size="80" /></label></p>
<p><label>url: <input type="text" name="url" value="https://clagnut.com/blog/<?=$id?>/" size="80" /></label></p>
<p><label>excerpt: <textarea name="excerpt" rows="2" cols="50"><?=$description?></textarea></label></p>
<p><label>blog name: <input type="text" name="blog_name" value="Clagnut" /></label></p>
<p><label>trackback URL: <input type="text" name="ping" value="" size="80" /></label></p>
<p><input value="Trackback" type="submit" /></p>
</form>
</body>
</html>
