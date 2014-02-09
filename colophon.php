<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

$title = "Colophon";
$meta_description = "";
$meta_keywords = "";

include_once($dr . "writing_header.inc.php");

?>

<section>


<figure class="inline"><a href="http://www.amazon.co.uk/dp/389955468X?tag=jalfrezi-21"><img src="/images/designingnews_180.png" alt="Book cover showing similar colours and typographic treatment" /></a>
<figcaption>Front cover of Designing News</figcaption></figure>

<p><span class="opener">The visual design of this website</span> is unashamedly based on the front cover of a fabulous book, <a href="http://www.amazon.co.uk/dp/389955468X?tag=jalfrezi-21"><cite>Designing News</cite></a> by <a href="http://www.FrancescoFranchi.com">Francesco Franchi</a>, as published in hard back September 2013. I hope Francesco can forgive me for butchering his design and adapting it for my own purposes.</p>

<p>The type is set in <a href="http://fontdeck.com/typeface/akagi/">Akagi</a> designed by <a href="http://positype.com/">Neil Summerour</a>, with headlines set in <a href="http://typejockeys.com/">Michael Hochleitner</a>'s <a href="http://fontdeck.com/typeface/ingeborg/">Ingeborg</a>. Both fonts are served up by <a href="http://fontdeck.com/">Fontdeck</a>.

<p>The site is built on a homemade <abbr class="smcp">CMS</abbr> written in <abbr class="smcp">PHP</abbr> and <span class="smcp">M</span>y<span class="smcp">SQL</span>. It was hand-coded in <a href="https://macrabbit.com/espresso/">Espresso</a>, marked up using semantic <abbr class="smcp">HTML&nbsp;5</abbr> and <abbr class="smcp">CSS&nbsp;3</abbr> along with a smattering of jQuery.</p>
<p> I've used responsive design techniques to hopefully ensure the site is nicely readable on lots of devices. I've put together a kind of <a href="/styles">style guide</a>, mostly as a check that all likely mark-up is styled appropriately. While the site has not been widely tested, it should be fine on all modern browsers. Please <a href="/about#contact">let me know</a> if you come across any problems. </p>
                
<p>Site analytics are tracked using <a href="http://haveamint.com/">Mint</a> by Shaun Inman. I use and recommend <a href="http://my.vidahost.com/aff.php?aff=1321">Vidahost</a> for web hosting. They've proved very fast and helpful thus far.</p>


</section>

<?php
include_once($dr . "writing_footer.inc.php");
?>
