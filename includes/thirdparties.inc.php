<?php

function includeCache($service, $cachewait) {
	global $dr, $blog_id, $$service;
	
	if (!$blog_id OR $blog_id == "") {
		$blog_id = "home";
	}

	// set cache file
	$filename = $dr . "/cache/" . $blog_id . "-" . $service . ".php";
	
	if (file_exists($filename) && ((time() - filectime($filename) < $cachewait))) {
		// use the cached file
		include($filename);
	} else {
		// open file
		$fh = @fopen($filename, "w");
		
		if($fh) {
		
			// get new contents
			switch ($service) {
			case "technorati":
				$contents = makeTechnorati();
				break;
			case "flickr":
				$contents = makeFlickr();
				break;
			case "homeflickr":
				$contents = makeHomeFlickr();
				break;
			case "latestflickr":
				$contents = makeLatestFlickr();
				break;
			case "twitter":
				$contents = makeTwitter();
				break;
			case "lastfm":
				$contents = makeLastfm();
				break;
			}
		
			
			if($contents) {
				
				// write to file
				$fw = @fwrite($fh, $contents);
				if (!$fw) {
					$$service = "<p class='internalerror'>Could not write to the cache</p>";
				}
				
				// close file
				fclose($fh);
			}
			include($filename);
		} else {
			if (file_exists($filename)) {
				include($filename);
			} else {
				$$service = "<p class='internalerror'>Error opening or creating cache.</p>";
			}
		}	
	}
}


function getTechnorati() {
	
	$cachewait = 7200; // seconds
	
	includeCache("technorati", $cachewait);
}


function makeTechnorati() {
	global $blog_id;
	
	$technoratiMarkup = "";
				
	$url = "http://api.technorati.com/cosmos?key=7c0d16c38a999886d76de2b30c138ed5&limit=10&format=rss&url=http://clagnut.com/blog/$blog_id/";
	//echo "<p><a href='$url'>Technorati API call</a></p>";
	$doc = new DOMDocument();
	if (@$doc -> load($url)) {
		
		// build Technorati HTML
		
		if ($doc -> getElementsByTagName("error") -> item(0)) {
			// Error code returned
			echo "<!-- Error: ".$doc -> getElementsByTagName("error") -> item(0) -> nodeValue."-->\n";
			$contents = false;
		} else {
			$items = $doc -> getElementsByTagName("item");
			if ($items->length < 1) {
				// No inbound links :-(					
				$technoratiMarkup.= "<p>Nobody is blogging this page.</p>\n";
			} else {
				// we have linklove!
				$technoratiMarkup.="<ul>";
				foreach ($items as $key => $item) {
					// put items into arrays
					$title = $item -> getElementsByTagName("title") -> item(0) -> nodeValue;
					$url = $item -> getElementsByTagName("guid") -> item(0) -> nodeValue;
					$item_titles[$key] = $title;
					$item_urls[$key] = $url;
				}
				
				$item_urls = array_unique($item_urls);
				
				foreach ($item_urls as $key => $url) {
					if(!preg_match('/^http/', $url)) {$url = "http://technorati.com" . $url;}
										
					$technoratiMarkup.= "<li><a href=\"";
					$technoratiMarkup.= htmlspecialchars($url);
					$technoratiMarkup.= "\">";
					$technoratiMarkup.= htmlspecialchars($item_titles[$key]);
					$technoratiMarkup.= "</a></li>\n";
				}
				$technoratiMarkup.="</ul>";
			}
			// build cache contents
			$contents = '
			<?php
			global $technorati;
			$technorati = "'. addslashes($technoratiMarkup) . '";
			?>';
		}
		
	} else {
		$contents = false;
	}
	

	return $contents;
}




function getFlickr() {
	
	$cachewait = 600; // seconds
	
	includeCache("flickr", $cachewait);
}


