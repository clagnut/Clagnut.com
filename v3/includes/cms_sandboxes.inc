<h3>Sandbox options</h3>
<ul>
	<li><a href="/cms/sandbox/">Edit sandbox</a></li>
	<li><a href="/cms/sandbox/editsandbox.php">Add sandbox</a></li>
<?php
if (isset($filename)) {
	printf("<li><a href=\"/sandbox/%s/\">View current sandbox</a></li>\n", $filename);
}
?>
</ul>