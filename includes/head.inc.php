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

    <!--fonts-->
    <?php /*
    <script>
        var html = document.getElementsByTagName('html')[0];
        html.className = 'js wf-loading';
        if (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) {
            html.className += ' svg';
        }
        setTimeout(function() {
            html.className = html.className.replace(' wf-loading', '');
        }, 3000)
        WebFontConfig = { fontdeck: { id: 21451 } };
        (function() {
            var wf = document.createElement('script');
            wf.src = '//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    */ ?>

    <!--css-->
	<link rel="stylesheet" href="/css/all.css" type="text/css" />

    <!-- ie html5 and respond shims -->
    <!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="/css/ie.css" />
        <script src="/js/ie.js"></script>
    <![endif]-->

    <!--rss-->
    <link rel="alternate" type="application/rss+xml" title="RSS with summaries" href="http://feeds.feedburner.com/ClagnutSummaries">
	<link rel="alternate" type="application/rss+xml" title="RSS with full posts" href="http://feeds.feedburner.com/Clagnut">


    <!--icons-->
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon"/>
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png" type="image/png"/>

    <title><?php echo strip_tags($title) ?></title>
</head>


