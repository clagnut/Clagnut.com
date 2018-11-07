<?php
date_default_timezone_set("Europe/London");

# Common meta data shared between RSS feeds

function compilemetadata($title, $link, $description, $atomfile) {
	$metadata="<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">
			<channel>
				<title>$title</title>
				<link>$link</link>
				<atom:link href=\"$atomfile\" rel=\"self\" type=\"application/rss+xml\" />
				<description>$description</description>
				<language>en-gb</language>
				<copyright>Copyright 2003-".date('Y').", Richard Rutter</copyright>
				<webMaster>rich@clagnut.com (Richard Rutter)</webMaster>
				<managingEditor>rich@clagnut.com (Richard Rutter)</managingEditor>
				<image>
					<url>http://clagnut.com/images/clagnut_rss.png</url>
					<link>$link</link>
					<title>$title</title>
					<width>88</width>
					<height>31</height>
				</image>\n";
	return $metadata;
}



# Write Blogmarks RSS feed 

function writeblogmarkrss() {
	global $dr, $dr3;
	$error = "";
	
	// set file to write
	$filename = $dr3 . "/feeds/blogmarks.xml";
	
	// open file
	$fh = @fopen($filename, "w");
	
	if($fh) {
		$contents=compilemetadata("Clagnut blogmarks","http://clagnut.com/blogmarks/","So many sites, so little time. Blogmarks are a living collection of links I haven't managed to write about in the main blog.", "http://clagnut.com/feeds/blogmarks.xml");
		
		// pull blogs from database
		$sql = "SELECT blog_id, title AS link_title, tags, blogs.filename AS link_url, description AS link_comment, via_title, via_url, DATE_FORMAT(blogdate, '%a, %d %b %Y %T PST') AS pubdate FROM blogs WHERE content_type='blogmark' ORDER by blogdate DESC, tstamp DESC LIMIT 12";
		$result = mysql_query($sql);
		
		if ($myblogmark = mysql_fetch_array($result)) {
			do {
				$blog_id = $myblogmark["blog_id"];
				$pubdate = $myblogmark["pubdate"];
				$tags = $myblogmark["tags"];
				$link_title = format($myblogmark["link_title"]);
				$link_title = strip_tags($link_title);
				$link_title = str_replace(array("&nbsp;"),array(" "),$link_title);
				$link_url = htmlentities($myblogmark["link_url"]);
				$via_title = format($myblogmark["via_title"]);
				$via_title = strip_tags($via_title);
				$via_title = str_replace(array("&nbsp;"),array(" "),$via_title);
				$via_url = htmlentities($myblogmark["via_url"]);
				$link_comment = format($myblogmark["link_comment"]);
				$link_comment = str_replace(array("&nbsp;"),array(" "),$link_comment);
				$link_comment = strip_tags($link_comment);
				if ($via_url) {
					$via = "[via <a href='$via_url'>$via_title</a>]";
				} else {
					$via = "";
				}
		
				$contents .= "		<item>\n";
				$contents .= "			<pubDate>$pubdate</pubDate>\n";
				$contents .= "			<title>$link_title</title>\n";
				$contents .= "			<link>$link_url</link>\n";
				$contents .= "			<guid>$link_url</guid>\n";
				$contents .= "			<description><![CDATA[$link_comment. $via]]></description>\n";
				
				// get categories for this blogmark
				$sql_cats = "SELECT category, filename FROM categorys_blogs, categorys WHERE blog_id = $blog_id AND categorys_blogs.category_id = categorys.category_id";
				$result_cats = mysql_query($sql_cats);
				if ($blogmarkcat = mysql_fetch_array($result_cats)) {
					do {
						$category = htmlentities($blogmarkcat["category"]);
						$filename = $blogmarkcat["filename"];
						$contents .= "			<category domain=\"http://clagnut.com/blogmarks/$filename/\">$category</category>\n";	
					} while ($blogmarkcat = mysql_fetch_array($result_cats));
				}
				// add Technorati categories
				$tags_ay = explode(" ", $tags);
				foreach ($tags_ay AS $tag) {
					$contents .= "<category domain=\"http://del.icio.us/tag/$tag\">$tag</category>\n";
				}
				
				$contents .= "		</item>\n";
			} while ($myblogmark = mysql_fetch_array($result));
		}
		
		$contents .="	</channel>
		</rss>";
		
		// write to file
		$fw = @fwrite($fh, $contents);
		if (!$fw) {
			$error = "Could not write to the file $filename";
		} else {
			$error = "Blogmarks RSS file updated.";
		}
		
		// close file
		fclose($fh);
	} else {
		$error = "Could not open file $filename";
	}
	return $error;
}



# Write full posts RSS feed

