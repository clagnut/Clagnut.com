<?php
date_default_timezone_set("Europe/London");

// clean up each tag in the array
function trim_value(&$value) {
	$value = trim($value);
}

function makeMap($machinetagsAr) {
	$Map = "";
	$placename = "";
	foreach ($machinetagsAr as $tag) {
		if (preg_match("/^geo:lon=/i", $tag)) {
			$lon = str_replace("geo:lon=", "", $tag);
		}
		if (preg_match("/^geo:lat=/i", $tag)) {
			$lat = str_replace("geo:lat=", "", $tag);
		}
		if (preg_match("/^geo:placename=/i", $tag)) {
			$placename = str_replace("geo:placename=", "", $tag);
		}
	}

	if (isset($lat) && isset($lon)) {
		$Map = "<div class=\"map\"><h2>Location</h2><div id=\"map\"></div>";
		if($placename) {$Map .= "<p><span>Map of $placename</span></p>";}
		$Map .= "</div>\n";
		$Map .= "<script type=\"text/javascript\">\n";
		$Map .= "var map = new GMap(document.getElementById(\"map\"));\n";
		$Map .= "map.addControl(new GSmallZoomControl());\n";
		$Map .= "map.centerAndZoom(new GPoint($lon, $lat), 10);\n";
		$Map .= "var point = new GPoint($lon, $lat);\n";
		$Map .= "var marker = new GMarker(point);\n";
		$Map .= "var html = \"$placename\";\n";
		$Map .= "GEvent.addListener(marker, \"click\", function() {\n";
		$Map .= "	marker.openInfoWindowHtml(html);\n";
		$Map .= "});\n";
		$Map .= "map.addOverlay(marker);\n";
		$Map .= "</script>";
	}
	return $Map;
}




