<?php
if(!$id) {
	Header("Location: /sandboxes/");
}

$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
// add referrer
include($dr . "/includes/addreferrer.php");
include($dr2 . "/db_connect.php");

// format function
include($dr . "/includes/format.php");

// if there is a valid looking ID present
if (preg_match("/[0-9]+/",$id)) {
	if ($preview == "true") {
		$live = "";
	} else {
		$live = " AND live='y'";
	}
	
	// pull sandbox from database
	$sql = "SELECT title, subtext, maincontent_textile, maincontent, sidebar_textile, sidebar, styleswitch, related FROM sandboxes WHERE sandbox_id=$id".$live;
	$result = mysql_query($sql);
	if ($mysandbox = mysql_fetch_array($result)) {
		$title = format($mysandbox["title"]);
		$title = str_replace(array("<p>","</p>"),array("",""),$title);
		$subtext = format($mysandbox["subtext"]);
		$maincontent_textile = $mysandbox["maincontent_textile"];
		$maincontent = $mysandbox["maincontent"];
		if ($maincontent_textile == "y") {
			$maincontent = format($maincontent);
		} else {
			$maincontent = trim($maincontent);
		}
		$sidebar_textile = $mysandbox["sidebar_textile"];
		$sidebar = $mysandbox["sidebar"];
		if ($sidebar_textile == "y") {
			$sidebar = format($sidebar);
		} else {
			$sidebar = trim($sidebar);
		}
		$styleswitch = $mysandbox["styleswitch"];
		$related = $mysandbox["related"];
	} else {
		$message = "Error pulling sandbox from database. Not live or Bad id?";
		$error = "MySQL said: ".mysql_error();
	}

	// pull out categories for this sandbox
	$sql = "SELECT category_id FROM categorys_sandboxes WHERE sandbox_id = '$id'";
	$result = mysql_query($sql);
	if ($mycategory = mysql_fetch_array($result)) {
		do {
			$category_id_array[] = $mycategory["category_id"];
		} while ($mycategory = mysql_fetch_array($result));
	}	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/XHTML1/DTD/XHTML1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title><?=$title?> | clagnut/sandboxes</title>
<?php include($dr . "/includes/headlinks.inc") ?>
</head>
<body>
<?php include($dr . "/includes/header.inc") ?>

<div id="title">
<h1><?=$title?></h1>
<?=$subtext?>
</div> <!-- title -->

<div id="sandbox">

<div id="content">
<?=$maincontent?>
</div> <!-- content -->
<?php
if (strlen($sidebar)>0 OR $styleswitch == "y") {
	echo "<div id=\"act\">\n";
	if (strlen($sidebar)>0) {
		echo "<div id=\"notes\">$sidebar</div>";
	}
	if ($styleswitch == "y") {
		include($dr . "/includes/styleswitch.php");
	}
	echo "</div> <!-- act -->";
}	
?>
</div> <!-- sandbox -->

<?php include($dr . "/includes/footer.php") ?>
</body>
</html>