<?php

// Turn on PHP Error Reporting
ini_set("display_errors","2");
ERROR_REPORTING(E_ALL);
?>

<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8"/>
    <meta name="author" content="Richard Rutter"/>
    <meta name="robots" content="index, follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<script>
	    var html = document.getElementsByTagName('html')[0];
	    html.className = 'js';
	</script>
	
    <?php /*
    <!--fonts-->
    <script>
        var html = document.getElementsByTagName('html')[0];
        html.className = 'js wf-loading';
        setTimeout(function() {
            html.className = html.className.replace(' wf-loading', '');
        }, 3000)
        WebFontConfig = { fontdeck: { id: 17222 } };
        (function() {
            var wf = document.createElement('script');
            wf.src = '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    */ ?>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/js/global.js"></script>

    <!--css-->
	<link rel="stylesheet" href="/css/all<?php echo $old ?>.css" type="text/css" />
    <!-- ie html5 and respond shims -->
    <!--[if lt IE 9]>
        <script src="/js/ie.js"></script>
    <![endif]-->

    <!--rss-->
    <link rel="alternate" type="application/rss+xml" title="RSS with summaries" href="http://feeds.feedburner.com/ClagnutSummaries">
	<link rel="alternate" type="application/rss+xml" title="RSS with full posts" href="http://feeds.feedburner.com/Clagnut">

    <title><?php
    echo strip_tags($title);
    if($title != "") {
    	echo " | Clagnut";
    } else {
    	echo "Clagnut by Richard Rutter";
    }
    ?>
    </title>
</head>


