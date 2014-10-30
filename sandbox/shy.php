<html>
<head>
<meta charset="utf-8">
<style>
@font-face {
  font-family: 'Apercu Light';
  src: url('/fonts/apercu_light.woff') format('woff');
  font-style:   normal;
  font-weight: 200;
}
@font-face {
  font-family: 'Apercu Medium';
  src: url('/fonts/apercu_medium.woff') format('woff');
  font-style:   normal;
  font-weight: 500;
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
	font-family: "Apercu Light", sans-serif; font-weight:200;
}
p.two {
	font-family: "Apercu Medium", sans-serif; font-weight:500;
}
p.three {
	font-family: Helvetica, sans-serif; font-weight:200;
}
p.four {
	font-family: "Apercu Light", Helvetica, sans-serif; font-weight:200;
}
p.five {
	font-family: "Apercu Light", Helvetica, Arial, sans-serif; font-weight:200;
}
p.six {
	font-family: "Apercu Light", Arial, sans-serif; font-weight:200;
}

</style>
</head>
<body>
<p style="font-size:1rem">&larr; <a href="/blog/2377/">Back to blog post</a></p>
<h1>Test page to demonstrate soft hyphen entity (&amp;shy;) errors with web fonts on <strong>Mac Webkit</strong> browsers</h1>


<h2>1. Web font <code>font-family: "Apercu Light", sans-serif; font-weight:200</code></h2>

<p class="one">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>

<h2>2. Web font <code>font-family: "Apercu Medium", sans-serif; font-weight:500</code></h2>

<p class="two">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>

<h2>3. Installed font, <code>font-family: Helvetica, sans-serif; font-weight:200</code></h2>

<p class="three">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>

<h2>4. Installed font, <code>font-family: "Apercu Light", Helvetica, sans-serif; font-weight:200</code></h2>

<p class="four">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>

<h2>5. Installed font, <code>font-family: "Apercu Light", Helvetica, Arial, sans-serif; font-weight:200</code></h2>

<p class="five">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>

<h2>6. Installed font, <code>font-family: "Apercu Light", Arial, sans-serif; font-weight:200</code></h2>

<p class="six">There is a soft hyphen entity in this word: hippo&shy;potamus.</p>
</body>
</html>