function writefullrss() {
	global $dr, $dr3;
	$error = "";
	
	// set file to write
	$filename = $dr3 . "/feeds/fullposts.xml";
	
	// open file
	$fh = @fopen($filename, "w");
	
	if($fh) {
		$contents=compilemetadata("Clagnut","http://clagnut.com/","A blog by Richard Rutter. Root through a heap of web design and development stuff and a few other tasty morsels. (latest 5 posts in full)", "http://clagnut.com/feeds/fullposts.xml");
		
		// pull blogs from database
		$sql = "SELECT blog_id, title, maincontent, maincontent_textile, tags, DATE_FORMAT(blogdate, '%a, %d %b %Y %T PST') AS pubdate FROM blogs WHERE blogdate < NOW() AND content_type='blog' ORDER BY blogdate DESC LIMIT 5";
		$result = mysql_query($sql);
		
		if ($myblog = mysql_fetch_array($result)) {
			do {
				$blog_id = $myblog["blog_id"];
				$pubdate = $myblog["pubdate"];
				$tags = $myblog["tags"];
				$title = strip_tags(format($myblog["title"]));
				$title = strip_tags($title);
				$maincontent_textile = $myblog["maincontent_textile"];
				$maincontent = format($myblog["maincontent"], $maincontent_textile);
				$search = array ("href=\"/", "src=\"/");
				$replace = array ("href=\"http://clagnut.com/", "src=\"http://clagnut.com/");
				$maincontent = str_replace($search, $replace, $maincontent);
		
				$contents .= "		<item>\n";
				$contents .= "			<pubDate>$pubdate</pubDate>\n";
				$contents .= "			<title>$title</title>\n";
				$contents .= "			<link>http://clagnut.com/blog/$blog_id/</link>\n";
				$contents .= "			<guid>http://clagnut.com/blog/$blog_id/</guid>\n";
				$contents .= "			<description><![CDATA[$maincontent" . "\n<p><a href='http://clagnut.com/blog/".$blog_id."/'>Read or add comments</a></p>" . "]]></description>\n";
				
				// get categories for this blog
				$sql_cats = "SELECT category, filename FROM categorys_blogs, categorys WHERE blog_id = $blog_id AND categorys_blogs.category_id = categorys.category_id";
				$result_cats = mysql_query($sql_cats);
				if ($blogcat = mysql_fetch_array($result_cats)) {
					do {
						$category = htmlentities($blogcat["category"]);
						$filename = $blogcat["filename"];
						$contents .= "			<category domain=\"http://clagnut.com/archive/$filename/\">$category</category>\n";	
					} while ($blogcat = mysql_fetch_array($result_cats));
				}
				// add Technorati categories
//				$tags_ay = explode(" ", $tags);
//				foreach ($tags_ay AS $tag) {
//					$contents .= "<category domain=\"http://technorati.com/tag/$tag\">$tag</category>\n";
//				}
				
				$contents .= "		</item>\n";
			} while ($myblog = mysql_fetch_array($result));
		}
		
		$contents .="	</channel>
		</rss>";
		
		// write to file
		$fw = @fwrite($fh, $contents);
		if (!$fw) {
			$error = "Could not write to the file $filename";
		} else {
			$error = "Full posts RSS file updated.";
		}
		
		// close file
		fclose($fh);
	} else {
		$error = "Could not open file $filename";
	}
	return $error;
}



# Write summarised posts feed

function writesummariesrss() {
	global $dr, $dr3;
	$error = "";
	
	// set file to write
	$filename = $dr3 . "/feeds/summaries.xml";
	
	// open file
	$fh = @fopen($filename, "w");
	
	if($fh) {
		$contents=compilemetadata("Clagnut summaries","http://clagnut.com/","A blog by Richard Rutter. Root through a heap of web design and development stuff and a few other tasty morsels. (latest 10 posts in summary)", "http://clagnut.com/feeds/summaries.xml");
		
		// pull blogs from database
		$sql = "SELECT blog_id, title, maincontent, maincontent_textile, tags, description, DATE_FORMAT(blogdate, '%a, %d %b %Y %T PST') as pubdate FROM blogs WHERE blogdate < NOW() AND content_type='blog' ORDER BY blogdate DESC LIMIT 10";
		$result = mysql_query($sql);
		
		if ($myblog = mysql_fetch_array($result)) {
			do {
				$blog_id = $myblog["blog_id"];
				$pubdate = $myblog["pubdate"];
				$tags = $myblog["tags"];
				$maincontent = $myblog["maincontent"];
				$maincontent_textile = $myblog["maincontent_textile"];
				$description = $myblog["description"];
				$title = format($myblog["title"]);
				$title = str_replace(array("<p>","</p>"),array("",""),$title);
				$title = strip_tags($title);
				$id = $myblog["blog_id"];
				$summary = makeDescription($maincontent,$description,$maincontent_textile);
				$summary = $summary . " <a href='http://clagnut.com/blog/".$blog_id."/'>Read more</a>.";
		
				$contents .= "		<item>\n";
				$contents .= "			<pubDate>$pubdate</pubDate>\n";
				$contents .= "			<title>$title</title>\n";
				$contents .= "			<link>http://clagnut.com/blog/$blog_id/</link>\n";
				$contents .= "			<guid>http://clagnut.com/blog/$blog_id/</guid>\n";
				$contents .= "			<description><![CDATA[$summary]]></description>\n";
				
				// get categories for this blog
				$sql_cats = "SELECT category, filename FROM categorys_blogs, categorys WHERE blog_id = $blog_id AND categorys_blogs.category_id = categorys.category_id";
				$result_cats = mysql_query($sql_cats);
				if ($blogcat = mysql_fetch_array($result_cats)) {
					do {
						$category = htmlentities($blogcat["category"]);
						$filename = $blogcat["filename"];
						$contents .= "			<category domain=\"http://clagnut.com/archive/$filename/\">$category</category>\n";	
					} while ($blogcat = mysql_fetch_array($result_cats));
				}
				// add Technorati categories
//				$tags_ay = explode(" ", $tags);
//				foreach ($tags_ay AS $tag) {
//					$contents .= "<category domain=\"http://technorati.com/tag/$tag\">$tag</category>\n";
//				}
//				
				$contents .= "		</item>\n";
			} while ($myblog = mysql_fetch_array($result));
		}
		
		$contents .="	</channel>
		</rss>";
		
		// write to file
		$fw = @fwrite($fh, $contents);
		if (!$fw) {
			$error = "Could not write to the file $filename";
		} else {
			$error = "Summaries RSS file updated.";
		}
		
		// close file
		fclose($fh);
	} else {
		$error = "Could not open file $filename";
	}
	return $error;
}
?>