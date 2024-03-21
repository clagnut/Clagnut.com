<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

$title = "Speaking";
$meta_title = "Richard Rutter - Speaking";
$meta_description = "";
$meta_keywords = "";

include_once($dr . "writing_header.inc.php");

?>


<section class="h-card stack center vcard">

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

</section>

<?php
include_once($dr . "writing_footer.inc.php");
?>
