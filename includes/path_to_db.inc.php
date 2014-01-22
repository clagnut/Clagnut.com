<?php
if (preg_match("/clearleft.com\/repo\/clagnut/i", $dr)) {
	$dr2 = str_replace("repo/clagnut", "includes_clagnut", $dr);
} else {
	$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
}
?>