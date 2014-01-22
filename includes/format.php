<?php
// If magic quotes is tuned on then strip slashes
if (get_magic_quotes_gpc()) {
  foreach ($_POST as $key => $value) {
    $_POST[$key] = stripslashes($value);
  }
}

include($dr . "/includes/textile.php");

function preformat($text) {
	if (preg_match("/^<p>/",$text)){
		$text = str_replace("\n", "", $text);
	}
	$search = array ("\\", "'mare", "'flu", "'Flu", "---", "--", "<br />", "@media", "@font-face");
	$replace = array ("\\\\", "&#8217;mare", "&#8217;flu", "&#8217;Flu", "\nnewsection\n", "-", "\n", "&#64;media", "&#64;font-face");
	$text = str_replace($search, $replace, $text);
	return $text;
}

function format($text) {
	$text = preformat($text);
	$text = textile($text);
	
	# get amazon store
	$amz_dest = (isset($_COOKIE["amz_dest"]))? $_COOKIE["amz_dest"] : "uk";
	$amz_affil["uk"] = array(".co.uk", "jalfrezi-21", "UK and the rest of Europe");
	$amz_affil["ca"] = array(".ca", "clagnut0d-20", "Canada");
	$amz_affil["com"] = array(".com", "clagnut-20", "US and the rest of the world");
	
	$search = array (
		"<p><p",
		"</p></p>",
		"<p>newsection</p>",
		"newsection<br />",
		"<p><address",
		"</address></p>",
		"<p><form",
		"</form></p>",
		"<p><table",
		"<table><br />",
		"</table></p>",
		"</table><br />",
		"</tr><br />",
		"</th><br />",
		"</td><br />",
		"</thead><br />",
		"</tfoot><br />",
		"</tbody><br />",
		"</caption><br />",
		" title=\"\"",
		"<pre>",
		"</pre>",
		"<p><a imglink",
		"<p><ai imglink",
		 "<p><imgi",
		"<p><img ",
		"<li><ai imglink",
		"<imgi ",
		"<p><div",
		"</div></p>",
		"<p>&#8224;",
		"<p>&#8225;",
		"<p><ul",
		"</ul></p>",
		"</li><br />",
		"<p><dl",
		"</dt><br />",
		"</dd><br />",
		"</dl><br />",
		"<p><ol",
		"</ol></p>",
		"<p><script",
		"</script></p>",
		"<br />\n<li>",
		"amazon.co.uk",
		"Amazon.co.uk",
		"jalfrezi-21",
		"<p>[firefoxad]</p>",
		"<p><object",
		"<p><h3",
		"</h3></p>",
		"<p><h2",
		"</h2></p>");
	$replace = array (
		"<p",
		"</p>",
		"</div>\n<div class='segment'>",
		"</div>\n<div class='segment'>",
		"<address",
		"</address>",
		"<form",
		"</form>",
		"<table",
		"<table>",
		"</table>",
		"</table>",
		"</tr>",
		"</th>",
		"</td>",
		"</thead>",
		"</tfoot>",
		"</tbody>",
		"</caption>",
		"",
		"<pre><code>",
		"</code></pre>",
		"<p class='imgholder'><a",
		"<p class='imgholder inline'><a",
		"<p class='imgholder inline'><img",
		"<p class='imgholder'><img ",
		"<li><a class='inline'",
		"<img ",
		"<div",
		"</div>",
		"<p class='footnote'>&#8224;",
		"<p class='footnote'>&#8225;",
		"<ul",
		"</ul>",
		"</li>",
		"<dl",
		"</dt>",
		"</dd>",
		"</dl>",
		"<ol",
		"</ol>",
		"<script",
		"</script>",
		"\n<li>",
		"amazon".$amz_affil[$amz_dest][0],
		"Amazon".$amz_affil[$amz_dest][0],
		$amz_affil[$amz_dest][1],
		"<div style='float:left; width:125px; margin:0 1em 0.5em 0'><script type='text/javascript'>google_ad_client='pub-0245469311642720'; google_ad_width = 125; google_ad_height = 125; google_ad_format = '125x125_as_rimg'; google_cpa_choice = 'CAAQveHnzwEaCEiH5iXPqf1SKJe193M'; </script><script type='text/javascript' src='http://pagead2.googlesyndication.com/pagead/show_ads.js'></script></div>",
		"<p class='imgholder'><object",
		"<h3",
		"</h3>",
		"<h2",
		"</h2>");
	$text = str_replace($search, $replace, $text);
	
	$text = trim($text);
	
	return $text;
}

function makeDescription($maincontent,$description) {
	if ($description == "" OR $description == "<p></p>") {
		$description = $maincontent;
	}
	$description = format($description);
	$description = str_replace("<br />", " ", $description);
	$description = strip_tags($description);
	$description = substr($description,0,280);
	if (strlen($description) == 280) {
		$description = preg_replace("/\s[^\s!]+\s?$/", "&#8230;", $description);
	}
	return $description;
}


// format comment for display
function formatcomment($thecomment) {
	# turn all HTML to entities
	$thecomment = htmlspecialchars($thecomment);
	# strip PHP and HTML tags to be sure
	$thecomment = strip_tags($thecomment);
	# make lone URLs into Textile links
	$thecomment = preg_replace("/((\s|^)(http(s?):\/\/(www\.)?)|(\s|^)(www\.))(\S+)/i", "$2$6\"$3$7$8\":http$4://$5$7$8", $thecomment);
	
	# put quotes back so textile works
	$thecomment = str_replace("&quot;", "\"", $thecomment);
	# Textilise comment
	$thecomment = preformat($thecomment);
	$thecomment = textile($thecomment, true);
	return $thecomment;
}


// work out simple plural
function plural($number) {
	$plural = ($number == 1)?"":"s";
	
	return $plural;
}


// work out relative time string
// $time should be a Unix timestamp - get it with strtotime()
function get_elapsedtime($time) {

    $gap = max(1, time() - $time);

    if ($gap < 60)  { 
        return $gap.' second'.($gap > 1 ? 's' : '').' ago';
    }

    $gap = round($gap / 60);
    if ($gap < 60)  { 
        return $gap.' minute'.($gap > 1 ? 's' : '').' ago';
    }

    $gap = round($gap / 60);
    if ($gap < 24)  { 
        return $gap.' hour'.($gap > 1 ? 's' : '').' ago';
    }

    $gap = round($gap / 24);
    if ($gap < 7) {
		return $gap.' day'.($gap > 1 ? 's' : '').' ago';
	}

    $gap = round($gap / 7);
    if ($gap < 52) {
		return $gap.' week'.($gap > 1 ? 's' : '').' ago';
	}
	
	$gap = round($gap / 52);
	return $gap.' year'.($gap > 1 ? 's' : '').' ago';

}