function getpost($blog_id) { 
	global $dr, $dr2, $tagsAr, $clagnut_mtag;
	// set cache file
	$dr3 = str_replace("/includes/", "", $dr);	
	$filename = $dr3 . "/cache/" . $blog_id . "-post.php";
	$cachewait = 10; // seconds

	if (file_exists($filename) && (time() - filectime($filename) < $cachewait)) {
		include($filename);
	} else {
		// open file
		$fh = @fopen($filename, "w");

		if($fh) {
			include($dr2 . "/db_connect.php");
			// get blog post

			// pull blog from database

			$sql = "SELECT blog_id, blogdate, UNIX_TIMESTAMP(blogdate) AS unixdate, enable_comments, title, description, mainimage_src, mainimage_alt, socialimage_src, socialimage_alt, maincontent_textile, maincontent, tags, DATE_FORMAT(blogdate,'%D %M %Y') AS postdate FROM blogs WHERE blog_id = $blog_id AND content_type='blog'";
			#echo "<p><code>$sql</code></p>";
			$result = mysqli_query($db, $sql);
			$myblog = mysqli_fetch_array($result);

			$postdate = $myblog["postdate"];
			$enable_comments = $myblog["enable_comments"];
			$title_raw = stripslashes($myblog["title"]);
			$description_raw = stripslashes($myblog["description"]);
			$mainimage_src = $myblog["mainimage_src"];
			$mainimage_alt_raw = $myblog["mainimage_alt"];
			$socialimage_src = $myblog["socialimage_src"];
			$socialimage_alt_raw = $myblog["socialimage_alt"];
			$maincontent_textile = $myblog["maincontent_textile"];
			$maincontent_raw = stripslashes($myblog["maincontent"]);
			$blogdate = $myblog["blogdate"];
			$unixdate = $myblog["unixdate"];
			$tags = $myblog["tags"];

			$title = format($title_raw);
			$title = str_replace(array("<p>","</p>"),array("",""),$title);
			
			$headtitle = strip_tags($title);
			$googletitle = str_replace(" ",",",$headtitle);
			$maincontent = format($maincontent_raw, $maincontent_textile);
			$description = makeDescription($maincontent_raw,$description_raw);

			$time_since_posted = time() - strtotime($blogdate);
			#$comments_open_duration = 28 * 24 * 3600;
			#$comments_expired = ($time_since_posted > $comments_open_duration)?true:false;

			// create array from either comma-separated or space-separated tags string in db
			if (strrpos($tags, ",") === false) {
				$tagsAr = explode(" ",$tags);			
			} else {
				$tagsAr = explode(",",$tags);
			}

			array_walk($tagsAr, 'trim_value'); // trim each tag
			$tagsAr = array_unique($tagsAr); // remove dupes

			// create array in which to place machine tags
			$machinetagsAr = array();
			$clagnut_mtag = "clagnut:post=" . $blog_id;
			$machinetagsAr[] = $clagnut_mtag;

			// initialise variables for the tags strings to be written to the cache;
			$machinetagsarray = "";
			$tagsarray = "";

			// step through tags array
			$key = 0;
			foreach($tagsAr AS $tag) {
				// add to machine tags array if machine tag found
				if(preg_match('/[a-zA-Z0-9]+:[a-zA-Z0-9]+=\S+/', $tag)) {
					$machinetagsAr[] = $tag;
				} else {
					// write tag into string for cache
					$tag = "\"" . $tag . "\"";
					if($key+1 < count($tagsAr)) {
						$tag .= ", ";
					}
					$tagsarray .= $tag;
				}
				$key++;
			}

			// step through machine tags array and build up string to be written to the cache;
			foreach($machinetagsAr as $key => $machinetag) {
				$machinetagsarray .= "\"";
				$machinetagsarray .= addslashes($machinetag);
				$machinetagsarray .= "\"";
				if($key+1 < count($machinetagsAr)) {
					$machinetagsarray .= ", ";
				}
			}


			// Make map markup if the post is tagged 'geotagged'

			if (count($tagsAr) > 0) {
				// Google map
				$map = false;
				if(array_search('geotagged', $tagsAr)) {
					$map = makeMap($machinetagsAr);
				}

			}


			// build main image HTML
			if($mainimage_src) {
				$mainimage_alt = format($mainimage_alt_raw);
				$mainimage_alt = str_replace(array("<p>","</p>"),array("",""),$mainimage_alt);
				$mainimage = "<figure class=\"fullbleed\"><img src=\"/images/$mainimage_src\" alt=\"$mainimage_alt\" /></figure>";
				$mainimage_url = "https://clagnut.com/images/$mainimage_src";
			} else {
				$mainimage = "";
				$mainimage_url = "";
				$mainimage_alt = "";
			}
			
			
			// build social image
			if($socialimage_src) {
				$socialimage_src = "https://clagnut.com/images/$socialimage_src";				
				$socialimage_alt = format($socialimage_alt_raw);
				$socialimage_alt = str_replace(array("<p>","</p>"),array("",""),$socialimage_alt);
			} else {
				$socialimage_src = "";
				$socialimage_alt = "";
			}

			// get blog categories

			$categories = get_blog_cats($blog_id);

			// get next and previous

			$older = false;
			$oldertitle = false;
			$olderblogdate = false;
			$olderunixdate = false;
			$recent = false;
			$recenttitle = false;
			$recentblogdate = false;
			$recentunixdate = false;

			$sql = "SELECT blog_id, title, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate, UNIX_TIMESTAMP(blogdate) AS unixdate FROM blogs WHERE blogdate < '$blogdate' AND content_type='blog' ORDER BY blogdate DESC LIMIT 1";
			$result = mysqli_query($db, $sql);
			$nextblog = mysqli_fetch_array($result);
			if($nextblog) {
				$older = $nextblog["blog_id"];
				$oldertitle = format(stripslashes($nextblog["title"]));
				$oldertitle = strip_tags($oldertitle);
				$olderblogdate = $nextblog["postdate"];
				$olderunixdate = $nextblog["unixdate"];
			}

			$sql = "SELECT blog_id, title, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate, UNIX_TIMESTAMP(blogdate) AS unixdate FROM blogs WHERE blogdate > '$blogdate' AND blogdate < NOW() AND content_type='blog' ORDER BY blogdate ASC LIMIT 1";
			$result = mysqli_query($db, $sql);
			$prevblog = mysqli_fetch_array($result);
			if($prevblog) {
				$recent = $prevblog["blog_id"];
				$recenttitle = format(stripslashes($prevblog["title"]));
				$recenttitle = strip_tags($recenttitle);
				$recentblogdate = $prevblog["postdate"];
				$recentunixdate = $prevblog["unixdate"];
			}

			// get related posts
			
			# build the finished search term
			$tagsforsearch = str_replace(array("geotagged", "booktagged") , "" , $tags);
			$tagsforsearch = str_replace(array(",,", ", ,") , "" , $tagsforsearch);
			$searchterm = addslashes(strip_tags($title . ". " . $tagsforsearch));
			$tagsforboolean = str_replace(","," >",$tagsforsearch);
			$tagsforboolean = str_replace("> ",">",$tagsforboolean);
			$tagsforboolean = ">" . addslashes($tagsforboolean);

			//$sql = "SELECT blog_id, title, description, maincontent, MATCH (title,tags,maincontent) AGAINST ('$tagsforboolean' in boolean mode) AS score FROM blogs WHERE MATCH (title,tags,maincontent) AGAINST ('$searchterm') AND blog_id<>$blog_id AND blogdate < NOW() AND content_type='blog' order by score desc LIMIT 3;";
			//echo $sql;
	

			$sql = "SELECT blog_id, blogdate, UNIX_TIMESTAMP(blogdate) AS unixdate, title, maincontent, description, DATE_FORMAT(blogdate,'%e %M %Y') AS postdate FROM blogs WHERE MATCH (title,tags,description) AGAINST ('$searchterm') AND blog_id<>$blog_id AND blogdate < NOW() AND content_type='blog' LIMIT 3";
			
			$result = mysqli_query($db, $sql);
			
			if ($myblog = mysqli_fetch_array($result)) {
				$related_posts = "<ul class='articles'>";
				do {
				
					$rp_id = $myblog["blog_id"];
					$rp_postdate = $myblog["postdate"];
					$rp_filename = $dr3 . "/cache/" . $rp_id . "-post.php";
				
					if (file_exists($rp_filename)) {
						include($rp_filename);
					} else {
						$post_headtitle[$rp_id] = strip_tags($myblog["title"]);
						$post_isodate[$rp_id] = $myblog["unixdate"];
						$post_decription_tmp = format(makeDescription($myblog["maincontent"], $myblog["description"]));
						$post_decription_tmp = str_replace(array("<p>","</p>"),array("",""),$post_decription_tmp);
						$post_description[$rp_id] = $post_decription_tmp;
					}
					$related_posts .= "<li><article>
					<h3><a href='/blog/$rp_id'>$post_headtitle[$rp_id]</a></h3>
					<p class='summary'>$post_description[$rp_id]</p>
					<p class='date'><time datetime='$post_isodate[$rp_id]'>$rp_postdate</time></p>
					</article></li>\n";
					
				} while ($myblog = mysqli_fetch_array($result));
				
				$related_posts .= "</ul>";
				
			} else {
				$related_posts = "<p>No related posts. Browse the <a href=\"/archive/\">Blog archive</a>.</p>";
			}


			// Get referrers
			/*

			if (!preg_match ("/googlebot|slurp|msnbot/i", $_SERVER["HTTP_USER_AGENT"])) {
				// pull referrers from database but don't show to main search engine robots)
				$sql = "SELECT referer, count( * ) AS counter
				FROM mint_visit
				WHERE resource
				IN (
				'http://clagnut.com/blog/$blog_id', 'http://clagnut.com/blog/?id=$blog_id', 'http://clagnut.com/blog/$blog_id/', 'http://clagnut.com/blog/?id=$blog_id/'
				)
				AND referer != ''
				AND referer NOT LIKE '%clagnut.com%'
				AND referer NOT LIKE '%clagnut.dev%'
				GROUP BY referer
				ORDER BY counter DESC, dt DESC
				LIMIT 10";
				$result = mysqli_query($db, $sql);
				if($myreferrer = mysqli_fetch_array($result)) {
					$referrers = "<ul class=\"referrers\">";
					do {
						$referrer = $myreferrer["referer"];
						$domain = str_replace("http://", "", $referrer);
						$domainpaths = explode("/", $domain);
						$domain = $domainpaths[0];
						if($domainpaths[1] && $domainpaths[1] != "") {
							$domain .= "/" . $domainpaths[1];
						}
						$counter = $myreferrer["counter"];
						$referrer = str_replace(" ", "+", $referrer);
						$referrers .= "<li>$counter&nbsp;&middot;&nbsp;<a href=\"$referrer\" rel=\"nofollow\">$domain</a></li>\n";
					} while ($myreferrer = mysqli_fetch_array($result));
					$referrers .= "</ul>";
				} else {
					$referrers = "<p>No referrers yet.</p>";
				}
			}
			*/

			// Get number of comments
			/*

			$sql = "select count(blogID) AS numcomments from comments where blogID=$blog_id";
			$result = mysqli_query($db, $sql);
			if($mynumcomments = mysqli_fetch_array($result)) {
				$numcomments = $mynumcomments["numcomments"];
			} else {
				$numcomments = 0;
			}
			*/


			// build cache

			$contents = '
			<?php
			global $post_title, $post_headtitle, $post_mainimage, $post_mainimage_url, $post_mainimage_alt, $post_socialimage_url, $post_socialimage_alt, $post_maincontent, $post_description, $post_categories, $post_tags, $post_machinetags, $post_postdate, $post_isodate, $post_older, $post_oldertitle, $post_olderblogdate, $post_olderunixdate, $post_recent, $post_recenttitle, $post_recentblogdate, $post_recentunixdate, $post_related_posts, $post_enable_comments, $post_comments_expired, $post_numcomments, $post_referrers, $post_map, $post_maincontent_textile;
			$post_title['.$blog_id.'] = \'' . addslashes($title) . '\';
			$post_headtitle['.$blog_id.'] = \'' . addslashes($headtitle) . '\';
			$post_maincontent['.$blog_id.'] = \'' . addslashes($maincontent) . '\';
			$post_description['.$blog_id.'] = \'' . addslashes($description) . '\';
			$post_categories['.$blog_id.'] = "' . addslashes($categories) . '";
			$post_tags['.$blog_id.'] = array(' . $tagsarray . ');
			$post_machinetags['.$blog_id.'] = array(' . $machinetagsarray . ');
			$post_postdate['.$blog_id.'] = "' . addslashes($postdate) . '";
			$post_isodate['.$blog_id.'] = "' . date("c", $unixdate) . '";
			$post_older['.$blog_id.'] = "'. $older . '";
			$post_oldertitle['.$blog_id.'] = "'. addslashes($oldertitle) . '";
			$post_olderblogdate['.$blog_id.'] = "' . addslashes($olderblogdate) . '";
			$post_olderunixdate['.$blog_id.'] = "' . date("c", $olderunixdate) . '";
			$post_recent['.$blog_id.'] = "'. $recent . '";
			$post_recenttitle['.$blog_id.'] = "'. addslashes($recenttitle) . '";
			$post_recentblogdate['.$blog_id.'] = "' . addslashes($recentblogdate) . '";
			$post_recentunixdate['.$blog_id.'] = "' . date("c", $recentunixdate) . '";
			$post_related_posts['.$blog_id.'] = "'. addslashes($related_posts) . '";
			$post_map['.$blog_id.'] = "'. addslashes($map) . '";
			$post_mainimage['.$blog_id.'] = "'. addslashes($mainimage) . '";
			$post_mainimage_url['.$blog_id.'] = "'. addslashes($mainimage_url) . '";
			$post_mainimage_alt['.$blog_id.'] = "'. addslashes($mainimage_alt) . '";
			$post_socialimage_url['.$blog_id.'] = "'. addslashes($socialimage_src) . '";
			$post_socialimage_alt['.$blog_id.'] = "'. addslashes($socialimage_alt) . '";
			$post_maincontent_textile['.$blog_id.'] = "'. addslashes($maincontent_textile) . '";
			?>';

			// write to file
			$fw = @fwrite($fh, $contents);
			if (!$fw) {
				$error = "Could not write to the file $filename";
			}

			// close file
			fclose($fh);
			include($filename);
		} else {
			if (file_exists($filename)) {
				include($filename);
			} else {
				$error = "Error opening or creating cache for post.";
			}
		}
	}
}


