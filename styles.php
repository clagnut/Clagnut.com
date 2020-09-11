<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

$title = "Styles";
$meta_title = "Styles";
$meta_description = "";
$meta_keywords = "";

include_once($dr . "writing_header.inc.php");

?>

<section>
<div class="prose">

<?php
$filename = "styles.md";
$handle = @fopen($filename, "r");

if ($handle) {

	$text = fread($handle, filesize($filename));
	fclose($handle);
	
	echo format($text, false);

} else {

	echo format("<h2>Oh dear.</h2><p>Something went wrong with this page.</p>");

}

?>

</div>
</section>

<?php
include_once($dr . "writing_footer.inc.php");
?>