function makeFlickr() {
	global $blog_id, $post_tags, $post_machinetags;
	
	$flickrMarkup = "";
	$numphotos = 0;
	$flickr_ids = array();
	
	$machinetags = $post_machinetags[$blog_id];
	$clagnut_mtag = urlencode($machinetags[0]);
	
	
	// $url = "http://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=a13e51b5034d53e70b00b1cb6856fece&user_id=27616775%40N00&tags=$clagnut_mtag&per_page=9";
	$url = "http://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=a13e51b5034d53e70b00b1cb6856fece&tags=$clagnut_mtag&per_page=9";
	// echo "<p><a href='$url'>Flickr API call</a></p>";
	$doc = new DOMDocument();							
	if (@$doc -> load($url)) {

		// build Flickr HTML
	
		$totalphotos = $doc -> getElementsByTagName("photos") -> item(0) -> getAttribute("total");
		$numphotos = ($totalphotos>9)?9:$totalphotos;
		if ($numphotos > 0) {
			$photos = $doc -> getElementsByTagName("photo");
			if ($photos) {
				$flickrMarkup .= "<ul class=\"thumbs\" id=\"flickr\">\n";
				foreach ($photos as $photo) {
				
					$flickr_id = $photo -> getAttribute("id");
				
					$flickrMarkup .= "<li><a href=\"http://flickr.com/photos/clagnut/";
					$flickrMarkup .= $photo -> getAttribute("id");
					$flickrMarkup .= "/\"><img ";
					$flickrMarkup .= "src=\"http://static.flickr.com/";
					$flickrMarkup .= $photo -> getAttribute("server");
					$flickrMarkup .= "/";
					$flickrMarkup .= $flickr_id;
					$flickrMarkup .= "_";
					$flickrMarkup .= $photo -> getAttribute("secret");
					$flickrMarkup .= "_s.jpg\" alt=\"";
					$flickrMarkup .= $photo -> getAttribute("title");
					$flickrMarkup .= "\" title=\"";
					$flickrMarkup .= $photo -> getAttribute("title");
					$flickrMarkup .= "\" /></a></li>\n";
					
					$flickr_ids[] = $flickr_id;
		
				}
			}
		}		
	}
	
	if ($numphotos == 9) {
		$flickrMarkup .= "</ul>";
	} else {
	
		$flickrtags = "";
		foreach($post_tags[$blog_id] AS $tag) {
			if ($tag != "geotagged" && $tag != "booktagged") {
				$flickrtags = $flickrtags . "," . urlencode($tag);
			}
		}
		
		$photostofetch = 9 + $numphotos;
			
		$url = "http://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=a13e51b5034d53e70b00b1cb6856fece&user_id=27616775%40N00&tags=$flickrtags&sort=relevance&per_page=$photostofetch";
		//echo "<p><a href='$url'>Flickr API call</a></p>";
		$doc = new DOMDocument();							
		if (@$doc -> load($url)) {
	
			// build Flickr HTML
		
			$totalphotos = $doc -> getElementsByTagName("photos") -> item(0) -> getAttribute("total");
			if ($totalphotos > 0) {			
				if($numphotos == 0) {
					$flickrMarkup .= "<ul class=\"thumbs\" id=\"flickr\">\n";
				}
				$photos = $doc -> getElementsByTagName("photo");
				if ($photos) {
					foreach ($photos as $photo) {
						if ($numphotos < 9) {
						
							$flickr_id = $photo -> getAttribute("id");
							
							if(!in_array($flickr_id, $flickr_ids)) {
								
								$phototitle = $photo -> getAttribute("title");
								
								$flickrMarkup .= "<li><a href=\"http://flickr.com/photos/clagnut/";
								$flickrMarkup .= $photo -> getAttribute("id");
								$flickrMarkup .= "/\"><img ";
								$flickrMarkup .= "src=\"http://static.flickr.com/";
								$flickrMarkup .= $photo -> getAttribute("server");
								$flickrMarkup .= "/";
								$flickrMarkup .= $flickr_id;
								$flickrMarkup .= "_";
								$flickrMarkup .= $photo -> getAttribute("secret");
								$flickrMarkup .= "_s.jpg\" alt=\"";
								$flickrMarkup .= htmlentities($phototitle);
								$flickrMarkup .= "\" title=\"";
								$flickrMarkup .= htmlentities($phototitle);
								$flickrMarkup .= "\" /></a></li>\n";
																
								$numphotos++;
							}
						}
					}
					$flickrMarkup .= "</ul>";
				}
			}		
		}
	}
	
	if ($flickrMarkup != "") {
		// build cache contents
		$contents = '
		<?php
		global $flickr;
		$flickr = "'. addslashes($flickrMarkup) . '";
		?>';
	} else {
		$contents = false;
	}

	return $contents;
}

function getlatestFlickr() {
	
	$cachewait = 600; // seconds
	
	includeCache("latestflickr", $cachewait);
}

