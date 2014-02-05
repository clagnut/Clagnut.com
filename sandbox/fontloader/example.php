<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Fontdeck WebFont Loader example</title>
<?php
$hostname = $_SERVER["HTTP_HOST"];
echo "<link rel='stylesheet' href='http://f.fontdeck.com/s/css/L+Hmq2BI8Kmo1Yq4MdJFsHomObI/$hostname/2009.css' type='text/css' />";
?>
<script type="text/javascript">
		WebFontConfig = {
		  custom: { families: ['DIN 1451 Engschrift Standard', 'Franklin Gothic FS Book'],
			urls: [ 'http://f.fontdeck.com/s/css/L+Hmq2BI8Kmo1Yq4MdJFsHomObI/<?php echo $hostname ?>/2009.css' ] }
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
<style type="text/css">
body {
	background: #fff;
	color: #111;
	text-rendering: optimizeLegibility;
	margin: 0;
	padding: 0;
}

a#back {
	font-family: Georgia, serif;
	font-size: 12px;
	display: block;
	color: #fff;
	background: #999;
	padding: 1px 5px;
	text-decoration: none;
	margin-bottom: 50px;
}

#wrapper {
	width: 600px;
	margin: 0 auto;
}

h1 {
	font-family:"DIN 1451 Engschrift Standard", arial, sans-serif;
	font-size: 54px;
	font-weight:normal;
	padding-top: 0;
	margin-bottom: 0.778em;
	font-size-adjust: 0.479;
	text-transform: uppercase;
	line-height: 1em;
}
 
p { 
	font-family:"Franklin Gothic FS Book", arial, sans-serif; 
	font-size-adjust:0.5;
	font-size: 18px;
	line-height: 1.167em;
	margin-bottom: 1.167em;
}

#footer {
	font-family: Georgia, serif;
	font-size: 11px;
	text-align:right;
	display: block;
}

#pangolin {
	margin: 54px 0 0 0;
	width: 600px;
	height: 170px;
	display: block;
}



.wf-loading h1, .wf-loading p {
	visibility:hidden;
}
</style>
</head>
<body>

<a id="back" href="http://blog.fontdeck.com/post/1471135028/using-fontdeck-with-the-google-webfont-loader">&larr; back to post</a>

<div id="wrapper">

<h1>Pangolins</h1>
<p>A pangolin, also known as scaly anteater, is a mammal of the order Pholidota. There are eight species. Pangolins have large keratin scales covering their skin and are the only mammals with this adaptation.</p>

<p>Pangolins are nocturnal animals, and use their well-developed sense of smell to find insects. The long-tailed pangolin is also active by day. Pangolins spend most of the daytime sleeping, curled up into a ball.</p>

<small id="footer">
<img src="pangolin.jpg" alt="A pangolin" id="pangolin" />
Text lifted from Wikipedia, image licensed from iStockPhoto
</small>

</div>

</body>
</html>
