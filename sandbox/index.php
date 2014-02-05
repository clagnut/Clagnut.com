<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
// add referrer
include($dr . "/includes/addreferrer.php");
include($dr2 . "/db_connect.php");
// format function
include($dr . "/includes/format.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>clagnut sandbox</title>
<?php include($dr . "/includes/headlinks.inc");?>
<style type="text/css" media="screen"><!--
@import "/css/index.css";
--></style>
</head>

<body>
<?php include($dr . "/includes/header.inc") ?>

<div id="title">
<h1>Sandbox</h1>
</div> <!-- title -->

<table cellspacing="0" id="index" summary="Two column table listing all experiments in right column. Left hand column contains a thumbnail">
<tr><th scope="col"><span style="visibility:hidden">Thumbnail</span></th>
<th scope="col">Experiments</th>
</tr>
<tr><th scope="row"><img src="/images/sandbox.jpg" alt="Sandbox" /></th><td>
<?php
// get list of sandboxes
$sql2 = "SELECT title, description, filename FROM blogs WHERE live = 'y' AND content_type='sandbox' ORDER BY tstamp DESC";
$result = mysql_query($sql2);
$mysandbox = mysql_fetch_array($result);
if($mysandbox) {
	echo "	<dl>\n";
	do {
		$title = format($mysandbox["title"]);
		$title = str_replace(array("<p>","</p>"),array("",""),$title);
		$description = format($mysandbox["description"]);
		$filename = $mysandbox["filename"];
		echo "		<dt><a href='/sandbox/$filename/'>$title</a></dt>\n";
		echo "		<dd>$description</dd>\n";
	} while ($mysandbox = mysql_fetch_array($result));
	echo "	</dl>\n";
} else {
	echo mysql_error();
	echo "<p>No sandbox experiments.</p>";
}
?>
</td></tr>
</table>

<?php include($dr . "/includes/footer.php") ?>
</body>
</html>