<?php
$http_host = $_SERVER["HTTP_HOST"];
$host = ($http_host=='clagnut.dev')?'clagnut.dev':'.clagnut.com';
setcookie ("web", "", time() - 3600, "/", $host, 0);
setcookie ("author", "", time() - 3600, "/", $host, 0);
setcookie ("email", "", time() - 3600, "/", $host, 0);
$host = ($http_host=='clagnut.dev')?'clagnut.dev':'www.clagnut.com';
setcookie ("web", "", time() - 3600, "/", $host, 0);
setcookie ("author", "", time() - 3600, "/", $host, 0);
setcookie ("email", "", time() - 3600, "/", $host, 0);
$referer = $_SERVER["HTTP_REFERER"];
header("Location: $referer");
?>