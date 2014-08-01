<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="//f.fontdeck.com/s/css/SBI46NAg9BlWkTiI/sCIjxlUX5w/<?php echo $_SERVER['SERVER_NAME']; ?>/21000.css" type="text/css" />
<style>
@font-face {
  font-family: 'Museo Sans 200';
  src: url('/fonts/MuseoSans_200.woff') format('woff');       
  font-style:   normal;
  font-weight: 200;
}
body {
	font-family: sans-serif;
}
h1 {
	font-weight: 200;
	max-width: 25em;
}
h1 strong {
	font-weight: 400;
}
h2 {
	font-weight: 400;
	margin-top: 4em;
	font-size: 18px;
	color: navy;
}
code {
	font-family: "andale mono", monospace;
}
p {
	font-size: 24px;
	font-style:normal;
}
p.one {
	font-family: "Akagi Light", sans-serif; font-weight:200; 
}
p.two {
	font-family: "Museo Sans 200", verdana, sans-serif; font-weight:200; 
}
p.three {
	font-family: Helvetica, sans-serif; font-weight:200;
}

</style>
</head>
<h1>Test page to demonstrate soft hyphen entity (&amp;shy;) errors with web fonts on <strong>Mac Webkit</strong> browsers</h1>


<h2>1. Fontdeck webfont, <code>font-family: "Akagi Medium", sans-serif</code></h2>

<p class="one">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>

<h2>2. Local webfont, <code>font-family: "Museo Sans 500", sans-serif</code></h2>

<p class="two">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>

<h2>3. Installed font, <code>font-family: "Lucida Grande", sans-serif</code></h2>

<p class="three">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>
</html>