<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

$title = "Speaking";
$meta_title = "Richard Rutter - Speaking";
$meta_description = "";
$meta_keywords = "";

include_once($dr . "writing_header.inc.php");

?>

<section class="vcard">
<div class="prose">

<p><strong class="intro">Hi, I’m <a class="url uid" rel="me" href="http://clagnut.com"><span class="fn">Richard Rutter</span></a>. I speak at conferences and events all over the world on a range of topics around digital design.</strong></p>
<p>I’m particularly passionate about service design, developing design teams, and web typography (which I’ve been evangelising since 2005).
<p>If you’re interested in having me speak at your event please <strong><a href="#contact">get in touch</a></strong>. I’m equally happy talking at grassroots meet-ups as I am at global conferences.</p>

<?php
$filename = "speaking.md";
$handle = @fopen($filename, "r");

if ($handle) {

	$text = fread($handle, filesize($filename));
	fclose($handle);
	
	echo format($text, false);

} else {

	echo format("<h2>Oh dear.</h2><p>Something went wrong with this page.</p>");

}

// <figure class="inline"><img class="u-photo" src="/images/Richard-Rutter-600x900.jpg" alt="" /></figure>      http://frontend.is/p/clagnut
?>

</div>
</section>

<?php
include_once($dr . "writing_footer.inc.php");
?>
