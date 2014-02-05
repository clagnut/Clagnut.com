<?php
$mode = (isset($_REQUEST["mode"]))?$_REQUEST["mode"]:""; 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Fontdeck webfont loader example</title>
<?php
$referer = $_SERVER["HTTP_REFERER"];
$hostname = $_SERVER["HTTP_HOST"];
echo '<noscript><link rel="stylesheet" href="http://f.fontdeck.com/s/css/JuoZOxI4hHmn7bWg1uU4xQvHRMQ/'.$hostname.'/23766.css" type="text/css" /></noscript>';
?>


<link rel="stylesheet" href="common.css" />
<?php
if ($mode == "simple") {
    echo '<link rel="stylesheet" href="simple.css" />';
}
if ($mode == "firefox") {
    echo '<link rel="stylesheet" href="firefox.css" />';
}
if ($mode == "safari") {
    echo '<link rel="stylesheet" href="safari.css" />';
}
if ($mode == "fade") {
    echo '<link rel="stylesheet" href="fade.css" />';
}
?>
</head>

<body>
<a id="back" href="<?php echo $referer ?>">&larr; back to post</a>
<div id="wrapper">
<h1>Pangolins</h1>
<p>A pangolin, also known as scaly anteater, is a mammal of the order Pholidota. There are eight species. Pangolins have large keratin scales covering their skin and are the only mammals with this adaptation.</p>

<p>Pangolins are nocturnal animals, and use their well-developed sense of smell to find insects. The long-tailed pangolin is also active by day. Pangolins spend most of the daytime sleeping, curled up into a ball.</p>

<small id="footer">
<img src="pangolin.jpg" alt="A pangolin" id="pangolin" />
Text lifted from Wikipedia, image licensed from iStockPhoto
</small>

</div>


<script type="text/javascript">
WebFontConfig = {
  fontdeck: {
    id: '23766'
  }
};

(function() {
  var wf = document.createElement('script');
  wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();
</script>

</body>
</html>
