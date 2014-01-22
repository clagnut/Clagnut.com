<?php
// get variables from query
$ping= $_REQUEST["ping"];
$title = $_REQUEST["title"];
$url= $_REQUEST["url"];
$excerpt = $_REQUEST["excerpt"];
$blog_name = $_REQUEST["blog_name"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Send trackback</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body onload="document.trackback.submit()">
<form action="<?=$ping?>" method="post" name="trackback">
<p><label>title: <input type="text" name="title" value="<?=htmlentities($title)?>" size="80" /></label></p>
<p><label>url: <input type="text" name="url" value="<?=htmlentities($url)	?>" size="80" /></label></p>
<p><label>excerpt: <textarea name="excerpt" rows="2" cols="50"><?=htmlentities($excerpt)?></textarea></label></p>
<p><label>blog name: <input type="text" name="blog_name" value="<?=htmlentities($blog_name)?>" /></label></p>
<p><input value="Trackback" type="submit" /></p>
</form>
</body>
</html>