<?php
$dr = $_SERVER["DOCUMENT_ROOT"];

// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// get variables from query
$action = (isset($_REQUEST["action"]))?$_REQUEST["action"]:""; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Make new old</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php include($dr . "/includes/cms_headlinks.inc"); ?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_music.inc")
?>
</div>
<div id="screen">
<h2>Current New Titles</h2>
<?php


if ($action == "new2old") {
	$sql = "UPDATE music SET new='0' WHERE new='1'";
	$result = mysql_query($sql);
}

/* get results of new stuff */
$new = mysql_query("
	SELECT artists.artist, title
	FROM music, artists
	WHERE new='1'
	AND artists.artist_id = music.artist
	ORDER BY artist, title",$db);
	
if ($myrow = mysql_fetch_array($new)) {
	echo "<ul class='nobullets'>\n";
	do {
		printf("<li>%s<br />&nbsp; <cite>%s</cite></li> \n", $myrow["artist"], $myrow["title"]);
	} while ($myrow = mysql_fetch_array($new));
	echo "</ul>\n";
} else {
	echo"<P>No recent purchases.</P>";
}

printf("<p><a href=\"%s?action=new2old\">Make all new entries old now</a></p>",$_SERVER["PHP_SELF"]);
?>
</div>
</body>
</html>
