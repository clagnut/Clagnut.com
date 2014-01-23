<?php
// Checks string against black list of URLs
// Used for referrers, comment URLs and comments



function blacklisted($author, $email, $web, $comment, $ip, $blog_id) {
	global $dr, $dr2;
	
	# pull in blacklist from file
	$filename = $dr."/blacklist/blacklist.txt";

	# read file into array one line at a time
	$blacklist = @file($filename);
	
	# whitelist array of allowed URLs that would otherwise be blocked
	$whitelist = array("clagnut.com", "clagnut.dev", "mbravo.spb.ru", "shot.pl", "google.pl", "ingoal.info", "holst.biz", "theninelives.com", "dorward.me.uk", "dvergin", "cssblast.ru", "tomanthony", "printmag.com");
	
	
	include($dr2 . "/db_connect.php");
	include_once($dr . "/includes/akismet.class.php");
	
	$blacklisted = false;
	$whitelisted = false;

	if ($blacklist) {
		# loop through blacklist array
		foreach ($blacklist as $badurl) {
			# ignore line in blacklist if empty or beginning with #
			$badurl = trim($badurl);
			# add slashes to regex string so URLs are OK
			$badurl = str_replace("/", "\/", $badurl);
			if ($badurl != "" AND !preg_match ("/^#/", $badurl)) {
				$badexpr = "/".$badurl."/i";
				if (preg_match($badexpr, $comment) OR preg_match($badexpr, $web)) {
					# we have a blacklist match!
					$blacklisted = true;
					
					#check it's not a white listed url
					foreach ($whitelist as $goodurl) {
						# add slashes to regex string so URLs are OK
						$goodurl = str_replace("/", "\/", $goodurl);
						$goodexpr = "/".$goodurl."/i";
						if (preg_match($goodexpr, $string)) {
							$whitelisted = true;
						}
					}
				}
			}
		}
	}
	
	if($blacklisted == false && $whitelisted == false) {
		# not in my blacklist or whitelist so check askimet
	
		/*
		$vars = array();
		
		// Add the contents of the $_SERVER array, to help Akismet out
		foreach ( $_SERVER as $key => $val ) { $vars[ $key ] = $val; }
		
		$vars["comment_type"] = "comment";         // May be blank, comment, trackback, etc
		$vars["comment_author"] = $author;       // Submitted name with the comment
		$vars["comment_author_email"] = $email; // Submitted email address
		$vars["comment_author_url"] = $web;   // Commenter URL
		$vars["comment_content"] = $comment;      // The content that was submitted
		echo akismet_check( $vars );

		if ( akismet_check( $vars ) ) {
			$blacklisted = true;
			$badexpr = "askimet";
		}
		*/
		
      $WordPressAPIKey = '51d7da7059ed';
      $MyBlogURL = 'http://clagnut.com/';
      $akismet = new Akismet($MyBlogURL ,$WordPressAPIKey);
      $akismet->setCommentAuthor($author);
      $akismet->setCommentAuthorEmail($email);
      $akismet->setCommentAuthorURL($web);
      $akismet->setCommentContent($comment);
      $akismet->setPermalink('http://clagnut.com/blog/$blog_id/');
      if($akismet->isCommentSpam()) {
			$blacklisted = true;
			$badexpr = "askimet";
      }


	}
	
	
	if ($blacklisted == true && $whitelisted == false) {					
		# if he's a bad boy commenter then stick his ip address in the db
		if($ip != "" AND $ip != "127.0.0.1") {
			$sql = "SELECT blacklisted_id from blacklisted WHERE ip = '$ip'";
			$result = mysql_query($sql);
			if ($myblacklisted = mysql_fetch_array($result)) {
				$sql = "UPDATE blacklisted SET
					counter = counter+1,
					ip = '$ip',
					comment = '$comment',
					url = '$web',
					regexmatch = '$badexpr',
					WHERE blacklisted_id = $myblacklisted[blacklisted_id]";
				$result = mysql_query($sql);
			} else {	
				$sql = "INSERT INTO blacklisted
					(blacklisted_id,ip,page,url,regexmatch,counter) VALUES
					(NULL,'$ip','$page','$string','$badexpr',1)";					
				$result = mysql_query($sql);
			}
		}
		return true;
	}
	
	# check for blacklisted IP
	/*
	$sql = "SELECT blacklisted_id from blacklisted WHERE ip = '$ip'";
	$result = mysql_query($sql);
	if ($myblacklisted = mysql_fetch_array($result)) {
		$sql = "UPDATE blacklisted SET
			counter = counter+1,
			ip = '$ip',
			page = '$page',
			url = '$string',
			regexmatch = '$badexpr',
			WHERE blacklisted_id = $myblacklisted[blacklisted_id]";
		$result = mysql_query($sql);
		return true;
	}
	*/
	return false;
}
?>