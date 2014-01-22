<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
include_once($dr . "/includes/path_to_db.inc.php");
include($dr2 . "/db_connect.php");

// get variables from query
$badurls = (isset($_REQUEST["badurls"]))?$_REQUEST["badurls"]:""; 
$comment_url = (isset($_REQUEST["comment_url"]))?$_REQUEST["comment_url"]:""; 
$comment_id = (isset($_REQUEST["comment_id"]))?$_REQUEST["comment_id"]:""; 
$updatemaster = (isset($_REQUEST["updatemaster"]))?$_REQUEST["updatemaster"]:""; 

$message = "";

# Delete comment if specified
if ($comment_id != "") {
	$sql = "DELETE FROM comments WHERE comment_id = $comment_id LIMIT 1";
	$result = mysql_query($sql);
	if (mysql_affected_rows() > 0) {
		$message = "Comment $comment_id deleted.<br>";
	}  elseif (mysql_error()) {
		$message = "There was a problem trying to delete comment $comment_id.<br>
		MySQL said: ".mysql_error().".<br>";
	} else {
		$message = "Comment $comment_id not deleted.<br>
		MySQL did not report an error so perhaps the comment does not exist.<br>";
	}
}

# Add bad URL to list if specified
if ($comment_url != "") {
	$badurls = $comment_url;
}

# Add URLs to my blacklist and delete from referrers table
if ($badurls != "") {
	# split into an array at each line break
	$newlist = explode("\n", $badurls);
	
	# delete bad url from referrers list
	foreach ($newlist as $badurl) {
		# remove any http:// beginnings and escape forward slashes
		$search = array("http://");
		$replace = array("");
		$badurl = trim(str_replace($search, $replace, $badurl));
		if ($badurl != "") {
			$sql = "DELETE FROM mint_visit WHERE referer LIKE '%$badurl%'";
			$result = mysql_query($sql);
			if (mysql_affected_rows() > 0) {
				$message .= "<br>$badurl deleted from Mint (".mysql_affected_rows()." rows).<br>";
			}  elseif (mysql_error()) {
				$message .= "<br>There was a problem trying to delete referrer $badurl from Mint table.<br> MySQL said: ".mysql_error().".<br>";
			} else {
				$message .= "<br>Referrer $badurl not deleted from Mint table.<br>
				MySQL did not report an error so perhaps the referrer is not listed.<br>";
			}
		}
	}
	
	# get existing blacklist
	$filename = $dr."/blacklist/blacklist.txt";
	$blacklist =  file($filename) or die("Could not read $filename!");
	# merge with new urls with existing blacklist
	$blacklist = array_merge($blacklist, $newlist);
	# clean up each line
	$blacklist = cleanarray($blacklist);
	#write updated file
	$message .= "<br />".writelist($blacklist, $filename);
}


# clean up each line in an array
function cleanarray($mylist) {
	$cleanedmylist = array();
	foreach ($mylist as $linenum=>$linetxt) {
		# remove any http:// beginnings and escape forward slashes
		$search = array("http://");
		$replace = array("");
		$linetxt = str_replace($search, $replace, $linetxt);
		# remove comments
		if (preg_match("/#/", $linetxt)) {
			$linetxt = "";
		}
		# ignore lines without dots, hyphens or underscores
		if (!preg_match("/[\-\.\_]/", $linetxt)) {
			$linetxt = "";
		}
		# remove whitespace
		$linetxt = trim($linetxt);
		if ($linetxt != "") {
			$cleanedmylist[] = $linetxt;
		}
	}
	return $cleanedmylist;
}


# write new list
function writelist($mylist,$filename) {
	# eliminate dupes
	$mylist = array_unique($mylist);
	
	# stick masterlist array into one chunk of text
	$mylist_str = "# Last updated ".gmdate("d-M-Y H:i:s")." GMT \n";
	$mylist_str .= "# Domains blacklisted for comment and referral spamming\n# http://www.clagnut.com/\n# \n# Parsing this file is simple: ignore blank lines and lines\n# that start with a #, any other lines are blacklisted domains\n";
	foreach ($mylist as $bad) {
		$mylist_str .= "$bad\n";
	}
	# line breaks
	$mylist_str = preg_replace("/\r/", "", $mylist_str);
		
	# write new file
	$fh = fopen($filename, "w") or die("Could not open $filename!");
	fwrite($fh, $mylist_str) or die("Could not write to $filename!");
	fclose($fh);
	return "$filename updated!";
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Blacklist</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr. "/includes/cms_headlinks.inc")
?>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr. "/includes/cms_blogs.inc")
?>
</div>
<div id="screen">
<h2>Blacklist</h2>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<h3>Add URLs to blacklist</h3>
<?php
if ($message) {
	echo "<p>$message</p>";
}
?>
<p>Bad URLs (one per line):<br>
<textarea rows="10" cols="40" name="badurls"><?php echo $badurls?></textarea></p>
<p><input type="submit" value="Add URLs" /></p>
</form>
<ul>
	<li><a href="/blacklist/blacklist.txt">my blacklist</a></li>
</ul>
</div>
</body>
</html>
