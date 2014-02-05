<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Using CSS 3 font-feature-settings to access OpenType features in a web font</title>
<link rel="stylesheet" href="http://f.fontdeck.com/s/css/rjHbj6R/6STQZhTRE/f+V0VKoutA4We3IYg/<?php echo $_SERVER['SERVER_NAME']; ?>/15087.css" type="text/css" />
<script>
function supports(property) {
    var div = document.createElement('div'),
        vendors = ['Webkit', 'Moz', 'O', 'ms', 'Khtml'],
        propertyName = property.toLowerCase();
        len = vendors.length;
    if (property in div.style) return true;
    var property = property.replace(/^[a-z]/, function(val) {
        return val.toUpperCase();
    });
    while(len--) {  
       if ( vendors[len] + property in div.style ) return true;
    }
    return false;
}
document.documentElement.className += supports('fontFeatureSettings')? ' font-feature-settings' : '';
</script>
<style>
body {
    background:#fff;
    color:#000;
	font-size:48px;
    margin:0;
    font-family:"Magneta Book", Georgia, serif;
    font-size-adjust:0.48;
    font-weight:300;
    font-style:normal;
    line-height:1.08333333333333;
    -moz-font-feature-settings:"liga=1";
	-ms-font-feature-settings:"liga" 1;
	-o-font-feature-settings:"liga" 1;
	-webkit-font-feature-settings:"liga" 1;
	font-feature-settings:"liga" 1;
}
#content {
    width:17em;
    margin:0 auto;
}

h1, h2 {
    font-family:"Magneta Bold", Georgia, serif;
    font-size-adjust:0.48;
    font-weight:bold;
    font-style:normal;
}
h1 {
    margin:1em 0 0.5em 0;
    font-size:24px;
}

h2 {
    margin:2em 0 1em 0;
    font-size:18px;
}
p {
    margin:0.25em 0;
}
.opentype-off {
    -moz-font-feature-settings:"liga=0, dlig=0";
	-ms-font-feature-settings:"liga" 0, "dlig" 0;
	-o-font-feature-settings:"liga" 0, "dlig" 0;
	-webkit-font-feature-settings:"liga" 0, "dlig" 0;
	font-feature-settings:"liga" 0, "dlig" 0;
}
.opentype-on {
    -moz-font-feature-settings:"liga=1, dlig=1";
	-ms-font-feature-settings:"liga" 1, "dlig" 1;
	-o-font-feature-settings:"liga" 1, "dlig" 1;
	-webkit-font-feature-settings:"liga" 1, "dlig" 1;
	font-feature-settings:"liga" 1, "dlig" 1;
}
.one {
    text-transform: uppercase;
}

.two {
    margin-bottom:0.5em;
}

.caveat, .colophon {
    font-size:16px;
}

.caveat {
    background:red;
    color:#fff;
    padding:4px;
}

.font-feature-settings .caveat {
    display:none;
}

</style>
</head>
<body>

<div id="content">


<h1>Using CSS 3 to access OpenType features</h1>

<p class="colophon">(<a href="http://blog.fontdeck.com/post/15777165734/opentype-1">See the blog post</a>)</p>

<p class="caveat">OpenType features have only been supported since Firefox 4, Internet Explorer 10 and Chrome on Windows. Your browser may not support these properties.</p>

<h2>Common &amp; Discretionary Ligatures ON</h2>
<div class="opentype-on">
<p class="one">The Microscopic Electrons Contribute Polar Moments</p>
<p class="two">Lucky affluent actor on fjord asks to feast on giant cheese-filled quiche.</p>
</div>


<h2>Common &amp; Discretionary Ligatures OFF</h2>
<div class="opentype-off">
<p class="one">The Microscopic Electrons Contribute Polar Moments</p>
<p class="two">Lucky affluent actor on fjord asks to feast on giant cheese-filled quiche.</p>
</div>

<p class="colophon">Text set in <a href="http://fontdeck.com/typeface/magneta">Magneta</a> served by <a href="http://fontdeck.com/">Fontdeck</a>.</p>

</div>
</body>
</html>
