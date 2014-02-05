<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>VAG Rounded test</title>
<link rel="stylesheet" href="http://f.fontdeck.com/s/css/uH5+KWQnibDTJRYggGJ9XZLTAgw/clagnut.com/2187.css" type="text/css" />
<style type="text/css">
div { font-family:"VAG Rundschrift Regular", sans-serif; font-size-adjust:0.516; font-weight:normal; font-style:normal; margin-top:12px; line-height:1.1}
span {display:block; float:left; width:36px; text-align:right}
p {margin:0 0 0 48px;}
</style>
</head>
<body>
<?php
for ($i = 14; $i <= 36; $i++) {
	echo "
	<div style='font-size:".$i."px'><span>"
	. $i .
	"</span><p>abcdefghijklmnopqrstuvwyxz<br />
	ABCDEFGHIJKLMNOPQRSTUVWXYZ</p></div>";
}
?>
</body>
</html>
