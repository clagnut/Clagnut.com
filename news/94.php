<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);

$title= "UX London | Clearleft &middot; News";
include($dr . "head.inc.php");
?>

<body class="section-does">
<?php include($dr . "header.inc.php");?>

<div id="main">
<nav>
    <p class="breadcrumb"><a href="/news/">What we&#8217;ve been up to recently</a></p>
    <ul class="pagination">
        <li><a rel="prev" href="/news/92" title="dConstruct 2012">dConstruct 2012</a></li>
        <li><a rel="next" href="/news/94" title="Ampersand 2012 sold out!">Ampersand 2012 sold out!</a></li>
    </ul>
</nav>

<h1>Ampersand 2012 sold out!</h1>

<p>We're thrilled to say that this year's Ampersand conference has now sold out!  We're looking forward to welcoming everyone to Brighton next month for our second year of type-enthused festivities.  If you've nabbed a ticket you can check out the full schedule on the rather lovely <a href="http://2012.ampersandconf.com/">Ampersand site</a>.  And if you haven't snagged a place, we do have a <a href="http://ampersand2012.eventbrite.com/?ebtv=C">waiting list</a> you can join (and keep your fingers crossed!).</p>


</div> <!-- /#main -->

<?php include($dr . "footer.inc.php"); ?>
</body>
</html>
