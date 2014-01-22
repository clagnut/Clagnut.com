<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Send trackback</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript">
function getAction() {
	ping=prompt('Trackback ping:',''); 
	ping=escape(ping);
	document.getElementById('trackback').action = ping;
}
</script>
</head>
<body onload="this.focus(); getAction()">
<form action="#" id="trackback" method="post">
<p><label>title: <input type="text" name="title" value="<?=$link_title?>" size="80" /></label></p>
<p><label>url: <input type="text" name="url" value="<?=$link_url?>" size="80" /></label></p>
<p><label>excerpt: <textarea name="excerpt" rows="2" cols="50"></textarea></label></p>
<p><label>blog name: <input type="text" name="blog_name" value="Clagnut" /></label></p>
<p><input value="Trackback" type="submit" />
</form>
</body>
</html>