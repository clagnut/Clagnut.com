<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
$title = "";
$old = "";
include($dr . "head.inc.php");
?>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main class="home">

<header>

<h1>Richard Rutter</h1>

</header>

<article class="newestpost">
<p class="date"><time datetime="2005-06-07T02:22:59+01:00">7 June 2005</time></p>
<h1><a href="#">The postcode lookup pattern</a></h1>
<p>UK Museums on the Web is a one day conference organised by the Museums Computer Group. Representatives from museums and other organisations in the sector shared their experiences over the past year and beyond. These are my notes from the day today.</p>

<p class="more"><a href="#">Read on</a> &rarr;</p>
</article>


<article class="favephoto">
<figure class="photo"><a href="http://flickr.com/photos/clagnut/17802430/"><img src="/i/flickr/f/1.jpg" alt=""></a><figcaption>Sea flooding into Ohso Social</figcaption></figure>
</article>
	
	

<aside class="relatedposts group">
	<h2><span>Possibly Related</span></h2>
	
	<article>
	<p><time datetime="2005-06-07T02:22:59+01:00">7 June 2005</time></p>
	<h1><a href="#">Underworld typography</a></h1>
	<p><a href="/archive/typography/" title="View all posts relating to Typography.">Typography</a> · <a href="/archive/music/" title="View all posts relating to Music.">Music</a></p>
	</article>
	
	<article>
	<p><time datetime="2005-06-07T02:22:59+01:00">7 June 2005</time></p>
	<h1><a href="#">The postcode lookup pattern</a></h1>
	<p><a href="/archive/typography/" title="View all posts relating to Typography.">Information design</a> · <a href="/archive/music/" title="View all posts relating to Music.">Mapping &amp; Geospatial</a></p>
	</article>
	
	<article>
	<p><time datetime="2005-06-07T02:22:59+01:00">28 November 2006</time></p>
	<h1><a href="#">Professional body for web designers</a></h1>
	<p><a href="/archive/typography/" title="View all posts relating to Typography.">Web standards</a> · <a href="/archive/music/" title="View all posts relating to Music.">New media industry</a></p>
	</article>

</aside>

</main>

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
