<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

$title = "A new year, a new design";
$meta_description = "";
$meta_keywords = "";

include_once($dr . "writing_header.inc.php");

?>
<section>

<p>To my surprise, Clagnut.com was last redesigned in <a href="/blog/2183/">September 2008</a> - that's getting on for 6 years ago. Well, that's all changed now, as will be evident to you, unless you’re viewing this in a <abbr title="Really Simple Sydication" class="smcp">RSS</abbr> reader (remember those?).</p>

<p>I'm still pleased with the 2008 design - I think it held up reasonably well - but it was fixed-width, designed with the grid first, and starting to feel a bit 'small'. I felt the site needed a new design, created from the typography outwards, responsive from the beginning and elegant on huge as well as tiny screens. That and I really want to write more, so I felt - in true procrastination style - that I needed a new design with a lovely reading experience to encourage that writing to happen.</p>
                
<figure class="inline"><a href="http://www.amazon.co.uk/dp/389955468X?tag=jalfrezi-21"><img src="/images/designingnews_180.png" alt="Book cover showing similar colours and typographic treatment" /></a>
<figcaption>Front cover of Designing News</figcaption></figure>

<h3>Inspiration</h3>

<p>After a few false starts to the redesign, I came across a fabulous book, <a href="http://www.amazon.co.uk/dp/389955468X?tag=jalfrezi-21"><cite>Designing News</cite></a> by <a href="http://www.FrancescoFranchi.com">Francesco Franchi</a> and was hooked. It's not hard to see that I ended up unashamedly using the book's front cover as a basis for my graphic design. I hope Francesco can forgive me for butchering his fine work and adapting it for my own purposes.</p>

<h3>Typography</h3>

<p>Where my design is different to Franchi's is in the choice of type. In all of those false starts, I had been trying to combine a high contrast serif font, set large for headings, with a sensibly sized contemporary sans for the body text. More and more I found myself drawn to the same two typefaces.  <a href="http://typejockeys.com/">Michael Hochleitner</a>'s <a href="http://fontdeck.com/typeface/ingeborg/">Ingeborg</a> for the headings, and <a href="http://fontdeck.com/typeface/akagi/">Akagi</a> by <a href="http://positype.com/">Neil Summerour</a> for the body text.</p>

<p>To my eyes, Akagi and Ingeborg have common typographic ancestry. They both have a vertical stress with a sturdy, rational approach tempered by a certain glamour - the very definition of substance and style. The two typefaces have similar flourishes such as the eye to the lower case g, and matching letterforms such as the lowercase a and y. The low-contrast Akagi Medium works extremely well on screens, and juxtaposes really well with the high contrast, almost fat-face Ingeborg Heavy. It works for me. As you might expect, both fonts are served up by <a href="http://fontdeck.com/">Fontdeck</a>.</p>

<figure><img src="/images/ingeborg-akagi.png" alt="Comparison of the two fonts" style="opacity:0.9" />
<figcaption>Ingeborg Heavy / Akagi Medium</figcaption></figure>
                
 <h3>Responsiveness</h3>               

<figure class="inline"><img src="/images/responsive-design-view.png" alt="Firefox Responsive Design View" title="Firefox Responsive Design View" /><figcaption>Responsive Design View</figcaption></figure>

<p> I've used responsive design techniques to help the site be nicely readable on lots of devices. At the time of writing, there are nine break points, including height as well as width. All the media queries are set in <code>em</code> rather than <code>px</code> as the break points are designed around where the design _breaks_ rather than an arbitrary screen size. The <a href="https://developer.mozilla.org/en-US/docs/Tools/Responsive_Design_View">Firefox Responsive Design View</a> proved invaluable before an actual device testing on the <a href="http://clearleft.com/testlab/">Clearleft test lab</a> was involved.</p>
<p>I've put together a kind of <a href="/styles">style guide</a>, mostly as a check that all likely mark-up is styled appropriately. While the site has not been widely tested, it should be fine on all modern browsers. Please <a href="/about#contact">let me know</a> if you come across any problems. You can also read more production details in the <a href="/colophon/">colophon</a>.</p>
 
<h3>Home Page</h3>

<p>The home page is now slightly more dashboard-like, in that I wanted to include a lot of 'live' content from my presence elsewhere on the web. So interspersed among the blog posts are photos from Flickr, tweets, music scrobbled via Last.fm, extracts from Kennedy app, and my current Jam.</p>

<h3>Blog Post Pages</h3>
<p>The reading experience of the blog posts should be better now, and they can now handle much larger images and tables. I'm using machine tags to pull in photos from Flickr where relevant. The related posts should soon become more relevant too. I'm planning on introducing a calendar view to the archive, but for you'll have to make do with paging through months and categories.</p>
 
<h4>What No Comments?</h4>
    <p>The site is built on my homemade <abbr class="smcp">CMS</abbr> written in <abbr class="smcp">PHP</abbr> and <span class="smcp">M</span>y<span class="smcp">SQL</span>. Unfortunately, since <a href="/blog/1745/">the great database disappearance</a> comments have been turned off. I might reinstate them at some point in the future, but for now you can <a href="/about#contact">contact me</a> by other methods. The whole site is now hosted by <a href="http://my.vidahost.com/aff.php?aff=1321">Vidahost</a> who have a simpler and more reliable database backup system than Joyent clearly did.</p>
               
                
</section>
<?php
include_once($dr . "writing_footer.inc.php");
?>