function makelatestFlickr() {
	$latestflickrMarkup = "";

	$url = "http://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=a13e51b5034d53e70b00b1cb6856fece&user_id=27616775%40N00&sort=date-posted-desc&per_page=9";
	//echo "<p><a href='$url'>Flickr API call</a></p>";
	$doc = new DOMDocument();							
	if (@$doc -> load($url)) {

		// build Flickr HTML
	
		$numphotos = $doc -> getElementsByTagName("photos") -> item(0) -> getAttribute("total");
		if ($numphotos > 0) {
			$photos = $doc -> getElementsByTagName("photo");
			if ($photos) {
				$latestflickrMarkup .= "<ul class=\"thumbs\" id=\"flickr\">\n";
				foreach ($photos as $photo) {
				
					$latestflickrMarkup .= "<li><a href=\"http://flickr.com/photos/clagnut/";
					$latestflickrMarkup .= $photo -> getAttribute("id");
					$latestflickrMarkup .= "/\"><img ";
					$latestflickrMarkup .= "src=\"http://static.flickr.com/";
					$latestflickrMarkup .= $photo -> getAttribute("server");
					$latestflickrMarkup .= "/";
					$latestflickrMarkup .= $photo -> getAttribute("id");
					$latestflickrMarkup .= "_";
					$latestflickrMarkup .= $photo -> getAttribute("secret");
					$latestflickrMarkup .= "_s.jpg\" alt=\"";
					$latestflickrMarkup .= htmlentities($photo -> getAttribute("title"));
					$latestflickrMarkup .= "\" title=\"";
					$latestflickrMarkup .= htmlentities($photo -> getAttribute("title"));
					$latestflickrMarkup .= "\" /></a></li>\n";
		
				}
				$latestflickrMarkup .= "</ul>";
			}
		}
						
	
		// build cache contents
		$contents = '
		<?php
		global $latestflickr;
		$latestflickr = "'. addslashes($latestflickrMarkup) . '";
		?>';
		
	} else {
		$contents = false;
	}

	return $contents;
}


function getHomeFlickr() {
	
	$cachewait = 600; // seconds
	
	includeCache("homeflickr", $cachewait);
}


function makeHomeFlickr() {
	$homeFlickrMarkup = "";

	$url = "http://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=a13e51b5034d53e70b00b1cb6856fece&user_id=27616775%40N00&tags=fave&sort=date-taken-desc&per_page=1";
	//echo "<p><a href='$url'>Flickr API call</a></p>";
	$doc = new DOMDocument();							
	if (@$doc -> load($url)) {

		// build Flickr HTML
	
		$numphotos = $doc -> getElementsByTagName("photos") -> item(0) -> getAttribute("total");
		if ($numphotos > 0) {
			$photos = $doc -> getElementsByTagName("photo");
			if ($photos) {
				foreach ($photos as $photo) {
					$photoid = $photo -> getAttribute("id");
					$photoserver = $photo -> getAttribute("server");
					$photosecret = $photo -> getAttribute("secret");
					$phototitle = $photo -> getAttribute("title");
					$phototitle = htmlentities(stripslashes($phototitle));
					$homeFlickrMarkup .= "<h2><a href=\"http://flickr.com/photos/clagnut/" . $photoid . "/\">$phototitle</a></h2>\n";
					$homeFlickrMarkup .= "<p><a href=\"http://flickr.com/photos/clagnut/" . $photoid . "/\"><img src=\"http://static.flickr.com/" . $photoserver . "/" . $photoid . "_" . $photosecret . ".jpg\" alt=\"View " . $phototitle . " on Flickr\" /></a>\n";
				}
			}
		}
		
		$url = "http://www.flickr.com/services/rest/?method=flickr.photos.getInfo&api_key=a13e51b5034d53e70b00b1cb6856fece&photo_id=$photoid";
		// echo "<p><a href='$url'>Flickr API call</a></p>";
		$doc = new DOMDocument();							

		if (@$doc -> load($url)) {
	
			// build Flickr HTML
		
			$photodescription = $doc -> getElementsByTagName("description") -> item(0) -> nodeValue;
			if($photodescription != "") {
				$homeFlickrMarkup .= "<span>" . $photodescription . "</span>\n";
			}
		}
		
		
		$homeFlickrMarkup .= "</p>\n";		
							
	
		// build cache contents
		$contents = '
		<?php
		global $homeflickr;
		$homeflickr = "'. addslashes($homeFlickrMarkup) . '";
		?>';
		
	} else {
		$contents = false;
	}

	return $contents;
}


