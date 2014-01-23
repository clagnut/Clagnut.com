<?php
if (preg_match("/Clagnut.com\/includes/i", $dr)) {
	$dr2 = str_replace("/Clagnut.com/includes", "/includes_clagnut", $dr);
} else {
	$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
}
?>