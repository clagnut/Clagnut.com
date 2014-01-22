<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");
include($dr . "/includes/format.php");
// include($dr . "/includes/cms_writerssfiles.php");

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:""; 
$del = (isset($_REQUEST["del"]))?$_REQUEST["del"]:""; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Edit Food</title>
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
<h2>Edit a Meal</h2>
<?php

// if delete has been pressed and and id is present then delete
if ($del && $id) {
    $sql = "DELETE FROM meals WHERE meal_id='$id'";
    $result = mysql_query($sql);
	if ($result) {
	    echo "<p>Meal deleted!</p>";
	    // echo writefullrss();
		// echo writesummariesrss();
	} else {
		echo "<p>Error deleting meal.</p>\n";
		echo "<p>".mysql_error()."</p>";
	}
}

// get list of meals from database
$sql = "SELECT meal_id, meal, DATE_FORMAT(mealdate, '%e %b %Y') AS date FROM meals ORDER BY mealdate DESC";
$result = mysql_query($sql);
$mymeal = mysql_fetch_array($result);
if($mymeal) { // checks if any meals have been returned from database
    echo "<ol>";
	do { // prints an meal's details
		$meal = $mymeal["meal"];
		if ($meal=="") {$meal="&nbsp;__&nbsp;";}
		printf("<li value='%s'>[<a href=\"%s?del=1&id=%s\" onclick=\"return confirm('Are you sure you want to delete this meal?')\">del</a>]
	     <a href=\"editmeal.php?id=%s\">%s</a> %s</li>\n", $mymeal["meal_id"],
    	 $_SERVER["PHP_SELF"], $mymeal["meal_id"],
	     $mymeal["meal_id"], $meal, $mymeal["date"]);
	} while ($mymeal = mysql_fetch_array($result)); // loops back through $mymeal array for each meal returned from database
	echo "</ol>";
} else {
        echo "<p>No meals as yet.</p>";
}
?>
</div>
</body>
</html>
