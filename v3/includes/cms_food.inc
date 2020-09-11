<h3>Food options</h3>
<ul>
	<li><a href="/cms/food/">Edit meal</a></li>
	<li><a href="/cms/food/editmeal.php">Add meal</a></li>
<?php
if ($id) {
	printf("<li><a href=\"/food/meal.php?id=%s\">View current meal</a></li>\n", $id);
}
?>
</ul>