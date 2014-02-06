<?php
date_default_timezone_set("Europe/London");
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

include_once($dr . "path_to_db.inc.php");
include($dr2 . "/db_connect.php");

// get variables from query
$q = (isset($_REQUEST["q"]))?$_REQUEST["q"]:""; 
$q = addslashes($q);

// format function
include($dr . "format.php");

// error check search term
if(!isset($q)) {
	$errorcode = 2;
} else {
	$q = strip_tags(trim($q));
	if ($q == "") {
		$errorcode = 1;
	} elseif (strlen($q) < 4) {
		$errorcode = 3;
	}
}

$error[1] = "Please enter some search text.";
$error[2] = "No search specified. Use the form, Luke&#8230;";
$error[3] = "Sorry, I couldn’t find any matches for ‛<strong>$q</strong>’. Please enter a search term more than three letters long.";

if (!isset($errorcode)) {
	# fulltext search
	$sql="SELECT filename, blog_id, title, description, maincontent, content_type, blogdate, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs WHERE MATCH (title,description,tags,maincontent) AGAINST ('$q') AND live='y' AND blogdate < NOW() AND content_type='blog' LIMIT 50";
	$fulltext_results=mysql_query($sql);
	$num_results=mysql_num_rows($fulltext_results);
}

# match categories based on keywords and category name matches
if (!isset($errorcode) OR $errorcode == 3) {
	# swap commas for spaces
	$q_split = str_replace(",", " ", $q);
	# swap spaces for regex-friendly pipes
	$q_split = str_replace(" ", "|", $q_split);
	# weed out double pipes
	$q_split = str_replace("||", "|", $q_split);
	# deal with pipes at beginning or end
	$q_split = preg_replace("/^\||\|$/", "", $q_split);
	
	# keywords
	$sql="SELECT filename AS category_filename, category, 2 as score FROM categorys WHERE keywords REGEXP '$q_split'";	
	$cats_keywords_result=mysql_query($sql);

	# match categories based on search results
	$sql="SELECT category, categorys.filename AS category_filename, (MATCH (title,description,tags,maincontent) AGAINST ('$q')) as score FROM blogs, categorys_blogs, categorys WHERE categorys.category_id =categorys_blogs.category_id AND blogs.blog_id = categorys_blogs.blog_id AND MATCH (title,description,tags,maincontent) AGAINST ('$q') AND blogdate < NOW() AND live='y' LIMIT 50";	
	$cats_fulltext_result=mysql_query($sql);
	
	# build up array of categories and their scores
	# keywords
	if ($myresult = mysql_fetch_array($cats_keywords_result)) {
		do {
			$category = $myresult["category"];
			$filename = $myresult["category_filename"];
			$score = $myresult["score"];
			$category_name[$filename] = $category;
			$category_score[$filename] = $score;
		} while ($myresult = mysql_fetch_array($cats_keywords_result));
	}
	# fulltext
	if ($myresult = mysql_fetch_array($cats_fulltext_result)) {
		do {
			$category = $myresult["category"];
			$filename = $myresult["category_filename"];
			$score = $myresult["score"];
			$category_name[$filename] = $category;
			if(isset($category_score[$filename])) {
				$category_score[$filename] = $category_score[$filename] + $score;
			} else {
				$category_score[$filename] = $score;			
			}
		} while ($myresult = mysql_fetch_array($cats_fulltext_result));
	}
	# sort array by score
	if (isset($category_score) && is_array($category_score)) {
		arsort($category_score);
	}
}

if (isset($q)) {$q = stripslashes($q);}

?>

<!DOCTYPE html>
<html lang="en-gb">

<head>
<?php include($dr . "head.inc.php"); ?>

    <title>Search <?php if($q) {echo " for ".$q;} ?> | Clagnut</title>
    
    <meta name="author" content="Richard Rutter" /> 
    
</head>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main class="archive search">

<header>

<h1><?php
if ($q) {
	echo "Search for ‘".$q."’";
} else {
	echo "Search";
}
?></h1>

<div class="meta">

<form action="/search/" method="get">
<input type="search" name="q" value="<?php echo $q ?>" size="30" /><input type="submit" value="Search" />
</form>

</div>

</header>

<section class="relatedposts archive">

<?php		
	
// Print number of matches for blogs
if (!isset($errorcode) AND $num_results > 0) {
	$plural1 = "are";
	$plural2 = "ies";
	if($num_results == 1) {$plural1 = "is"; $plural2 = "y";}
	printf("<p>There %s <strong>%s</strong> entr%s matching ‛<strong>%s</strong>’:</p><br />\n\n", $plural1,$num_results,$plural2,$q);

	// Print search results
	mysql_data_seek($fulltext_results,0);
	if ($myblog = mysql_fetch_array($fulltext_results)) {
		do {
			$content_type = $myblog["content_type"];
			$blog_id = $myblog["blog_id"];
			$blogdate = $myblog["blogdate"];
			$postdate = $myblog["postdate"];
			$description = $myblog["description"];
			$maincontent = $myblog["maincontent"];
			$filename = $myblog["filename"];
			
			$title = format($myblog["title"]);
			$title = str_replace(array("<p>","</p>"),array("",""),$title);
			
			$description = makeDescription($maincontent,$description);
		
			echo "<article>\n";
			echo "	<p class=\"date\">\n";
			echo "		<time datetime=\"" . $blogdate . " \">" . $postdate . " </time>\n";
			echo "	</p>\n";
			echo "	<h1><a href=\"/blog/" . $blog_id . "/\" rel=\"bookmark\">" . $title . " </a></h1>\n";
			echo "	<p class=\"summary\">" . $description . " </p>\n";
			echo "</article>\n";
			
		} while ($myblog = mysql_fetch_array($fulltext_results));
	}
}

if (isset($errorcode) && $errorcode>1) {
	# print error message
	print "<p class='error'>$error[$errorcode]</p>";
}

# print special message of no matches at all
if (!isset($errorcode) AND $num_results < 1) {
	$success = 0;
	echo "<p class='error'>Sorry, I couldn’t find any matches for ‛<strong>$q</strong>’.</p>\n<p style='margin-top:1em'>Note that searching will not match words of three letters or fewer, so try spelling out acronyms. ";
	if (preg_match("/[a-zA-Z]or/",$q)) {
		$q_uksp = preg_replace("/([a-zA-Z])or/","$1our",$q);
		echo "You could also try British spellings as well: <a href='/search/?q=$q_uksp'>search for &#8216;$q_uksp&#8217;</a>. ";
	}
	echo "This search only searches blog posts, not the rest of the site.</p>\n";
} else {
	$success = 1;
}
?>
</section>


<?php
// Print matching categories
$category_count = (isset($category_score))?count($category_score):0;
if (!isset($errorcode) OR $errorcode == 3 AND ($category_count > 0)) {
	echo "<aside><h2>Related Categories</h2>\n";
	if ($category_count > 0) {
		echo "<ul>\n";
		$i = 1;
		foreach($category_score as $filename => $score) {
			if ($i < 6) {
				$category = $category_name[$filename];
				echo "<li><a href='/archive/$filename/'>$category</a></li>";
			}
			$i++;
		}
		echo "</ul>";
	} else {
		echo "<p>No related categories</p>";
	}
	echo "</aside>";
}
?>

</aside>


</main>

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
