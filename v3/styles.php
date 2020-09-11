<?php
$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
include_once($dr . "php_errors.inc.php");

$title = "Styles";
$meta_description = "";
$meta_keywords = "";

include_once($dr . "writing_header.inc.php");

?>

<section>

<p>This document is a guide to the mark-up styles used throughout the site. In particular it&#8217;s a check that all likely mark-up is styled appropriately.</p>

<h2 id="sections">Sections (a Level 2 Heading)</h2>

<p>The secondary header above is an <code>h2</code> element, which may be used for any form of important page-level header.</p>

<h3>Level 3 Header</h3>

<p>The header above is an <code>h3</code> element, which may be used for any form of page-level header which falls below the <code>h2</code> header in importance.</p>

<h4>Level 4 Header</h4>

<p>The header above is an <code>h4</code> element, which may be used for any form of page-level header which falls below the <code>h3</code> header in importance.</p>

<h5>Level 5 Header</h5>

<p>The header above is an <code>h5</code> element, which may be used for any form of page-level header which falls below the <code>h4</code> header in importance.</p>

<h6>Level 6 Header</h6>

<p>The header above is an <code>h6</code> element, which may be used for any form of page-level header which falls below the <code>h5</code> header in importance.</p>

<h3>Paragraphs</h3>

<p>All paragraphs are wrapped in <code>p</code> tags. Additionally, <code>p</code> elements can be wrapped with a <code>blockquote</code> element <em>if the <code>p</code> element is indeed a quote</em>.</p>

<p>This is a paragraph directly following a paragraph. It should be indented with no gap between this and the prior paragraph.</p>

<h3>Pre-formatted text</h3>

<p>The <code>pre</code> element represents a block of pre-formatted text. Here&#8217;s an example showing the printable characters of <abbr>ASCII</abbr>:</p>

    <pre><samp>  ! " # $ % &amp; ' ( ) * + , - . /
