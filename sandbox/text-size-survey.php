<?php
$filename = "text-size-survey";

$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);

include($dr . "/includes/sandbox_getdetails.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$title?> | clagnut/sandbox</title>
<style type="text/css">
@import url(/css/sandbox.css);
table {
	width:99%;
}
th {
	width:2em;
	text-align:left;
}
td div {
	background:#cfb997;
	padding-left:0.25em;
}
iframe {
	width:99%;
	height:12em;
	border:1px solid #ddd;
}
</style>
<script src="/mint/?js" type="text/javascript"></script>
</head>

<body>
<h4 id="logo"><a href="/"><img src="/images/clagnut.png" alt="Clagnut" /></a></h4>
<div id="content">
<div id="intro">
<?php include($dr . "/includes/sandbox_intro.php"); ?>
</div> <!-- /intro -->

<h2>The results</h2>

<p>Text size was calculated in pixels. The distribution was as follows:</p>

<?php
// get text sizes from database
$sql = "SELECT count(*) AS counter, textsize FROM textsize GROUP BY textsize ORDER BY textsize";
$result = mysql_query($sql);
$textsizes = mysql_fetch_array($result);
if($textsizes) {
    do { // prints an sandbox's details
		$textsize[] = $textsizes["textsize"];
		$counter[] = $textsizes["counter"];		
	} while ($textsizes = mysql_fetch_array($result));

    echo "<table>";
    $totalcount = array_sum($counter);
    $maxnum = max($counter);
    $maxproportion = $maxnum / $totalcount;
    foreach ($textsize AS $key=>$size) {
    	$percentage = round($counter[$key] / $totalcount * 100, 1);
    	$width = $counter[$key] / $maxnum * 100;
		echo "<tr><th scope='row'>$size</th><td><div style='width:$width%'>$percentage%</div></td></tr>";
	}
	echo "</table>";
} else {
        echo "<p>Either no text size has been collectd or something went wrong extracting it from the database.</p>";
}
?>

<p>So as you can see, 16px is by far the most common visitor's default browser text size. This also corresponds to most browser's default text size.</p>

<h2>Methodology</h2>

<p>I will be posting my methodology, assumptions and files shortly.</p>

<h2>The include in action</h2>

<p><iframe src="/textsize.php"><a href="/textsize.php">A widget to collect text size data</a>.</iframe></p>

</div> <!-- /content -->
<?php include($dr . "/includes/sandbox_footer.php");?>

</body>
</html>