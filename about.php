<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

$title = "About";
$meta_description = "";
$meta_keywords = "";

include_once($dr . "writing_header.inc.php");

?>

<section>

<p>Richard Rutter. I&#8217;m a user experience designer and web typography evangelist living in Brighton, UK.</p>

</section>

<?php
include_once($dr . "writing_footer.inc.php");
?>
