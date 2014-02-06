<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

$title = "Colophon";
$meta_description = "";
$meta_keywords = "";

include_once($dr . "writing_header.inc.php");

?>

<section>

<p><a href="/styles">Styles</a></p>

<p>This website is produced on an Apple <a href="http://apple.com/imac/">iMac</a>, using <a href="http://www.omnigroup.com/products/omnigraffle/">OmniGraffle</a> and <a href="http://adobe.com/products/fireworks/">Fireworks</a> to realise early design concepts before being marked up as <abbr title="HyperText Markup Language">HTML</abbr> in <a href="http://macromates.com/">TextMate</a>. I use and recommend <a href="http://webfaction.com/">WebFaction</a> for web hosting. Type set in <a href="http://blogs.adobe.com/typblography/2012/08/source-sans-pro.html">Source Sans Pro</a> and served via <a href="http://edgefonts.com/">Adobe Edge Fonts</a>.</p>
                   
                   <p>This site is published using <a href="http://movabletype.com/">Movable Type Pro 5</a> and a number of supporting plugins:</p>
                   
                   <ul>
                   <li><a href="http://daringfireball.net/projects/markdown/">Markdown</a> and <a href="http://daringfireball.net/projects/smartypants/">SmartyPants</a> by John Gruber</li>
                   <li><a href="http://www.lowest-common-denominator.com/2006/08/widont_for_movable_type.php">Widont</a> by Brook Elgie</li>
                   <li><a href="http://mt-hacks.com/flickrphotos.html">FlickrPhotos</a> by Marc Carey</li>
                   <li><a href="http://code.google.com/p/ogawa/wiki/TagSupplementals">TagSupplementals</a> by Hirotaka Ogawa</li>
                   <li><a href="http://bradchoate.com/weblog/2002/07/27/mtregex">Regex</a> by Brad Choate</li>
                   <li><a href="http://en.gravatar.com/site/implement/images/movabletype/">Gravatar</a> by Automattic</li>
                   <li><a href="http://code.google.com/p/ogawa/wiki/ModifiedDate_Plugin">ModifiedDate</a> by Hirotaka Ogawa</li>
                   </ul>
                   
                   <p>Additional enhancements:</p>
                   
                   <ul>
                   <li><a href="http://mapbox.com/">MapBox</a> interactive maps</li>
                   <li><a href="http://code.google.com/p/oembed-php/">oembed-php</a> to display linked photos and videos inline via oEmbed</li>
                   <li><a href="http://flex.madebymufffin.com/">FlexSlider</a> by Tyler Smith</li>
                   <li><a href="http://lesscss.org/">LESS</a> styles compiled with <a href="http://leafo.net/lessphp/">lessphp</a></li>
                   </ul>
                   
                   <p>I&#8217;ve referenced or been inspired by the following articles:</p>
                   
                   <ul>
                   <li><cite><a href="http://coding.smashingmagazine.com/2012/01/16/resolution-independence-with-svg/">Resolution Independence With SVG</a></cite> by David Bushell</li>
                   <li><cite><a href="http://24ways.org/2006/compose-to-a-vertical-rhythm">Compose to a Vertical Rhythm</a></cite> and <cite><a href="http://www.webtypography.net/">Web Typography</a></cite> by Richard Rutter</li>
                   <li><cite><a href="http://adactio.com/journal/1274/">Ghost in the Machine Tags</a></cite> by Jeremy Keith</li>
                   <li><cite><a href="http://www.alistapart.com/articles/responsive-web-design/">Responsive Web Design</a></cite> by Ethan Marcotte</li>
                   <li><cite><a href="http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/">Creating Intrinsic Ratios for Video</a></cite> by Thierry Koblentz</li>
                   </ul>
                   
                   <p>I always try to adhere to <a href="http://webstandards.org/">web standards</a> and best practices. Therefore, pages are semantically structured using valid <a href="http://www.w3.org/TR/html5/"><abbr>HTML5</abbr></a> with presentational design provided by <a href="http://www.w3.org/Style/CSS/"><abbr title="Cascading Style Sheets">CSS</abbr></a>. Syndicated feeds are available using <a href="http://www.atomenabled.org/">Atom</a>-flavoured <abbr title="Really Simple Syndication">RSS</abbr>.</p>
                   
                   <p>Site analytics are tracked using <a href="http://haveamint.com/">Mint</a> by Shaun Inman.</p>


</section>
<section>

