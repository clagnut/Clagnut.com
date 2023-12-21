<?php 
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "format.php");

if (!isset($meta_title)) {
	$meta_title = $title;
}
?>

<!DOCTYPE html>
<html lang="en-gb">

<head>
<?php include($dr . "head.inc.php"); ?>

    <title><?php echo strip_tags($meta_title) . " | Clagnut"; ?></title>
    
    <meta name="description" content="<?php echo $meta_description ?>" />
    <meta name="keywords" content="<?php echo $meta_keywords ?>" />
    <meta name="author" content="Richard Rutter" />  
    
    <!-- Twitter Card -->
    
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@clagnut" />
    <meta name="twitter:title" content="<?php echo strip_tags($meta_title) ?>" />
    <meta name="twitter:description" content="<?php echo $meta_description ?>" />
    <meta name="twitter:image" content="https://clagnut.com/i/rrutter.jpg" />
    
</head>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main>
<div class="page">
<article>

<header>

<h1><?php echo $title ?></h1>

<div class="center">
<div class="meta"> </div>
</div>
</header>