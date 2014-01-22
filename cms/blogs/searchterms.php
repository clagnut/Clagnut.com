<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Search terms</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr."/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr."/includes/cms_options.inc");
include($dr."/includes/cms_blogs.inc");
?>
</div>
<div id="screen">
<h2>Search terms</h2>
<h3>Unsuccessful searches</h3>
<?php
include($dr2 . "/db_connect.php");
// pull search terms from database
$sql = "SELECT term, count(term) AS counter, DATE_FORMAT(tstamp, '%a %e %b %Y %T') as date FROM searchterms WHERE success = '0' GROUP BY term ORDER BY tstamp DESC";
$result = mysql_query($sql);
$myterms = mysql_fetch_array($result);
if ($myterms) {
	echo "<ol>\n";
	do {
	$myterm = addslashes($myterms["term"]);
		printf("<li value='%s'><a href='/search/?q=%s'>%s</a> (%s)</li>\n", $myterms["counter"], $myterm, $myterm, $myterms["date"]);
	} while ($myterms = mysql_fetch_array($result));
	echo "</ol>\n";
}
?>
</p></div>
</body>
</html>
