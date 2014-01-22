<?php
// Turn on PHP Error Reporting
#ini_set("display_errors","2");
#ERROR_REPORTING(E_ALL);

// get variables from query
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:""; 
$title = (isset($_REQUEST["title"]))?$_REQUEST["title"]:""; 
$author = (isset($_REQUEST["author"]))?$_REQUEST["author"]:""; 
$email = (isset($_REQUEST["email"]))?$_REQUEST["email"]:""; 
$web = (isset($_REQUEST["web"]))?$_REQUEST["web"]:""; 
$comment = (isset($_REQUEST["comment"]))?$_REQUEST["comment"]:""; 
$rememberme = (isset($_REQUEST["rememberme"]))?$_REQUEST["rememberme"]:""; 
$preview = (isset($_REQUEST["preview"]))?$_REQUEST["preview"]:""; 
$submit = (isset($_REQUEST["submit"]))?$_REQUEST["submit"]:""; 

$commenting = "enabled";

if(!$id) {
	Header("Location: /archive/");
	// Header("Location: /blog/index.php?id=1484");
}

$blog_id = $id;

$dr = $_SERVER["DOCUMENT_ROOT"];
include_once($dr . "/includes/path_to_db.inc.php");

// add referrer
include($dr . "/includes/blacklisted.php");
			
// format post
include_once($dr . "/includes/format.php");

// get posts and comments
include_once($dr . "/includes/getposts.inc.php");

// get 3rd party data
include_once($dr . "/includes/thirdparties.inc.php");


// if comment submitted then get comments posted in last minute and put IP addresses into an array
// we'll check later that the current poster hasn't posted in the last minute

if ($submit) {
	include($dr2 . "/db_connect.php");
	$sql = "SELECT ip FROM comments WHERE commentstamp + INTERVAL 2 MINUTE > '".gmdate("Y-m-d H:i:s")."'";
	$result = mysql_query($sql);
	if ($myblog = mysql_fetch_array($result)) {
		do {
			$recent_ips[] = $myblog['ip'];
		} while ($myblog = mysql_fetch_array($result));
	}
}


// check comment input
if(($submit OR $preview) AND $commenting == "enabled") {
	$error = 0;
	if($web == "http://") {$web = "";}

	//strip out whitespace
	$author = trim(strip_tags($author));
	$email = trim(strip_tags($email));
	$web = trim(strip_tags($web));
	$comment = trim($comment);
	$ip = trim($_SERVER["REMOTE_ADDR"]);
	
	// error trapping
	// if url or comment contains blacklisted urls	
	if (blacklisted($author, $email, $web, $comment, $ip, $blog_id)) {
		$error = 1;	
		$spamerror = "For some reason, it looks like you may be attempting to spam this website. For the time being your IP address (" . $_SERVER["REMOTE_ADDR"] . ") has been logged. If you believe this to be in error, please <a href='/contact/'>contact me</a>.";
	}
	// if this IP address has posted in the last minute
	elseif(isset($recent_ips) AND in_array($ip,$recent_ips)) {
		$error = 1;
		$generalerror = "Thanks for posting. I only allow one comment every couple of minutes, so take it easy and try again in a moment.";
	}
	else {
		// NAME CHECK	
	
		// if the name is missing
		if(!$author) {
			$error = 1;
			$nameerror = "Please provide a name.";
		} else {
			// blacklisted names
			$nope = "/viagra|xanax|phentermine|tramadol|cialis|levitra|ultram|alprazolam|valium|adipex|klonopin|xenical|effexor|diazepam/i";
			if(preg_match($nope, $author)) {
				$error=1;	
				$spamerror = "It seems that you are attempting to spam this website. Your IP address (" . $_SERVER["REMOTE_ADDR"] . ") has been logged. If you believe this to be in error, please <a href='/contact/'>contact me</a>.";
			} else {
				// my names not allowed
				$nope = array("Rich","Richard","Rich R","Rich R.","RichR","Richard R","Richard R.","Rich Rutter","Richard Rutter","Dick","Dickie","Dicky");
				if(in_array($author,$nope)) {
					$error=1;
					$nameerror = "Sorry, you can't use my name to post a comment. If you too are called Richard, try including your surname as well.";	
				}
			}
		}
		
		// EMAIL CHECK
		
		// if the email is missing
		if(!$email) {
			$error = 1;
			$emailerror = "Please provide your email address (it won't be displayed).";
		} else {
			// not a valid looking email addy
			if (!preg_match("/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i", $email)) {
				$error = 1;
				$emailerror = "That doesn't appear to be a real email address. Please check and try again.";
			}
			// email addys not allowed
			$nope = array("rich@clagnut.com");
			if(in_array($email,$nope) && $author != "fugazi") {
				$error=1;
				$emailerror = "Sorry, you can't use my email address to post a commment. Try using your own email address.";	
			}		
		}
		
		// COMMENT CHECK
		
		// if the comment is missing
		if(!$comment) {
			$error = 1;
			$commenterror = "Please write a comment.";
		}
		
		if ($author == "fugazi") {
			$actualauthor = "Rich";
		} else {
			$actualauthor = $author;
		}
	}
}


