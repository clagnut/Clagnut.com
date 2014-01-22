<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
include_once($dr . "/includes/path_to_db.inc.php");
include($dr2 . "/db_connect.php");
	
// get variables from query
$q = (isset($_REQUEST["q"]))?$_REQUEST["q"]:""; 

// format function
include($dr . "/includes/format.php");

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

$error[1] = "There was a problem with your search. Please enter some search text.";
$error[2] = "No search specified. Use the form, Luke&#8230;";
$error[3] = "Sorry, I couldn&#8217;t find any matches for <strong>$q</strong>. Please enter a search term more than three letters long.";

if (!isset($errorcode)) {
	# fulltext search
	$sql="SELECT filename, blog_id, title, description, maincontent, content_type, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs WHERE MATCH (title,description,tags,maincontent,subtext,sidebar) AGAINST ('$q') AND live='y' AND blogdate < NOW() AND content_type='blog' LIMIT 50";
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
	$sql="SELECT category, categorys.filename AS category_filename, (MATCH (title,description,tags,maincontent,subtext,sidebar) AGAINST ('$q')) as score FROM blogs, categorys_blogs, categorys WHERE categorys.category_id =categorys_blogs.category_id AND blogs.blog_id = categorys_blogs.blog_id AND MATCH (title,description,tags,maincontent,subtext,sidebar) AGAINST ('$q') AND blogdate < NOW() AND live='y' LIMIT 50";
	$cats_fulltext_result=mysql_query($sql);
	
	# build up array of categories and their scores
	# keywords
	if ($myresult = mysql_fetch_array($cats_keywords_result)) {
		do {
			$category = $myresult["category"];
			$filename = $myresult["category_filename"];
			$score = $myresult["score"];
			$category_name[$filename] = $category;
			$category_score[$filename] = $category_score[$filename] + $score;
		} while ($myresult = mysql_fetch_array($cats_keywords_result));
	}
	# fulltext
	if ($myresult = mysql_fetch_array($cats_fulltext_result)) {
		do {
			$category = $myresult["category"];
			$filename = $myresult["category_filename"];
			$score = $myresult["score"];
			$category_name[$filename] = $category;
			$category_score[$filename] = $category_score[$filename] + $score;
		} while ($myresult = mysql_fetch_array($cats_fulltext_result));
	}
	# sort array by score
	if (is_array($category_score)) {
		arsort($category_score);
	}
}

if (isset($q)) {$q = stripslashes($q);}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Search <?php if($q) {echo " for ".$q;} ?> | Clagnut</title>
<?php
include($dr . "/includes/headlinks.inc.php");
include($dr . "/includes/rsslinks.inc");
?>

</head>
<body id="archive">

<?php include($dr . "/includes/masthead.inc.php"); ?>

<div id="content" class="wrapper">

<div class="hfeed">
	<h1><?php
if ($q) {
	echo "Search for <strong>$q</strong>";
} else {
	echo "Search results";
}
?></h1>
	<div class="primary">
<?php		
// Print number of matches for blogs
if (!isset($errorcode) AND $num_results > 0) {
	$plural1 = "are";
	$plural2 = "ies";
	if($num_results == 1) {$plural1 = "is"; $plural2 = "y";}
	printf("<h3>There %s <strong>%s</strong> entr%s matching <strong>%s</strong>:</h3>\n\n", $plural1,$num_results,$plural2,$q);

	// Print search results
	mysql_data_seek($fulltext_results,0);
	if ($myblog = mysql_fetch_array($fulltext_results)) {
		do {
			$content_type = $myblog["content_type"];
			$blog_id = $myblog["blog_id"];
			$postdate = $myblog["postdate"];
			$description = $myblog["description"];
			$maincontent = $myblog["maincontent"];
			$filename = $myblog["filename"];
			
			$title = format($myblog["title"]);
			$title = str_replace(array("<p>","</p>"),array("",""),$title);
		
			if ($content_type == "blog") {
				$description = makeDescription($maincontent,$description);
				echo "<li><a href='/blog/$blog_id/'>$title</a> <span class='postdate'>Blog Post &middot; $postdate</span>\n<p>";
				echo $description;
				echo "</p></li>\n";
			}
			if ($content_type == "sandbox") {
				$description = strip_tags(format($description));
				echo "<li><a href='/sandbox/$filename/'>$title</a> <span class='postdate'>Sandbox</span>\n<p>";
				echo $description;
				echo "</p></li>\n";
			}
			if ($content_type == "writing") {
				$description = strip_tags(format($description));
				echo "<li><a href='/writings/$filename/'>$title</a> <span class='postdate'>Article</span>\n<p>";
				echo $description;
				echo "</p></li>\n";
			}
			if ($content_type == "blogmark") {
				$description = makeDescription($maincontent,$description);
				echo "<li><a href='$filename' title='External site'>$title</a> <span class='postdate'>Blogmark &middot; $postdate</span>\n<p>";
				echo $description;
				echo "</p></li>\n";
			}
		} while ($myblog = mysql_fetch_array($fulltext_results));
	}
}

if ($errorcode) {
	if ($q) {echo "<h3>Search results</h3>\n";}
	# print error message
	print "<p class='error'>$error[$errorcode]</p>";
}

# print special message of no matches at all
if (!isset($errorcode) AND $num_results < 1) {
	$success = 0;
	echo "<h3>Search results</h3>";
	echo "<p class='error'>Sorry, I couldn&#8217;t find any matches for <strong>$q</strong>.</p>\n<p>Note that searching will not match words of three letters of less, so try spelling out acronyms.</p>";
	if (preg_match("/[a-zA-Z]or/",$q)) {
		$q_uksp = preg_replace("/([a-zA-Z])or/","$1our",$q);
		echo "<p>You could also try British spellings as well: <a href='/search/?q=$q_uksp'>search for &#8216;$q_uksp&#8217;</a>.</p>";
	}
	echo "<p>I searched blog posts, writings, blogmarks and the sandbox, but it could be you were searching for <a href='/music/?qsearch=$q' title='Search my music collection for $q'>some music</a> I was listening to or <a href='/photos/'>some photos</a> I&#8217;ve taken.</p>\n";
} else {
	$success = 1;
}
?>
	
	</div> <!-- /.primary -->
	
</div> <!-- /hfeed-->
	
<div class="tertiary">	

<?php
// Print matching categories
$category_count = (isset($category_score))?count($category_score):0;
if (!isset($errorcode) OR $errorcode == 3 AND ($category_count > 0)) {
	echo "<h2>Related Categories</h2>\n";
	if ($category_count > 0) {
		echo "<ul class='tags'>\n";
		$i = 1;
		foreach($category_score as $filename => $score) {
			if ($i < 6) {
				$category = $category_name[$filename];
				echo "<li><a href='/archive/$filename/'>$category</a></li>";
			}
			$i++;
		}
		echo "</ul>\n";
	} else {
		echo "<p>No related categories</p>";
	}
}
?>


</div> <!-- /tertiary-->

</div> <!-- /content-->

<?php include($dr . "/includes/footer.inc.php"); ?>

</body>
</html>
