<?php
// If magic quotes is turned on then strip slashes
if (get_magic_quotes_gpc()) {
  foreach ($_POST as $key => $value) {
    $_POST[$key] = stripslashes($value);
  }
}

// get variables from query
$qsearch = (isset($_REQUEST["qsearch"]))?$_REQUEST["qsearch"]:""; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Search records</title>
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
include($dr . "/includes/cms_music.inc")
?>
</div>
<div id="screen">
<h2>Search records</h2>
<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="get" id="search">
<p>
<?php
printf("<input type='text' name='qsearch' id='qsearch' size='30' maxlength='255' class='textbox' value='%s' />\n",$qsearch);
?>
<input type="submit" value="Go" class="button" /><br />
</form>

<?php
// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

if (!$browse && !$qsearch && !$adsearch) {
	echo "<p>Browse or search through my music.</p>";
} elseif ($error) {
	printf("<p>There was an error in your search. <span class='error'>%s %s %s %s %s</span></p>",$e_search,$e_lookin,$e_format,$e_media,$e_date);
} else {	// browse
	if ($browse && preg_match("/^[a-zA-Z]$/", $browse)) {
		print "<p>You searched for <strong>artists beginning with $browse</strong>.\n";
		$filter = "artists.artist LIKE '$browse%'";
	}	// quick search
	if ($qsearch && !$error) {
		print "<p>You searched for <strong>$qsearch</strong>.\n";
		$filter = "(music.title LIKE '%$qsearch%' OR artists.artist LIKE '%$qsearch%' OR music.notes LIKE '%$qsearch%')";
	}	//adv search
	if ($adsearch && !$error) {
		$lookin = "";
		$format = "";
		$cdmedia = "";
		$vmedia = "";
		$omedia = "";
		$media = "";
		$date= "";
		$searchtxt = $search;
	
		// construct lookin text
		if($artist) {$lookin .= "artists";}
		if($title) {
			if($lookin && $notes) {$lookin .= ", ";}
			if($lookin && !$notes) {$lookin .= " &amp; ";}
			$lookin .= "titles";
		}
		if($notes) {
			if($lookin) {$lookin .= " &amp; ";}
			$lookin .= "notes";
		}
		
		// construct format text
		if($single) {$format .= "singles";}
		if($ep) {
			if($format && $album) {$format .= ", ";}
			if($format && !$album) {$format .= " &amp; ";}
			$format .= "<acronym>EP</acronym>s";
		}
		if($album) {
			if($format) {$format .= " &amp; ";}
			$format .= "albums";
		}
		
		// construct CD media text
		if($cd3 && $cd5) {$cdmedia = "<acronym>CD</acronym>";}
		else {
			if($cd3) {$cdmedia .= "3\"";}
			if($cd5) {
				if($cdmedia) {$cdmedia .= " &amp; ";}
				$cdmedia .= "5\"";
			}
			if($cdmedia) {$cdmedia = $cdmedia." <acronym>CD</acronym>";}
		}
		
		// construct vinyl text
		if($v5 && $v7 && $v9 && $v10 && $v12) {$vmedia = "vinyl";}
		else {
			if($v5) {$vmedia .= "5\"";}
			if($v7) {
				if($vmedia && ($v9 || $v10 || $v12)) {$vmedia .= ", ";}
				if($vmedia && !($v9 || $v10 || $v12)) {$vmedia .= " &amp; ";}
				$vmedia .= "7\"";
			}
			if($v9) {
				if($vmedia && ($v10 || $v12)) {$vmedia .= ", ";}
				if($vmedia && !($v10 || $v12)) {$vmedia .= " &amp; ";}
				$vmedia .= "9\"";
			}
			if($v10) {
				if($vmedia && $v12) {$vmedia .= ", ";}
				if($vmedia && !$v12) {$vmedia .= " &amp; ";}
				$vmedia .= "10\"";
			}
			if($v12) {
				if($vmedia) {$vmedia .= " &amp; ";}
				$vmedia .= "12\"";
			}
			if($vmedia) {$vmedia = $vmedia." vinyl";}
		}
		
		// construct other media text
		if($flexi) {$omedia .= "flexidisc";}
		if($tape) {
			if($omedia && $video) {$omedia .= ", ";}
			if($omedia && !$video) {$omedia .= " &amp; ";}
			$omedia .= "tape";
		}
		if($video) {
			if($omedia) {$omedia .= " &amp; ";}
			$omedia .= "video";
		}
		if($dvd) {
			if($omedia) {$omedia .= " &amp; ";}
			$omedia .= "<acronym>DVD</acronym>";
		}
			
		// construct media text
		if($cdmedia) {$media .= $cdmedia;}
		if($vmedia) {
			if($media && $omedia) {$media .= ", ";}
			if($media && !$omedia) {$media .= " and ";}
			$media .= $vmedia;
		}
		if($omedia) {
			if($media) {$media .= " and ";}
			$media .= $omedia;
		}
		
		// construct date text
		$startdate = date ("M Y", mktime(0,0,0,$startmon,1,$startyear));
		$enddate = date ("M Y", mktime(0,0,0,$endmon,1,$endyear));
		
		// search text
		if($search == "*") {$searchtxt = "everything";}
		printf ("<p>You searched %s for <strong>%s</strong> in %s on %s; purchased %s&#8211;%s.\n",$lookin, $searchtxt, $format, $media, $startdate, $enddate);
		
		// build search term
		$lfilter = "";
		if ($search != "*") {
			if($artist) {
				$lfilter .= "artists.artist LIKE '%".$search."%'";
			}
			if($title) {
				if($lfilter) {$lfilter .= " OR ";}
				$lfilter .= "music.title LIKE '%".$search."%'";
			}
			if($note) {
				if($lfilter) {$lfilter .= " OR ";}
				$lfilter .= "music.notes LIKE '%".$search."%'";
			}
		}
		if($lfilter) {$lfilter = "(".$lfilter.") AND ";}
		
		$tfilter = "";
		if($single) {
			$tfilter .= "music.type=1";
		}
		if($ep) {
			if($tfilter) {$tfilter .= " OR ";}
			$tfilter .= "music.type=2";
		}
		if($album) {
			if($tfilter) {$tfilter .= " OR ";}
			$tfilter .= "music.type=3";
		}
		
		$ffilter = "";
		if($cd3) {
			$ffilter .= "music.format=10";
		}
		if($cd5) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=1";
		}
			if($v5) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=6";
		}
		if($v7) {
			if($ffilter) {$ffilter .= " OR ";}
				$ffilter .= "music.format=5";
		}
		if($v9) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=4";
		}
		if($v10) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=3";
		}
		if($v12) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=2";
		}
		if($flexi) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=7";
		}
		if($video) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=8";
		}
		if($tape) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=9";
		}
		if($dvd) {
			if($ffilter) {$ffilter .= " OR ";}
			$ffilter .= "music.format=11";
		}
		
		$dfilter .= "purchasedate >= '".$startyear."-".$startmon."-01' AND purchasedate <= '".$endyear."-".$endmon."-31'";
	
		$filter = $lfilter."(".$tfilter.") AND (".$ffilter.") AND (".$dfilter.")";
	}	
	
	// do search and print results
	$sql = "
	SELECT music.id, artists.artist, title, labels.label, year, types.type, formats.format, notes
	FROM artists, music, types, formats, labels
	WHERE "
	 .$filter."
	 AND music.artist = artists.artist_id
	 AND types.id = music.type
	 AND formats.id = music.format
	 AND labels.label_id = music.label
	ORDER BY artist, type, title, notes";
	
	$searchresult = mysql_query($sql,$db);
	if ($myrow = mysql_fetch_array($searchresult)) {
		$count = mysql_num_rows($searchresult);
		if($count > 1) {$was = "were";} else {$was = "was";}
		if($count > 1) {$plural = "es";}
		printf("There %s <strong>%s</strong> match%s.</p>",$was,$count,$plural);
		
		/* check if any results and display them else say no results */ 
		echo "<ol>\n";
		do {
			$notes = $myrow["notes"];
			if ($notes != "") {$notes .= ".";}
			printf("<li>%s &#8211; <a href='index.php?id=%s' title='Edit &#8216;%s&#8217;'>%s</a><br>%s&nbsp;%s (%s&nbsp;%s). %s</li> \n", $myrow["artist"] , $myrow["id"], $myrow["title"], $myrow["title"], $myrow["format"], $myrow["type"], $myrow["label"], $myrow["year"], $notes);
		} while ($myrow = mysql_fetch_array($searchresult));
		echo "</ol>";
	} else {
		printf("</p><p>It appears I don&#8217;t have any records that match your search. If possible, try being less specific.</p>\n", $qsearch);
	}
}
?>

</div>
</body>
</html>
