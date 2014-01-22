<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Newsletter</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
include($dr . "/includes/cms_headlinks.inc");
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_newsletter.inc")
?>
</div>
<div id="screen">
<h2>Newsletter</h2>
<h3>New subscriptions</h3>
<?php
// connect to database
$db = mysql_connect("localhost","clagnut","fugazi");
mysql_select_db("clagnut",$db);

// make new old
if ($makeold) {
    $sql = "UPDATE mailinglist SET
    new='0' WHERE new='1'";
    $result = mysql_query($sql);
	echo "<p>New subscribers made old.</p>";
}


// do unsubscribe
if ($unsubscribe) {
	$sql = "DELETE FROM mailinglist WHERE email='$unsubscribe'";
	$result = mysql_query($sql);
	$message = $unsubscribe." is now unsubscribed from the clagnut.com newsletter.\r\n\r\n"
	."This is the last email you will receive from this address.  Sorry to see you go.\r\n\r\n"
	."Richard Rutter\r\nwww.clagnut.com\r\n\r\n"
	."---\r\n"
	."To resubscribe: http://www.clagnut.com/list/?subscribe=".$unsubscribe."\r\n";
	$header = "From: Richard Rutter <rich@clagnut.com>\r\n"
	."Reply-To: rich@clagnut.com";
	mail($unsubscribe, "clagnut.com newsletter unsubscribe", $message, $header);
	print "<p>".$unsubscribe." is now unsubscribed.</p>";
}

// get list of new users from database
$sql = "SELECT mail_id, email FROM mailinglist WHERE new='1'";
$result = mysql_query($sql);
$myemail = mysql_fetch_array($result);

if($myemail) {
    echo "<ul>";
    do {
		printf("<li>[<a href=\"%s?unsubscribe=%s\">unsub</a>] %s</li>\n",
    	 $PHP_SELF, $myemail["email"], $myemail["email"]);
	} while ($myemail = mysql_fetch_array($result)); 
    echo "</ul>";
} else {
    echo "<p>No new signups</p>";
}
print "<p><a href='".$PHP_SELF."?makeold=1'>Make new subscribers old</a></p>";
?>

</div>
</body>
</html>