<h1>New &amp; Improved</h1>
                          <p>Unless you’re viewing this in your <abbr title="Really Simple Sydication">RSS</abbr> reader, you may have noticed a few changes to the site. It’s been more than two years since the last redesign, but I’ve been working on this update on-and-off for the last 12 months. I could probably continue tweaking and refining, but as a wise man once said, ‘real artists ship’.</p>
                
                <h2>So What’s New?</h2>
                
                <p>As I stated in the <a href="/2010/12/design_principles/">design principles</a>, this redesign has been focused on content. Through constant iteration, I continually questioned which features deserved to be on each page, and typically the answer was to remove rather than add.</p>
                
                <p>I’ve also spent some considerable time refining the typography. I’m still finding it difficult to move away from a Helvetica based design, but Jeremy Tankard’s <a href="http://fontdeck.com/typeface/bliss/">Bliss</a> and Type Together’s <a href="http://fontdeck.com/typeface/skolar/">Skolar</a> typefaces do a handsome job of breaking my addiction.</p>
                
                <p>Given this effort, I decided to revisit previous journal entries and articles, correctly marking up abbreviations and cited works, and updating images with larger, higher quality versions. I’ve finally got round to adding photos to <a href="http://paulrobertlloyd.com/2011/03/brasilia_palace_hotel/">my review of the Brasilia Palace Hotel</a>, and that’s probably a good place to start sampling the improvements.</p>
                
                <h3>Related content</h3>
                
                <p>Not wanting to burden readers with periphery content, entry pages feature extra content hidden away behind a few additional links. Discussions are be found on separate pages, an idea that I played with earlier in the design process and actually implemented on the previous site. This allows me to retain ‘ownership’ of my posts whilst still accepting commentary where it may be of benefit.</p>
                
                <p>Some posts also show related photos I’ve <a href="http://adactio.com/journal/1274/">machine tagged</a> on Flickr and all provide a selection of five related entries, again matched by tag. Judicious use of the <a href="http://diveintohtml5.org/history.html"><abbr title="HyperText Markup Language">HTML5</abbr> History <abbr title="Application Programming Interface">API</abbr></a> allows these pages to load in place on the same page.</p>
                
                <h3>Journal Links</h3>
                
                <p>The Journal gets <a href="/journal/">its own page</a> and takes a tumblelog approach which I’ve become fond of. Now I can incorporate videos and photos, highlight key quotes or recommend articles that find interesting. I’ve seen this done on many of the sites I read, and it’s something I’ve wanted to try for a while. What may work for others may not work for me, so I’m interested to see how I end up using this new functionality.</p>
                
                <h3>Portfolio</h3>
                
                <p>FourTwo, my somewhat neglected (and <a href="http://v1.fourtwo.net/">now archived</a>) freelance site redirects to the new <a href="/portfolio/">Portfolio</a> section. Here you can see the fruits of my brief freelance existence – as well as the work I’ve been doing at Clearleft – all in one place.</p>
                
                <h3>Archive</h3>
                
                <p>Archives have also been refreshed, with a <a href="/portfolio/">calendar based overview page</a>, and <a href="/2011/02/">monthly pages</a> that draw related content together on a single page.</p>
                
                <h3>Design</h3>
                
                <p>Much to my own disappointment, I’ve never been one for sketching, and often dive straight into Fireworks instead. Recently I’ve started to step back a little and started using tools like OmniGraffle. This lets me focus on hierarchy and layout without getting drawn into the details. </p>
                
                <p>Fireworks was employed later in the process when I wanted to play with different visual approaches, yet often in tandem with the browser and real content. I’ve not got a lot to say about the design, largely because I’m already bored of it and want to start over.</p>
                
                <h2>Technical Considerations</h2>
                
                <p>One of the main reasons behind this redesign was to experiment with new techniques and approaches. Being able to think through the complexities of a Responsive Design in my own time was immensely valuable, as was the iterative testing of the design on different devices. Granted, these were typically manufactured by Apple, so more testing is certainly required.</p>
                
                <p>Thanks to the discussion and experimentation happening around <a href="http://www.alistapart.com/articles/responsive-web-design/">Responsive Design</a> at Clearleft, I’ve adopted a responsive image technique initially developed by <a href="http://filamentgroup.com/lab/responsive_images_experimenting_with_context_aware_image_sizing/">Scott Jehl</a> and <a href="http://blog.andyhume.net/content-aware-responsive-images/">built upon by Andy Hume</a>. What I like to label experimental, you may want to call buggy; I’ve noticed images not loading and both image sizes getting downloaded on larger screens. Embrace the experimentation!</p>
                
                <p>The site is marked up using <abbr>HTML5</abbr> with particular attention (and much head scratching) lavished on the outline of each page. I’ve spent a lot of time thinking about performance too, helped greatly by the techniques documented in the <a href="http://html5boilerplate.com/"><abbr>HTML5</abbr> Boilerplate</a> which I’ve referenced rather than use wholesale. No need to <a href="https://github.com/h5bp/html5-boilerplate/issues/610">fear pink text selection</a> here. </p>
                
                <p>Maps use the <a href="http://leaflet.cloudmade.com/">Leaflet JavaScript library</a> which provides a far more enjoyable mobile browsing experience than the iFrame embedded Google Maps I was using previously. It also means I can now use Open Street Map data. <a href="/2009/05/a_european_adventure/">This post about my trip around Europe</a> is a good place to see these new maps in action.</p>
                
                <p>The <a href="/feeds/combined/"><abbr>RSS</abbr> feed</a> has been updated to show all new content posted to the site (entries, links and portfolio projects) but you can <a href="/feeds/">subscribe to individual sections</a> if you wish.</p>
                
                <h3>Movable Type</h3>
                
                <p>I’m unashamed in my continued use of <a href="http://movabletype.org/">Movable Type</a>, and the <a href="http://www.movabletype.org/2011/05/movable_type_51_and_505_436_security_update.html">latest release</a> by the team in Japan has improved upon an already great platform. That’s not to say I haven’t got my gripes, especially since I’ve adopted the Websites/Blogs model available in Movable Type 5. Simple things like creating an archive page that aggregates content across all blogs is difficult, if not impossible to accomplish. I also tried using the built-in asset management features (which would allow me to upload images and automatically generate thumbnails) but this appeared buggy and incomplete. It’s a solid platform, but there is still much room for improvement.</p>
                
                <h2>Just the Start</h2>
                
                <p>In many respects my focus on the content and typography means these do much of the heavy lifting, and I’m conscious that the design lacks much colour, texture or detailed refinement. Yet this is more of a foundational design upon which I can layer on new features and polish over time. The design will continue to evolve, and the bugs will be ironed out. Eventually.</p>
</section>

<?php
include_once($dr . "writing_footer.inc.php");
?>