function getTwitter() {
	
	$cachewait = 120; // seconds
	
	includeCache("twitter", $cachewait);
}


function makeTwitter() {

	$url = "http://twitter.com/statuses/user_timeline/clagnut.xml";
	// echo "<p><a href='$url'>Twitter API call</a></p>";
	$doc = new DOMDocument();							
	if (@$doc -> load($url)) {

		// build Twitter HTML
			
		$twitterMarkup = "<ul>\n";

		$statuses = $doc -> getElementsByTagName("status");
		if ($statuses) {
			foreach ($statuses as $key => $status) {
				if ($key < 5) {
					$status_id = $status -> getElementsByTagName("id") -> item(0) -> nodeValue;
					$status_text = $status -> getElementsByTagName("text") -> item(0) -> nodeValue;
					$status_created_at = $status -> getElementsByTagName("created_at") -> item(0) -> nodeValue;
					
					$status_created_at_Unix = strtotime($status_created_at);
					$status_created_at_iso8601 = date("c", $status_created_at_Unix);
					$status_created_at_relative = get_elapsedtime($status_created_at_Unix);
					
					$twitterMarkup .= "<li class=\"hentry\">\n";
					$twitterMarkup .= "
			<a href=\"http://twitter.com/clagnut/statuses/" . $status_id . "\" rel=\"bookmark\" class=\"published\"><abbr title=\"" . $status_created_at_iso8601 . "\">" . $status_created_at_relative . "</abbr></a>\n";
					$status_text = htmlentities($status_text);
					$find = array(
						"`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", # find URLs
						"`(\s|^)@(\w*)\b`i" # find @names
					);
					$replace = array(
						"<a href=\"http\\3://\\5\\6\\8\\9\">http\\3://\\5\\6\\8\\9</a>", # make URLs links 
						"\\1@<a href=\"http://twitter.com/\\2\">\\2</a>" # make @names links 
					);
					$status_text = preg_replace($find , $replace, $status_text);
					$twitterMarkup .= "
			<p class=\"entry-title\">" . $status_text . "</p>\n";
					$twitterMarkup .= "</li>\n";
				}
			}
		}
		
		
		$twitterMarkup .= "</ul>\n";
			
		// build cache contents
		$contents = '
		<?php
		global $twitter;
		$twitter = "'. addslashes($twitterMarkup) . '";
		?>';
		
	} else {
		$contents = false;
	}

	return $contents;
}


function getLastfm() {
	
	$cachewait = 120; // seconds
	
	includeCache("lastfm", $cachewait);
}


function makeLastfm() {

	$url = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=clagnut&api_key=7fea57568921f8c8c3cf7ac6a951e560&limit=1";
	// echo "<p><a href='$url'>Lastfm API call</a></p>";
	$doc = new DOMDocument();							
	if (@$doc -> load($url)) {

		// build Lastfm HTML
			
		$lastfmMarkup = "<p>";
		
		$track = $doc -> getElementsByTagName("track");
		if ($track) {
			$track_artist = $doc -> getElementsByTagName("artist") -> item(0) -> nodeValue;
			$track_name = $doc -> getElementsByTagName("name") -> item(0) -> nodeValue;
			$track_album = $doc -> getElementsByTagName("album") -> item(0) -> nodeValue;
			$track_url = $doc -> getElementsByTagName("url") -> item(0) -> nodeValue;
			$track_image = $doc -> getElementsByTagName("image") -> item(0) -> nodeValue;
			
			if ($track_image) {
				$lastfmMarkup .= "<a href=\"$track_url\"><img src=\"$track_image\" alt=\"" . htmlentities($track_album) . "\" class=\"album_cover\" /></a>";
			}
			$lastfmMarkup .= "<cite>" . htmlentities($track_name) . "</cite> &middot; " . htmlentities($track_artist);
		} else {		
			$lastfmMarkup .= "All’s quiet right now";
		}
				
		$lastfmMarkup .= "</p>\n";
			
		// build cache contents
		$contents = '
		<?php
		global $lastfm;
		$lastfm = "'. addslashes($lastfmMarkup) . '";
		?>';
		
	} else {
		$contents = false;
	}

	return $contents;
}

?>