getpost($blog_id);

// submit comment

if($submit AND $error == 0 AND $commenting == "enabled" AND $post_comments_expired[$blog_id] == false) {
	$commentstamp = gmdate("Y-m-d H:i:s");
	$f_actualauthor = addslashes($actualauthor);
	$f_comment = addslashes($comment);
	$sql = "INSERT INTO comments (comment_id,blogID,author,email,web,commentstamp,comment,ip) VALUES (NULL,'$blog_id','$f_actualauthor','$email','$web','$commentstamp','$f_comment','$ip')";
	$result = mysql_query($sql);
	if ($result) {
		$comment_id = mysql_insert_id();
		$success = "<p><strong class='success'>Comment added. Thank you.</strong></p>";
		$message = "Comment on '".$post_headtitle[$blog_id]."'"."\r\n"
			."http://www.clagnut.com/blog/".$blog_id."#c".$comment_id."\r\n\r\n"
			.$comment."\r\n\r\n"
			.$actualauthor." (".$web.")\r\n\r\n"
			.$_SERVER["REMOTE_ADDR"]."\r\n"
			."del: http://www.clagnut.com/cms/blacklist.php?comment_id=".$comment_id."&comment_url=".$web."\r\n";
		$message = stripslashes($message);
		$message = stripcslashes($message);
		$header = "From: ".$actualauthor." <".$email.">\r\n"
			."Reply-To: ".$email;
		@mail("rich@clagnut.com", "clagnut comment added to: ".$post_headtitle[$blog_id], $message, $header);
	} else {
		$generalerror = "Comment not added. MySQL said " . mysql_error();
	}

	// set cookie to remember details
	if ($rememberme == true) {
		$host = ($_SERVER["HTTP_HOST"]=='brockmann.clagnut.dev')?'.clagnut.dev':'.clagnut.com';
		setcookie ("author", $author, time()+2592000, "/", $host, 0);
		setcookie ("email", $email, time()+2592000, "/", $host, 0);
		setcookie ("web", $web, time()+2592000, "/", $host, 0);
	}
	
	// direct to blog page to eliminate repeat posts
	// Header("Location: /blog/$blog_id/");
}


// get cookies for empty form elements
if (isset($_COOKIE["author"]) && $author=="") {$author = $_COOKIE["author"];}
if (isset($_COOKIE["email"]) && $email=="") {$email = $_COOKIE["email"];}
if (isset($_COOKIE["web"]) && $web=="") {$web = $_COOKIE["web"];}


getcomments($blog_id);

// Format comments for inclusion

if (isset($commentsAr) && is_array($commentsAr)) {
	$numcomments = count($commentsAr);
} else {
	$numcomments = 0;
}

$comments_plural = plural($numcomments);

