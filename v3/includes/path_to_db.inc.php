<?php
if (preg_match("/public_html\/includes/i", $dr)) {
	$dr2 = str_replace("/public_html/includes", "/includes_clagnut", $dr);
} else {
	$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
}
?>
