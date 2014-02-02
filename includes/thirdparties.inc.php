<?php

function includeCache($service, $cachewait) {
	global $dr, $blog_id, $$service;
	
	if (!$blog_id OR $blog_id == "") {
		$blog_id = "home";
	}

	// set cache file
	$dr3 = str_replace("/includes/", "", $dr);	
	$filename = $dr3 . "/cache/" . $blog_id . "-" . $service . ".php";
	
	if (file_exists($filename) && ((time() - filectime($filename) < $cachewait))) {
		// use the cached file
		include($filename);
	} else {
		// open file
		$fh = @fopen($filename, "w");
		
		if($fh) {
		
			// get new contents
			switch ($service) {
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
			case "kennedy":
				$contents = makeKennedy();
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
	
	$per_page = 12;
	// $url = "http://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=a13e51b5034d53e70b00b1cb6856fece&user_id=27616775%40N00&tags=$clagnut_mtag&per_page=9";
	$url = "http://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=a13e51b5034d53e70b00b1cb6856fece&tags=$clagnut_mtag&$per_page=12&sort=interestingness-desc";
	#echo "<p><a href='$url'>Flickr API call</a></p>";
	$doc = new DOMDocument();							
	if (@$doc -> load($url)) {

		// build Flickr HTML
	
		$totalphotos = $doc -> getElementsByTagName("photos") -> item(0) -> getAttribute("total");
		$numphotos = ($totalphotos>$per_page)?$per_page:$totalphotos;
		if ($numphotos > 0) {
			$photos = $doc -> getElementsByTagName("photo");
			if ($photos) {
				foreach ($photos as $photo) {
				
					$flickr_id = $photo -> getAttribute("id");
				
					$flickrMarkup .= "<figure class='photo'><a href=\"http://www.flickr.com/photos/clagnut/";
					$flickrMarkup .= $photo -> getAttribute("id");
					$flickrMarkup .= "/\"><img ";
					$flickrMarkup .= "src=\"http://static.flickr.com/";
					$flickrMarkup .= $photo -> getAttribute("server");
					$flickrMarkup .= "/";
					$flickrMarkup .= $flickr_id;
					$flickrMarkup .= "_";
					$flickrMarkup .= $photo -> getAttribute("secret");
					$flickrMarkup .= "_n.jpg\" alt=\"";
					$flickrMarkup .= $photo -> getAttribute("title");
					$flickrMarkup .= "\" /></a><figcaption>";
					$flickrMarkup .= $photo -> getAttribute("title");
					$flickrMarkup .= "</figcaption></figure>\n";					
					$flickr_ids[] = $flickr_id;
		
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

	$url = "http://www.flickr.com/services/rest/?method=flickr.photos.search&api_key=a13e51b5034d53e70b00b1cb6856fece&user_id=27616775%40N00&sort=date-posted-desc&per_page=4";
	//echo "<p><a href='$url'>Flickr API call</a></p>";
	$doc = new DOMDocument();							
	if (@$doc -> load($url)) {

		// build Flickr HTML
	
		$numphotos = $doc -> getElementsByTagName("photos") -> item(0) -> getAttribute("total");
		if ($numphotos > 0) {
			$photos = $doc -> getElementsByTagName("photo");
			if ($photos) {
				foreach ($photos as $photo) {
				
					$latestflickrMarkup .= "<figure class=\"photo\"><a href=\"http://www.flickr.com/photos/clagnut/";
					$latestflickrMarkup .= $photo -> getAttribute("id");
					$latestflickrMarkup .= "/\"><img ";
					$latestflickrMarkup .= "src=\"http://static.flickr.com/";
					$latestflickrMarkup .= $photo -> getAttribute("server");
					$latestflickrMarkup .= "/";
					$latestflickrMarkup .= $photo -> getAttribute("id");
					$latestflickrMarkup .= "_";
					$latestflickrMarkup .= $photo -> getAttribute("secret");
					$latestflickrMarkup .= "_m.jpg\" alt=\"Photo\" /></a><figcaption>";
					$latestflickrMarkup .= htmlentities($photo -> getAttribute("title"));
					$latestflickrMarkup .= "</figcaption></figure>\n";
								}
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
	
	$cachewait = 1000; // seconds
	
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
					$homeFlickrMarkup .= "<figure class=\"photo\"><a href=\"http://www.flickr.com/photos/clagnut/$photoid/\"><img src=\"http://static.flickr.com/$photoserver/$photoid" . "_$photosecret" . "_z.jpg\" alt=\"Photo\"></a><figcaption>$phototitle</figcaption></figure>\n";					
				}
			}
		}
		/*
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
		
		*/
							
	
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
	
	$cachewait = 300; // seconds
	
	includeCache("twitter", $cachewait);
}


function makeTwitter() {
	global $dr;
	include_once($dr . "TwitterAPIExchange.php");
	
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
	    'oauth_access_token' => "11682-4ObPFna3VuoTc8TaD5vtPP2nhwXa5v6c4jMlp0NMcbxg",
	    'oauth_access_token_secret' => "hGruumJGVAXs8LNPl5aOIOfqX4se5nc3S8jzsNVm4QeSy",
	    'consumer_key' => "anNs8HIeSWhTu53PVfSw",
	    'consumer_secret' => "72Ss4Ku4Vwqea1UdLWxqsw2LKhRKUoP514vLR5H49fg"
	);
	
	/** Perform a GET request and echo the response **/
	/** Note: Set the GET field BEFORE calling buildOauth(); **/
	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=clagnut&count=30&exclude_replies=true&include_rts=true&trim_user=true';
	$requestMethod = 'GET';
	$twitter_request = new TwitterAPIExchange($settings);
	$twitter_response = $twitter_request->setGetfield($getfield)
	                           ->buildOauth($url, $requestMethod)
	                           ->performRequest();
	
	$tweets = json_decode($twitter_response,true);	
	
	if (is_array($tweets)) {

		// build Twitter HTML
			
		$twitterMarkup = "";

		foreach ($tweets as $key => $tweet) {
			if ($key<9) {
				$twitterMarkup .= "<article>\n";
				$isotime = strtotime($tweet['created_at']);
				$fuzzyTime = get_elapsedtime($isotime); 
				$twitterMarkup .= "<time datetime=\"$isotime\"><a href=\"https://twitter.com/clagnut/status/". $tweet['id'] ."\">$fuzzyTime</a></time>\n";
				$status_text = SmartyPants($tweet['text']);
				$find = array(
					"`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", # find URLs
					"`(\s|^)@(\w*)\b`i" # find @names
				);
				$replace = array(
					"<a href=\"http\\3://\\5\\6\\8\\9\">\\5\\6\\8\\9</a>", # make URLs links 
					"\\1@<a href=\"http://twitter.com/\\2\">\\2</a>" # make @names links 
				);
				$status_text = preg_replace($find , $replace, $status_text);
				$twitterMarkup .= "<p>$status_text</p>";
				$twitterMarkup .= "\n</article>\n";
			}
		}
			
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
	
	$cachewait = 180; // seconds
	
	includeCache("lastfm", $cachewait);
}


function makeLastfm() {
	
	$lastfmMarkup = "";

	$url = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=clagnut&api_key=7fea57568921f8c8c3cf7ac6a951e560&limit=5";
	#echo "<p><a href='$url'>Lastfm API call</a></p>";
	$doc = new DOMDocument();							
	if (@$doc -> load($url)) {

		// build Lastfm HTML
		
		$tracks = $doc -> getElementsByTagName("track");
		if ($tracks) {
			foreach ($tracks as $track) {
				$track_artist = $track -> getElementsByTagName("artist") -> item(0) -> nodeValue;
				$track_name = $track -> getElementsByTagName("name") -> item(0) -> nodeValue;
				$track_album = $track -> getElementsByTagName("album") -> item(0) -> nodeValue;
				$track_url = $track -> getElementsByTagName("url") -> item(0) -> nodeValue;
				$track_image = $track -> getElementsByTagName("image") -> item(0) -> nodeValue;
				if (!$track_image) {$track_image = "/i/cd.png";}
				
				$lastfmMarkup .= "<article><p><a href=\"$track_url\">";
				$lastfmMarkup .= "<img src=\"$track_image\" alt=\"" . htmlentities($track_album) . "\" class=\"album_cover\" />";
				$lastfmMarkup .= "<cite>" . htmlentities($track_name) . "</cite></a> by " . htmlentities($track_artist);
				$lastfmMarkup .= "</p></article>\n";
			}
		} else {		
			$lastfmMarkup = "<article><p>All's quiet right now.</p></article>\n";
		}	
		
		$lastfmMarkup = SmartyPants($lastfmMarkup);
			
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