if ($numcomments == 0) {
	$comments_list = "<p>No comments yet. Be the first!</p>";
} else {
	$comments_list = "<ol class='comments'>";
	foreach($commentsAr AS $comment_item) {
		$comments_list .= stripslashes($comment_item);
	}
	$comments_list .= "</ol>";
	
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $post_headtitle[$blog_id] . " | Clagnut " . strip_tags($post_categories[$blog_id]); ?></title>
<?php
include($dr . "/includes/headlinks.inc.php");
include($dr . "/includes/rsslinks.inc");

if (array_search("geotagged", $post_tags[$blog_id])) {
	$hostname = $_SERVER["HTTP_HOST"];
	switch ($hostname) {
		case "clagnut.dev":
		   $key = "ABQIAAAAc_36JcTDBZ0r8U_hqNSt3hQW79BAJwxdgYJUvLUbR29GpoL9EBTl17CeB1Bx8XC1-Cf7z5yM_2Wcww";
		   break;
		case "beta.clagnut.com":
		   $key = "ABQIAAAAc_36JcTDBZ0r8U_hqNSt3hTJoOmXybdqAbfUFnOLjrf0nMlXixR4emiet-MGLvX0Sf5dMN_TDj1OXg";
		case "brockmann.clagnut.dev":
		   $key = "ABQIAAAAc_36JcTDBZ0r8U_hqNSt3hQ8pBZO0h-Sq56fCPh229zeR7OyPxT915MO2XKiH5lIsUuKwMDCL-Dp1g";
		   break;
 		case "brockmann.clagnut.com":
		   $key = "ABQIAAAAc_36JcTDBZ0r8U_hqNSt3hQNPcPWjG4Tx-Te47qR4cHq2PKNoBRw-OornzBkPylMMdMIytQZTuzMeQ";
		   break;
		default:
		   $key = "ABQIAAAAc_36JcTDBZ0r8U_hqNSt3hQLfSHW_dCG3JT3gk3PpTWERLBN7xSueP1wt617oMP7ycZTRtTJtFYDIw";
	}
	echo "<script src='http://maps.google.com/maps?file=api&amp;v=1&amp;key=$key' type='text/javascript'></script>";
}
?>

<meta name="description" content="<?php echo $post_description[$blog_id] ?>" />
<meta name="keywords" content="<?php echo implode(',', $post_tags[$blog_id]) ?>" />

</head>
<body id="blog" class="hfeed">

<?php include($dr . "/includes/masthead.inc.php"); ?>

<div id="content" class="wrapper">

<div class="hentry">
		<h1 class="entry-title"><?php echo $post_title[$blog_id] ?></h1>
		<?php echo $post_mainimage[$blog_id] ?>
	<div class="primary">
		
		<div class="entry-content">	
		<div class="segment">
		<?php
		$maincontent = preg_replace("/^<p>/", "<p><span class='para'>&para; </span>", $post_maincontent[$blog_id]);
		echo stripslashes($maincontent);
		?>
		</div>
	
		</div>  <!-- /.entry-content -->
	
	</div> <!-- /.primary -->
	
	<div class="secondary">
	
		<div class="meta">
			<p class="published"><abbr title="<?php echo $post_isodate[$blog_id] ?>"><?php echo $post_postdate[$blog_id] ?></abbr></p>
			<?php echo $post_categories[$blog_id] ?>
			<p class="comments"><a href="#comments"><?php echo "$numcomments comment$comments_plural";?></a></p>
		</div>
		
		<?php if ($post_map[$blog_id] != "") {echo $post_map[$blog_id];} ?>
		
		
		<?php		
		getFlickr();
		if (isset($flickr)) {
		?>
			<div class="photos">
			<h2>Related photos</h2>
		<?php
			echo $flickr;
		?>
			</div>
		<?php
		}
		?>
	</div> <!-- /secondary-->
</div> <!-- /hentry-->
	
	<div class="tertiary">
	<?php if ($post_recent[$blog_id]) { ?>
	<h3>Next</h3>
	<ul class="next">
	<li><a href="/blog/<?php echo $post_recent[$blog_id] ?>/"><?php echo $post_recenttitle[$blog_id] ?></a></li>
	</ul>
	<?php } ?>
	
	<?php if ($post_older[$blog_id]) { ?>
	<h3>Previous</h3>
	<ul class="prev">
	<li><a href="/blog/<?php echo $post_older[$blog_id] ?>/"><?php echo $post_oldertitle[$blog_id] ?></a></li>
	</ul>
	<?php } ?>
	
	<h2>Related posts</h2>
	<?php echo $post_related_posts[$blog_id] ?>
	
	<h2>Keywords</h2>
	<?php
	if (count($post_tags[$blog_id])>0) {
		echo "<ul class='tags'>";
		foreach($post_tags[$blog_id] AS $tag) {
			echo "<li><a href='/search/?q=" . urlencode($tag) . "' rel='tag'>" . htmlentities($tag) . "</a></li>";
		}
		echo "</ul>";
	} else {
		echo "<p class='tags'>- none -</p>";
	}
	?>
	
	<?php
	if (count($post_machinetags[$blog_id])>0) {
	?>
		<h4 id="machine_tags_toggle"><a href="#machine_tags" class="arrow">►</a> Machine tags</h4>
	
		<ul class='machine tags' id='machine_tags'>
	<?php
		foreach($post_machinetags[$blog_id] AS $machinetag) {
			echo "<li><a href='/search?q=" . urlencode($machinetag) . "' rel='tag'>" . htmlentities($machinetag) . "</a></li>\n";
		}
	?>
		</ul>
	<?php }	?>
	
	</div> <!-- /tertiary-->

</div> <!-- /content-->

<div id="appendix" class="wrapper">
	<div id="comments">
	
	<div class="primary">
	<h2>Comments</h2>
	<?php echo $comments_list ?>
	</div> <!-- /primary -->
	
	<div class="secondary">
	<h2 id="add-your-comment">Add your comment</h2>
<?php	
	if ($commenting == "enabled" && $post_enable_comments[$blog_id] == "yes" && !$post_comments_expired[$blog_id] && !isset($spamerror)) {
	// show comment form
?>

	<script type="text/javascript">
	  var blogTool              = "clagCMS";
	  var blogURL               = "http://clagnut.com/";
	  var blogTitle             = "Clagnut";
	  var postURL               = "http://clagnut.com/blog/<?php echo $blog_id; ?>/";
	  var postTitle             = "<?php echo $post_headtitle[$blog_id]; ?>";
	  var commentTextFieldName  = "comment";
	  var commentButtonName     = "submit";
	  var commentAuthorLoggedIn = false;
	  var commentAuthorFieldName = "author";
	  var commentFormID         = "fm-comment";
	</script>

	<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>#add-your-comment" id="fm-comment">
	
	<?php if(isset($success)) {echo $success;} ?>
	<?php if(isset($error) && $error == 1) {echo "<p class='error'>We have a problem&#8230;</p>";} ?>
	<?php if(isset($generalerror)) {echo "<p class='error'>$generalerror</p>";} ?>
	<input type="hidden" name="id" value="<?php echo $blog_id ?>" />
	<input type="hidden" name="title" value="<?php echo $title ?>" />
	
	<div class="text-container container">
		<label for="author">Your name <span class="hint">required</span></label>
		<input type="text" id="author" name="author" value="<?php echo $author?>" />
		<?php if(isset($nameerror)) {echo "<p class='error'>$nameerror</p>";} ?>
	</div>
	<div class="text-container container">
		<label for="email">Your email <span class="hint">required (not shown, gravatar enabled)</span></label>
		<input type="text" id="email" name="email" value="<?php echo $email?>" />
		<?php if(isset($emailerror)) {echo "<p class='error'>$emailerror</p>";} ?>
	</div>
	<div class="text-container container">
		<label for="web">Your <em>personal</em> website <span class="hint">optional</span></label>
		<input type="text" id="web" name="web" value="<?php echo $web?>" />
		<?php if(isset($weberror)) {echo "<p class='error'>$weberror</p>";} ?>
	</div>
	<div class="textarea-container container">
		<label for="comment">Your comment <span class="hint">required, <a href="http://textism.com/tools/textile/">Textile</a> enabled</span></label>
		<textarea id="comment" name="comment" rows="15" cols="40"><?php echo $comment?></textarea>
		<?php if(isset($commenterror)) {echo "<p class='error'>$commenterror</p>";} ?>
	</div>
	<div class="checkbox-container container">
		<label for="rememberme"><input title="Set some friendly cookies" type="checkbox" name="rememberme" id="rememberme" value="true" <?php if (isset($_COOKIE["email"]) OR isset($_COOKIE["web"]) OR isset($_COOKIE["author"]) OR $rememberme==true) {echo "checked='checked' ";} ?>/>
		Remember me</label> or <a href="/blog/forgetme/" title="Remove cookies">forget me</a>
	</div>
	<div class="button-container container">
		<input type="submit" value="Submit" name="submit" />
	</div>
	</form>
	
	<?php
} else {
	// comments disabled so say why
	if ($post_comments_expired[$blog_id]) {
		echo "<p>Comments are now <strong>closed</strong> on this post. If you have more to say please <a href='/contact/'>contact me</a> directly.</p>";
	} elseif ($post_enable_comments[$blog_id] != "yes") {
		echo "<p>Commenting is closed for this post.</p>";
	} elseif (isset($spamerror)) {
		echo "<p class='error'>$spamerror</p>";
	} else {
		echo "<p>Sorry &#8211; commenting has been temporarily disabled.</p>";
	}
}
?>
	</div> <!-- /secondary-->
	
	</div> <!-- /#comments -->
	
	<div class="tertiary">
	<h2>Outside interest</h2>
	
	<?php
	getTechnorati();
	if (isset($technorati)) {
	?>
		<h3>Technorati <a href="http://technorati.com/search/clagnut.com%2Fblog%2F<?php echo $blog_id ?>%2F?language=n&amp;authority=n"><img src="/images/technorati.gif" alt="references" title="Other blogs referencing this post on Technorati" /></a></h3>
	<?php
		echo $technorati;
	}
	?>
	
	<h3>Top Referrers</h3>
	<?php echo $post_referrers[$blog_id]; ?>
	</div> <!-- /tertiary-->

</div> <!-- /appendix-->

<?php include($dr . "/includes/footer.inc.php"); ?>

</body>
</html>