function get_blog_cats($blog_id) {
// get blog categories
	global $dr, $dr2;
	include($dr2 . "/db_connect.php");
	$categorysql = "SELECT filename, category, categorys.category_id FROM categorys, categorys_blogs WHERE blog_id = $blog_id AND categorys.category_id = categorys_blogs.category_id";
	$categoryresult = mysqli_query($db, $categorysql);
	$categorys = NULL;	
	
	if ($mycategory = mysqli_fetch_array($categoryresult)) {
		do {
			$category_id = $mycategory["category_id"];
			$category = htmlentities($mycategory["category"]);
			$directory = $mycategory["filename"];
			$categorys[$category_id] = $category;
			$directorys[$category_id] = $directory;
		}
		while ($mycategory = mysqli_fetch_array($categoryresult));
	} else {
		$categorys[0] = "Unfiled";
	}

	// build categories HTML

	$numcats = count($categorys);
	$catcounter = 0;
	$category_list = "";
	$categories = "";
	foreach($categorys AS $category_id => $category) {
		$catcounter++;
		if ($category_id != 0) {
			$category = str_replace(" ", "&nbsp;", $category);
			$category_list = $category_list.$category;
			$categories .= "<li><a href=\"/archive/".$directorys[$category_id]."/\" title=\"View all posts relating to $category.\">$category</a>";
		} else {
			$categories .= "&#8211; $category &#8211;"; # prints - unfiled -
		}
		if ($catcounter != $numcats) {
			$category_list = $category_list.",";
			$categories .= ",";
		}
		$categories .= "</li>\n";
	}
	return $categories;
}


