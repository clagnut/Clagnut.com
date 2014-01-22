<h3>Writing options</h3>
<ul>
	<li><a href="/cms/writings/">Edit writing</a></li>
	<li><a href="/cms/writings/editwriting.php">Add writing</a></li>
<?php
if ($id) {
	printf("<li><a href=\"/writings/writing.php?id=%s&amp;preview=true\">View current writing</a></li>\n", $id);
}
?>
</ul>