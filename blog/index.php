<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
$title = "Seventy Penguins";
$title = "Typographic Style Applied to the&nbsp;Web";
$old = "";
include($dr . "head.inc.php");
?>

<body>
<?php 
include($dr . "header.inc.php");
?>

<main>

<article class="post">

<header>

<h1><?php echo $title ?></h1>

<div class="meta">
<p class="published"><time datetime="2005-06-07T02:22:59+01:00">7th June 2005</time></p>
<p class="categories">§&nbsp;<a href="/archive/typography/" title="View all posts relating to Typography.">Typography</a></p>

<nav>
<a href="#" rel="prev" title="Previous">&lsaquo;</a><a href="#" rel="next" title="Next">&rsaquo;</a>
</nav>
</div>
</header>

<section>

<p>In Designing News, award-winning editorial and infographics designer Francesco Franchi conveys his vision for the future of the news and media industries. He evaluates the fundamental changes that are taking place in our digital age in terms of consumer expectations and the way media is being used. The book then outlines the challenges that result and proposes strategies for traditional publishing houses, broadcasting companies, journalists, and designers to address them.</p>
<p>A pleasing number of people have been clamouring for this: the track listing to my annual compilation, ‘The Best Songs I Bought In 2006 Ever’. It was another good year – remember this is compiled from music I bought this year, but was not necessarily released this year.</p>
<p>These tracks just about squeeze on to a CD, so if you’d like a copy, put together your own compilation of the year and send it to me – you’ll get a copy of the above in return. Email me for details. Update: I stuck these in an iMix for your iTunes delectation.</p>
<p>I’ve just come back from a week with Her Indoors in the West Country; a few days in Devon and a few more in Cornwall (there are photos – it’s a beautiful part of the world). While there I bought five books, all of which were Penguin paperbacks.</p>
<p>A pleasing number of people have been clamouring for this: the track listing to my annual compilation, ‘The Best Songs I Bought In 2006 Ever’. It was another good year – remember this is compiled from music I bought this year, but was not necessarily released this year.</p>

</section>

<aside class="gallery">
	<div class="aside-container">
		<figure class="photo"><a href="http://flickr.com/photos/clagnut/17802430/"><img src="/i/flickr/m/1.jpg" alt="Crabbing"><figcaption>Crabbing</figcaption></a></figure>
		<figure class="photo"><a href="http://flickr.com/photos/clagnut/17802565/"><img src="/i/flickr/m/2.jpg" alt="Passenger ferry"><figcaption>Passenger ferry pulling out</figcaption></a></figure>
		<figure class="photo"><a href="http://flickr.com/photos/clagnut/17801254/"><img src="/i/flickr/m/3.jpg" alt="Herring gull"><figcaption>Herring gull</figcaption></a></figure>
		<figure class="photo"><a href="http://flickr.com/photos/clagnut/17800540/"><img src="/i/flickr/m/4.jpg" alt="70 Pocket Penguins"><figcaption>70 Pocket Penguins</figcaption></a></figure>
		
	</div>
</aside>

<aside class="relatedposts">
<h2><span>Possibly Related</span></h2>
<div class="aside-container">

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

</div>
</aside>


<aside class="data">
	<div class="tags">
		<h3>#</h3>
		<ul>
		<li><a href="http://clagnut.com/search/?q=Typography" rel="tag">Typography</a></li>
		<li><a href="http://clagnut.com/search/?q=penguin" rel="tag">penguin</a></li>
		<li><a href="http://clagnut.com/search/?q=book+design" rel="tag">book design</a></li>
		<li><a href="http://clagnut.com/search/?q=cornwall" rel="tag">cornwall</a></li>
		<li><a href="http://clagnut.com/search/?q=devon" rel="tag">devon</a></li>
		<li><a href="http://clagnut.com/search/?q=isbntagged" rel="tag">isbntagged</a></li>
		<li><a href="http://clagnut.com/search/?q=geotagged" rel="tag">geotagged</a></li>
		<li><a href="http://clagnut.com/search/?q=Agatha+Christie" rel="tag">Agatha Christie</a></li>
		<li><a href="http://clagnut.com/search/?q=Phil+Baines" rel="tag">Phil Baines</a></li>
		</ul>	
		<?php /*	
		<div id="machine_tags">
			<h4><a href="#machine_tags" class="arrow">►</a> Machine tags</h4>
			
			<ul>
			<li><a href="http://clagnut.com/search?q=clagnut%3Apost%3D1484" rel="tag">clagnut:post=1484</a></li>
			<li><a href="http://clagnut.com/search?q=geo%3Alat%3D50.382" rel="tag">geo:lat=50.382</a></li>
			<li><a href="http://clagnut.com/search?q=geo%3Alon%3D-3.5879" rel="tag">geo:lon=-3.5879</a></li>
			</ul>
		</div>
		*/ ?>
	</div>
</aside>

</article>


</main>

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