/*
function getcomments($blog_id, $force=FALSE) {
	global $dr3, $dr2;
	// set cache file
	$filename = $dr3 . "/cache/" . $blog_id . "-comments.php";
	$cachewait = 60; // seconds

	if (file_exists($filename) && (time() - filectime($filename) < $cachewait) && $force==FALSE) {
		include($filename);
	} else {
		// open file
		$fh = @fopen($filename, "w");

		if($fh) {
			include($dr2 . "/db_connect.php");


			// pull comments from database
			$sql = "SELECT comment_id,author,email,web,comment,UNIX_TIMESTAMP(commentstamp) AS commentstamp, DATE_FORMAT(commentstamp, '%Y%m%d%H%i%s') AS mmcommentdate, gravatar, UNIX_TIMESTAMP(gravatar_check) AS gravatar_check FROM comments WHERE blogID = $blog_id ORDER BY commentstamp ASC";
			$result = mysqli_query($db, $sql);
			if($mycomment = mysqli_fetch_array($result)) {
				$comment_num = 0;
				do {
					$comment_num++;

					$gravatar = $mycomment["gravatar"];
					$gravatar_check = $mycomment["gravatar_check"];
					$commentemail = $mycomment["email"];
					$mmcommentdate = $mycomment["mmcommentdate"];
					$commentdate = date('j M Y', $mycomment["commentstamp"]);
					$commenttime = date('H:i', $mycomment["commentstamp"]);
					# get and format comment
					$thecomment = formatcomment($mycomment["comment"]);
					$comment_id = $mycomment["comment_id"];
					$comment_author = $mycomment["author"];
					$comment_web = $mycomment["web"];

					if ($commentemail) {
						$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=".md5($commentemail)."&amp;size=40&amp;rating=PG";
						// check for gravatar image if not checked for in last 24 hours

						if (time() - $gravatar_check > (3600)) {
							$gravatar_check = gmdate("Y-m-d H:i:s");
							$imagesize = @getimagesize($grav_url);
							$headers = @get_headers($grav_url, 1);
							$filesize = $headers["Content-Length"];

							if ($imagesize[0] > 1 && $filesize != 3431) {
								$gravatar="yes";
							} else {
								$gravatar="no";
							}
							$sqlgrav = "UPDATE comments SET gravatar='$gravatar', gravatar_check='$gravatar_check' where email='$commentemail'";
							$resultgrav = mysqli_query($db, $sqlgrav);
						}
						if($gravatar == "yes") {
							$gravatar = "<img src='$grav_url' alt='".$comment_author."&#8217;s Gravatar' class='photo' />";
						} else {
							$gravatar = "";
						}
					} else {
						$gravatar = "";
					}


					if ($comment_web) {
						$fn = "<a href='" . $comment_web .  "' class='url'>" . $comment_author . "</a>";
						$avatar = "<a href='" . $comment_web .  "'>" . $gravatar . "</a>";
					} else {
						$fn = $comment_author;
						$avatar = $gravatar;
					}


					$comment = "<li id='c$comment_id'>
					<div class='comment'>
						<h4><a href='#c$comment_id' rel='bookmark' title='permalink for comment'>$comment_num</a></h4>
						" . addslashes($thecomment) . "
					</div>
					<div class='vcard'>
					<dl>
					<dt class='fn'>$fn</dt>
					<dd class='avatar'>$avatar</dd>
					<dd>$commentdate</dd>
					<dd>$commenttime <abbr>GMT</abbr></dd>
					</dl>
					</div>
					</li>";

					$comments[] = $comment;

				} while ($mycomment = mysqli_fetch_array($result));
			}

			// build cache

			$contents = '
			<?php
			global $commentsAr;
			';

			//comments
			if (isset($comments) && is_array($comments)) {
				foreach ($comments as $comment) {
					$contents .= '$commentsAr[] = "' . $comment . '";';
				}
			}

			$contents .= '
			?>';

			// write to file
			$fw = @fwrite($fh, $contents);
			if (!$fw) {
				$error = "Could not write to the file $filename";
			}

			// close file
			fclose($fh);
			include($filename);
		} else {
			if (file_exists($filename)) {
				include($filename);
			} else {
				$error = "Error opening or creating comments cache.";
			}
		}
	}
}
*/