0 1 2 3 4 5 6 7 8 9 : ; &lt; = &gt; ?
@ A B C D E F G H I J K L M N O
P Q R S T U V W X Y Z [ \ ] ^ _
` a b c d e f g h i j k l m n o
p q r s t u v w x y z { | } ~ </samp></pre>

<h3>Blockquotes</h3>

<p>The <code>blockquote</code> element represents a section that is being quoted from another source.</p>

    <blockquote>
        <p>Many forms of Government have been tried, and will be tried in this world of sin and woe. No one pretends that democracy is perfect or all-wise. Indeed, it has been said that democracy is the worst form of government except all those other forms that have been tried from time to time.</p>
        <p>This is a second paragraph within the quotation, indented like the other paragraphs.</p>
    </blockquote>

<h3>Ordered list</h3>

<p>The <code>ol</code> element denotes an numbered list.</p>

    <ol>
        <li>This is an ordered list. This is an ordered list. This is an ordered list. This is an ordered list. This is an ordered list. </li>
        <li>
            This is the second item, which contains a sub list
            <ol>
                <li>This is the sub list, which is also ordered.</li>
                <li>It has two items.</li>
            </ol>
        </li>
        <li>This is the final item on this list.</li>
    </ol>

<h3>Unordered list</h3>

<p>The <code>ul</code> element denotes a bulleted list.</p>

    <ul>
    	<li>This is an unordered list. This is an unordered list. This is an unordered list. This is an unordered list. </li>
        <li>
            United Kingdom of Great Britain and Northern Ireland:
            <ul>
                <li>England</li>
                <li>Scotland</li>
                <li>Wales</li>
                <li>Northern Ireland</li>
            </ul>
        </li>
        <li>Republic of Ireland</li>
        <li>Isle of Man</li>
        <li>
            Channel Islands:
            <ul>
                <li>Bailiwick of Guernsey</li>
                <li>Bailiwick of Jersey</li>
            </ul>
        </li>
    </ul>

<p>Sometimes we may want each list item to contain block elements, typically a paragraph or two.</p>

    <ul>
        <li>
            <p>The British Isles is an archipelago consisting of the two large islands of Great Britain and Ireland, and many smaller surrounding islands.</p>
        </li>
        <li>
            <p>Great Britain is the largest island of the archipelago. Ireland is the second largest island of the archipelago and lies directly to the west of Great Britain.</p>
        </li>
        <li>
            <p>The full list of islands in the British Isles includes over 1,000 islands, of which 51 have an area larger than 20 km<sup>2</sup>.</p>
        </li>
    </ul>

<h3>Definition list</h3>

<p>The <code>dl</code> element is for another type of list called a definition list. Instead of list items, the content of a <code>dl</code> consists of <code>dt</code> (Definition Term) and <code>dd</code> (Definition description) pairs.</p>

    <dl>
        <dt>This is a term.</dt>
        <dd>This is the definition of that term, which both live in a <code>dl</code>.</dd>
        <dt>Here is another term.</dt>
        <dd>And it gets a definition too, which is this line.</dd>
        <dt>Here is term that shares a definition with the term below.</dt>
        <dt>Here is a defined term.</dt>
        <dd><code>dt</code> terms may stand on their own without an accompanying <code>dd</code>, but in that case they <em>share</em> descriptions with the next available <code>dt</code>. You may not have a <code>dd</code> without a parent <code>dt</code>.</dd>
    </dl>

<h3>Figures</h3>

<p>Figures are usually used to refer to images.</p>

    <figure>
        <img src="http://via.placeholder.com/400x200/" alt="Example image"/>
        <figcaption>
            This is a placeholder image, with supporting caption
        </figcaption>
    </figure>

<p>This is a full bleed image using <code>class='fullbleed'</code> to make maximum use of the screen estate.</p>

    <figure class="fullbleed">
        <img src="http://via.placeholder.com/1200x300/" alt="Example image"/>
        <figcaption>
            This is a full bleed placeholder image, with supporting caption
        </figcaption>
    </figure>

<figure class="inline">
    <img src="http://via.placeholder.com/200x300/" alt="Example image"/>
    <figcaption>
        This is an <code>inline</code> figure
    </figcaption>
</figure>

<p>Here, a part of a poem is marked up using figure:</p>

    <figure>
        <p>&#8216;Twas brillig, and the slithy toves<br/>
        Did gyre and gimble in the wabe;<br/>
        All mimsy were the borogoves,<br/>
        And the mome raths outgrabe.</p>
        <figcaption>
            <p><cite>Jabberwocky</cite> (first verse). Lewis Carroll, 1832-98</p>
        </figcaption>
    </figure>


<h2 id="text">Text-level Semantics</h2>

<p>There are a number of inline <abbr title="HyperText Markup Language" class="smcp">HTML</abbr> elements you may use anywhere within other elements.</p>

<h3>Links and anchors</h3>

<p>This is a <a href="/">link</a>.</p>

<h3>Stressed emphasis</h3>

<p>This uses the <code>em</code> element for <em>emphasis</em>. This is <i>italicised</i> using an <code>i</code> element.</p>

<h3>Strong importance</h3>

<p>This uses the <code>strong</code> element for <strong>importance</strong>. This is <b>emboldened</b> using a <code>b</code> element.</p>

<h3>Strikethrough</h3>

<p>This uses the <code>s</code> element to <s>strike through</s>.</p>

<h3>Citations</h3>

<p>This uses the <code>cite</code> element to for a <cite>citation</cite>.</p>


<h3>Inline quotes</h3>

<p>This uses the <code>q</code> element to for a <q>quote</q>.</p>

<h3>Definition</h3>

<p>The <code>dfn</code> element is used to highlight the <dfn>first use of a term</dfn>.</p>

<h3>Abbreviation</h3>

<p>The <code>abbr</code> element is used for any abbreviated text, like <abbr title="Staffordshire">Staffs.</abbr> and <abbr class="smcp">BBC</abbr>, the latter uses <code>class='smcp'</code> to specify small-caps.</p>
</div>

<h3>Code</h3>

<p>The <code>code</code> element is used to represent fragments of computer code as we&#8217;ve seen through this page. Here it is used in conjunction with the <code>pre</code> element:</p>

<pre><code>function getJelly() {
    echo $aDeliciousSnack;
}</code></pre>

<p>Shown with line numbers:</p>

<div class="example">
    <ol class="code">
        <li><code>&#60;?php </code></li>
        <li class="tab1"><code>echo 'Hello World!';</code></li>
        <li><code>?&#62;</code></li>
    </ol>
</div>

<h3>Variable</h3>

<p>The <code>var</code> element is used to denote a <var>variable</var>.</p>

<h3>Sample output</h3>

<p>The <code>samp</code> element is used to represent <samp>sample output</samp> from a program.</p>


<h3>Keyboard entry</h3>

<p>The <code>kbd</code> element is used to denote <kbd>user input</kbd>.<p>


<h3>Superscript and subscript text</h3>
<p>The <code>sup</code> element represents a superscript and the sub element represents a <code>sub</code>. Example:
The coordinate of the <var>i</var>th point is (<var>x<sub><var>i</var></sub></var>, <var>y<sub><var>i</var></sub></var>). For example, the 10th point has coordinate (<var>x<sub>10</sub></var>, <var>y<sub>10</sub></var>).</p>
<p>f(<var>x</var>, <var>n</var>) = log<sub>4</sub><var>x</var><sup><var>n</var></sup></p>

<h3>Marked or highlighted text</h3>

<p>The <code>mark</code> element is used to represent a run of text marked or <mark>highlighted</mark> for reference purposes.</p>
</div>

<h3 id="edits">Edits</h3>

<p>The <code>del</code> element is used to represent <del>deleted</del> or retracted text. The <code>ins</code> element, is used to represent <ins>inserted text</ins>.</p>


<h2 id="tables">Tabular data</h2>

<p>Tables should be used when displaying tabular data.</p>

    <table>
        <caption>The Very Best Eggnog</caption>
        <thead>
            <tr>
                <th scope="col">Ingredients</th>
                <th scope="col">Serves 12</th>
                <th scope="col">Serves 24</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Milk</td>
                <td>1 quart</td>
                <td>2 quart</td>
            </tr>
            <tr>
                <td>Cinnamon Sticks</td>
                <td>2</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Vanilla Bean, Split</td>
                <td>1</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Cloves</td>
                <td>5</td>
                <td>10</td>
            </tr>
            <tr>
                <td>Mace</td>
                <td>10 blades</td>
                <td>20 blades</td>
            </tr>
            <tr>
                <td>Egg Yolks</td>
                <td>12</td>
                <td>24</td>
            </tr>
            <tr>
                <td>Cups Sugar</td>
                <td>1 &frac12; cups</td>
                <td>3 cups</td>
            </tr>
            <tr>
                <td>Dark Rum</td>
                <td>1 &frac12; cups</td>
                <td>3 cups</td>
            </tr>
            <tr>
                <td>Brandy</td>
                <td>1 &frac12; cups</td>
                <td>3 cups</td>
            </tr>
            <tr>
                <td>Vanilla</td>
                <td>1 tbsp</td>
                <td>2 tbsp</td>
            </tr>
            <tr>
                <td>Half-and-half or Light Cream</td>
                <td>1 quart</td>
                <td>2 quart</td>
            </tr>
            <tr>
                <td>Freshly grated nutmeg to taste</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <p>And this is a full bleed table, using <code>class='fullbleed'</code> to enable particularly wide tables to make maximum use of screen estate.</p>

    <table class="fullbleed">
    <caption>Font Rendering on Macs</caption>
    <thead><tr><th rowspan="2">Browser</th><th colspan="5">Font Format</th></tr><tr><th>TrueType Mac</th><th>TrueType <abbr>PC</abbr></th><th>PostScript</th><th>OpenType PostScript</th><th>OpenType TrueType</th></tr></thead><tbody><tr><th>Camino&nbsp;1.2</th><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td></tr><tr><th>Safari 2</th><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td></tr><tr><th>Firefox 2</th><td class="yes">good</td><td class="partial">correct italic &amp; bold fonts displayed; miscalculation of space required for italic, bold &amp; underlined fonts resulting in overlappping text</td><td class="no">not rendered</td><td class="partial">italic &amp; bold fonts synthesised; miscalculation of space required for italic, bold &amp; underlined fonts resulting in overlappping text</td><td class="partial">italic &amp; bold fonts synthesised; miscalculation of space required for italic, bold &amp; underlined fonts resulting in overlappping text</td></tr><tr><th>Opera 9</th><td class="yes">good</td><td class="partial">good, but italic font is synthetically obliqued</td><td class="no">not rendered</td><td class="partial">bold font not rendered; italic synthesised</td><td class="partial">bold font not rendered; italic synthesised</td></tr></tbody></table>


</section>

<?php
include_once($dr . "writing_footer.inc.php");
?>
