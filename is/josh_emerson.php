<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');
$person_slug = "josh_emerson";
$person = $data['people'][$person_slug];
$page = pagination($data['people'], $person_slug);
$case_studies = getCaseStudiesForPerson( $person_slug, $data );

$title= $person['name'] . " | Clearleft &middot; Who we are";
include($dr . "head.inc.php");
?>

<body class="section-is">
<?php include($dr . "header.inc.php"); ?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/is/">Who we are</a> / <?php echo $person['name']; ?></p>
    <ul class="pagination">
        <li><a rel="prev" href="/is/<?php echo $page['prevHref'] ?>" title="<?php echo $page['prevTitle'] ?>"><?php echo $page['prevTitle'] ?></a></li>
        <li><a rel="next" href="/is/<?php echo $page['nextHref'] ?>" title="<?php echo $page['nextTitle'] ?>"><?php echo $page['nextTitle'] ?></a></li>
    </ul>
</nav>

<h1><?php echo $person['name']; ?>, <?php echo $person['role']; ?></h1>


<aside>
<div class="figures">
<figure><img src="/i/is/<?php echo $person_slug; ?>.jpg" alt="<?php echo $person['name']; ?>" />
</div>


<h3>Elsewhere on the web</h3>
<ul class="elsewhere">
<li><a href="http://http://joshemerson.co.uk/" class="website" rel="me">Josh&#8217;s personal site</a></li>
<li><a href="http://twitter.com/joshje" class="twitter" rel="me">@joshje</a></li>
<li><a href="http://dribbble.com/joshje" class="dribbble" rel="me">Dribbble</a></li>
<li><a href="http://lanyrd.com/joshje" class="lanyrd" rel="me">Lanyrd</a></li>
<li><a href="http://github.com/joshje" class="github" rel="me">Github</a></li>
</ul>
</aside>

<p class="leader">Josh started down the road to professional web design in 1996. He was 10 years old, and hasn&#8217;t looked back since.</p>

<p>Before joining Clearleft, Josh operated as a freelance web designer working on every part of the website, from conception, through design, development and usability testing.</p>

<p>At Clearleft, Josh works collaboratively with visual and UX designers to transition a design into CSS, HTML and JavaScript. Josh&#8217;s hallmark is highly maintainable code adhering to the principles of progressive enhancement. This results in sites that take advantage of modern features (HTML5, etc) without giving a poor experience in older browsers. Josh works closely with backend developers, helping them take our modular patterns of code and implement them into their environments.</p>

<p>At Clearleft, Josh has on the front-end development and responsive design for clients including the Wellcome Trust,  Nuts.com and Shopify. Josh is also responsible for the technical support and feature development of <a href="http://fontdeck.com">Fontdeck</a>, our web font service.</p>

<p>Josh is currently building a responsive design for a leading British university.</p>

<h3>A developer with UX sensibilities</h3>

<p>Josh is a great problem solver and loves the challenge of creating great cross platform experiences. He cares deeply about the user experience and always aims to meet the goals set by our UX designers.</p>
<p>Josh is a regular contributor to Async and is heavily involved in <a href="http://codeclub.org.uk/">Code Club</a>, inspiring kids to learn to code after school.</p>

<h3>Away from the office</h3>

<p>Even away from work, Josh creates small web apps to solve problems, such as <a href="http://invitd.to">invitd.to</a>, which sends event invitations out via Twitter. He also loves cinema, particularly unconventional films which challenge preconceptions.</p>


<div class="things n3">


<?php /* 
<div class="group">
<h3>Latest articles</h3>
</div> <!-- /group -->
 */ ?>

<?php include("lanyrd.inc.php"); ?>


<?php /* 
<div class="group">
<h3>Published books</h3>
</div> <!-- /group -->
 */ ?>

</div> <!-- /things -->


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
