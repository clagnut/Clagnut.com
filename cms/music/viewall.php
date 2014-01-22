<?php
// get variables from query
$view = (isset($_REQUEST["view"]))?$_REQUEST["view"]:false; 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>View all music</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
include($dr . "/includes/cms_headlinks.inc");
?>
<style type="text/css">
.artist {
	font-weight:bold;
}

.title {
	font-style:italic;
}

@media print {
	#screen {
		color:#000000;
		margin-left:1em;
	}
	
	P.music {
		font-family:arial, helvetica, geneva, sans-serif;
		font-size:7pt;
		line-height:1em;
		margin-top:0.75em;
		margin-bottom:0;
	}

	.format, .notes {
		font-size:6pt;
	}

	.options, #viewalloptions {
		display:none;
	}
}
</style>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_music.inc")
?>
</div>
<div id="screen">
<h2>View all music</h2>
<div id="viewalloptions">
<ul>
	<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?view=cd">View all CDs</a></li>
	<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?view=7">View all 5", 7" &amp; flexi vinyl</a></li>
	<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?view=10">View all 9" &amp; 10" vinyl</a></li>
	<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?view=12">View all 12" vinyl</a></li>
	<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?view=other">View all other formats</a></li>
</ul>

<ul>
	<li><a href="<?php echo $_SERVER["PHP_SELF"] ?>?view=all">View entire collection</a></li>
</ul>
</div>
<?php
// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

if ($view) {
	if($view == "cd") {$filter = "(music.format = 1 OR music.format = 10) AND"; $desc = "All CDs";}
	if($view == "7") {$filter = "(music.format = 5 OR music.format = 6 OR music.format = 7) AND"; $desc = "All 5\", 7\" &amp; flexi vinyl";}
	if($view == "10") {$filter = "(music.format = 3 OR music.format = 4) AND"; $desc = "All 9\" &amp; 10\" vinyl";}
	if($view == "12") {$filter = "music.format = 2 AND"; $desc = "All 12\" vinyl";}
	if($view == "other") {$filter = "(music.format = 8 OR music.format = 9) AND"; $desc = "All other formats";}
	if($view == "all") {$filter = ""; $desc = "Entire collection";}
	$sql = "
	SELECT artists.artist, title, formats.format, types.type, year, labels.label, purchasedate, notes
	FROM artists, music, types, formats, labels
	WHERE ".$filter."
	 music.artist = artists.artist_id
 	 AND music.label = labels.label_id
	 AND types.id = music.type
	 AND formats.id = music.format
	ORDER BY format, artist, type, title, notes";
	$records = mysql_query($sql,$db);
	if ($myrow = mysql_fetch_array($records)) {
		printf("<h3>%s</h3>",$desc);
		$count = mysql_num_rows($records);
		printf("<p class='smallnote'>There are <strong>%s</strong> matching records.</p>",$count);
		do {
			printf("<p class='music'><span class='artist'>%s</span> &#8211; <span class='title'>%s</span> &nbsp; <span class='format'>[%s %s] &nbsp; %s %s &nbsp; (bought %s)</span> <br> <span class='notes'>%s</span></p> \n",
$myrow["artist"], $myrow["title"], $myrow["format"], $myrow["type"], $myrow["year"], $myrow["label"], $myrow["purchasedate"], $myrow["notes"]);
		} while  ($myrow = mysql_fetch_array($records));
	} else {
		echo "MySQL problem.";	
	}
}
?>

</div>
</body>
</html>