function gethomecontent() {
	global $dr, $dr2;
	// set cache file
	$dr3 = str_replace("/includes/", "", $dr);	
	$filename = $dr3 . "/cache/home-content.php";
	$cachewait = 10; // seconds

	if (file_exists($filename) && (time() - filectime($filename) < $cachewait)) {
		include($filename);
	} else {
		// open file
		$fh = fopen($filename, "w");

		if($fh) {
			include($dr2 . "/db_connect.php");


			// pull blogmarks from database
			/*
			$sql = "SELECT * FROM blogs WHERE content_type='blogmark' ORDER BY blogdate DESC, tstamp DESC LIMIT 11";
			$result = mysqli_query($db, $sql);
			if ($myblogmark = mysqli_fetch_array($result)) {
				$blogmarks = "<ul>\n";
				do {
					$link_title = format($myblogmark["title"]);
					$link_title = str_replace(array("<p>","</p>"),array("",""),$link_title);
					$link_url = htmlentities($myblogmark["filename"]);
					$via_title = format($myblogmark["via_title"]);
					$via_title = strip_tags($via_title);
					$via_url = htmlentities($myblogmark["via_url"]);
					$link_comment = format($myblogmark["description"]);
					$link_comment = strip_tags($link_comment);
					if ($link_url != "") {
						$blogmarks = $blogmarks . "<li><a href='$link_url' title='$link_comment'>$link_title</a></li>\n";
					}
				} while ($myblogmark = mysqli_fetch_array($result));
				$blogmarks = $blogmarks . "</ul>\n";
			} else {
				$blogmarks = "<p>No blogmarks yet.</p>\n";
			}
			*/



			// pull latest music from database
			/*
			$sql = "SELECT artists.artist, title, formats.format
			FROM music, artists, formats
			WHERE new =  '1'
			AND artists.artist_id = music.artist
			AND formats.id = music.format
			ORDER BY artist, title";
			$result = mysqli_query($db, $sql);
			if ($mymusic = mysqli_fetch_array($result)) {
				$latestmusic = "<ul>\n";
				do {
					$latestmusic = $latestmusic . "<li><cite>" .htmlentities($mymusic["title"]) . "</cite> &middot; " . htmlentities($mymusic["artist"]) . "</li>\n";
				} while ($mymusic = mysqli_fetch_array($result));
				$latestmusic = $latestmusic . "</ul>\n";
			} else {
				$latestmusic = "<p>No recent purchases.</p>";
			}
			*/



			// get blogpost ids for home page

			$blogpostids = Array();

			// get latest posts
			$sql = "SELECT blog_id FROM blogs WHERE blogdate < NOW() AND content_type='blog' ORDER BY blogdate DESC LIMIT 5";
			$result = mysqli_query($db, $sql);
			if ($myblog = mysqli_fetch_array($result)) {
				do {
					$blogpostids[] = $myblog["blog_id"];
				} while ($myblog = mysqli_fetch_array($result));
			}

			// get post from one year ago
			/*
			$sql = "SELECT blog_id, title, description, maincontent, blogdate, ABS((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(blogdate))/86400 - 365) AS daysincepost FROM blogs WHERE content_type='blog'  AND (TO_DAYS(NOW()) - TO_DAYS(blogdate)) BETWEEN 335 AND 395 ORDER BY daysincepost LIMIT 1";
			$result = mysqli_query($db, $sql);
			if ($myblog = mysqli_fetch_array($result)) {
				do {
					$blogpostids[] = $myblog["blog_id"];
				} while ($myblog = mysqli_fetch_array($result));
			} else {
				$blogpostids[] = 0;
			}
			*/

			// build cache

			$contents = '
			<?php
			global $blogmarks, $latestmusic, $blogpostids;
			';

			foreach ($blogpostids AS $key => $blogpostid) {
				$contents .= '
				$blogpostids['.$key.'] = "' . $blogpostid . '";';
			}

			$contents .= '
			?>';


			// write to file
			$fw = @fwrite($fh, $contents);
			if (!$fw) {
				$error = "Could not write to the file $filename";
			}

			// close file
			fclose($fh);
			include($filename);
		} else {
			if (file_exists($filename)) {
				include($filename);
			} else {
				$error = "Error opening or creating comments cache.";
			}
		}
	}
}

?>
