<h3>Blog options</h3>
<ul>
	<li><a href="/cms/blogs/">Edit blog</a></li>
	<li><a href="/cms/blogs/editblog.php">Add blog</a></li>
<?php
if (isset($id)) {
	printf("<li><a href=\"/blog/?id=%s\">View current blog</a></li>\n", $id);
}
?>
	<li><a href="/cms/blogs/searchterms.php">View search terms</a></li>
</ul>