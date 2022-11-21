<figure class="inline"><a href="http://www.amazon.co.uk/dp/389955468X?tag=jalfrezi-21"><img src="/images/designingnews_180.png" alt="Book cover showing similar colours and typographic treatment" /></a><figcaption>Front cover of Designing News</figcaption></figure>

The visual design of this website is unashamedly based on the front cover of a fabulous book, <a href="http://www.amazon.co.uk/dp/389955468X?tag=jalfrezi-21"><cite>Designing News</cite></a> by <a href="http://www.FrancescoFranchi.com">Francesco Franchi</a>, as published in hard back September 2013.

Headings and body text are all set in the variable font <a href="https://www.type-together.com/literata-font">Literata</a> designed by Veronika Burian and José Scaglione of TypeTogether. Captions and tables are set in a variable version of [IBM Plex Sans](https://www.ibm.com/plex/), designed by Mike Abbink, Paul van der Laan, and Pieter van Rosmalen of [Bold Monday](https://www.boldmonday.com). Code is set in a variable version of [Inconsolata](http://levien.com/type/myfonts/inconsolata.html) by Raph Levien.

The site is built on a homemade <abbr class="smcp">CMS</abbr>. It was hand-coded in <a href="https://www.espressoapp.com/">Espresso</a>, marked up using semantic <abbr class="smcp">HTML</abbr> and <abbr class="smcp">CSS</abbr>.

I've used responsive design techniques to hopefully ensure the site is nicely readable on lots of devices. Text is scaled using [Utopian techniques](https://utopia.fyi). I've put together a kind of style guide, mostly as a check that all likely mark-up is styled appropriately. While the site has not been widely tested, it should be fine on all modern browsers. Please <a href="/about#contact">let me know</a> if you come across any problems.

---

## Style Guide

This is a guide to the mark-up styles used throughout the site. In particular it&#8217;s a check that all likely mark-up is styled appropriately.

## Sections (a Level 2 Heading)

The secondary header above is an `h2` element, which may be used for any form of important page-level header.

### Level 3 Header

The header above is an `h3` element, which may be used for any form of page-level header which falls below the `h2` header in importance.

#### Level 4 Header

The header above is an `h4` element, which may be used for any form of page-level header which falls below the `h3` header in importance.

##### Level 5 Header

The header above is an `h5` element, which may be used for any form of page-level header which falls below the `h4` header in importance.

###### Level 6 Header

The header above is an `h6` element, which may be used for any form of page-level header which falls below the `h5` header in importance.

### Paragraphs

All paragraphs are wrapped in `p` tags. Additionally, `p` elements can be wrapped with a `blockquote` element _if the `p` element is indeed a quote_.

This is a paragraph directly following a paragraph. There should be a small gap between this and the prior paragraph.

### Code block

Here's a block of code. It should be using [Prism.js](https://prismjs.com/) for syntax highlighting.

	p {
		hyphens: auto;
		hyphenate-limit-chars: 6 3 3;
		hyphenate-limit-lines: 2;	
		hyphenate-limit-last: always;
		hyphenate-limit-zone: 8%;
	}

### Blockquotes

The `blockquote` element represents a section that is being quoted from another source. The following is a single paragraph:

> Democracy is a system of government where the citizens exercise power by voting.In a direct democracy, the citizens as a whole form a governing body and vote directly on each issue.

Multiple paragraphs:

  <blockquote><p>Many forms of Government have been tried, and will be tried in this world of sin and woe. No one pretends that democracy is perfect or all-wise. Indeed, it has been said that democracy is the worst form of government except all those other forms that have been tried from time to time.</p><p>This is a second paragraph within the quotation, indented unlike the non-quoted paragraphs.</p></blockquote>
  
 A blockquote in quotes with a citation:
  
  <blockquote class="quoted">
  <p>One more attribute the modern typographer must have: the capacity for taking great pains with seemingly unimportant detail. To him, one typographical point must be as important as one inch, and he must harden his heart against the accusation of being too fussy.</p>
  <footer>— Hans P. Schmoller, in ‘Book Design Today’, <cite>Printing Review</cite>, 1951</footer>
  </blockquote> 

### Ordered list

The `ol` element denotes an numbered list.


1. This is an ordered list. This is an ordered list. This is an ordered list. This is an ordered list. This is an ordered list.
1. This is the second item, which contains a sub list
	1. This is the sub list, which is also ordered.
    2. It has two items.
1. This is the final item on this list.</li>
    

### Unordered list

The `ul` element denotes a bulleted list.

- This is an unordered list. This is an unordered list. This is an unordered list. This is an unordered list. </li>
- United Kingdom of Great Britain and Northern Ireland:
	- England
	- Scotland
	- Wales
	- Northern Ireland
- Republic of Ireland
- Isle of Man
- Channel Islands:
	- Bailiwick of Guernsey
	- Bailiwick of Jersey

Sometimes we may want each list item to contain block elements, typically a paragraph or two.
  
- This is a first paragraph in the list item. This is a first paragraph in the list item. This is a first paragraph in the list item. This is a first paragraph in the list item.
  
  This is a second paragraph in the list item. This is a second paragraph in the list item. This is a second paragraph in the list item. This is a second paragraph in the list item.
- The British Isles is an archipelago consisting of the two large islands of Great Britain and Ireland, and many smaller surrounding islands.

- Great Britain is the largest island of the archipelago. Ireland is the second largest island of the archipelago and lies directly to the west of Great Britain.

- The full list of islands in the British Isles includes over 1,000 islands, of which 51 have an area larger than 20 km<sup>2</sup>.

### Definition list

The `dl` element is for another type of list called a definition list. Instead of list items, the content of a `dl` consists of `dt` (Definition Term) and `dd` (Definition description) pairs.

<dl>
    <dt>This is a term.</dt>
    <dd markdown="1">This is the definition of that term, which both live in a `dl`.</dd>
    <dt>Here is another term.</dt>
    <dd>And it gets a definition too, which is this line.</dd>
    <dt>Here is term that shares a definition with the term below.</dt>
    <dt>Here is a defined term.</dt>
    <dd markdown="1">`dt` terms may stand on their own without an accompanying `dd`, but in that case they _share_ descriptions with the next available `dt`. You may not have a `dd` without a parent `dt`.</dd>
</dl>

### Figures

Figures are usually used to refer to images.

<figure>
    <img src="/images/400x200.png" alt="Example image"/>
    <figcaption>
        This is a placeholder image, with supporting caption
    </figcaption>
</figure>


This is a full bleed image using `class='fullbleed'` to make maximum use of the screen estate.

<figure class="fullbleed">
    <img src="/images/1200x300.png" alt="Example image"/>
    <figcaption>
        This is a full bleed placeholder image, with supporting caption
    </figcaption>
</figure>

<figure class="inline"><img src="/images/200x300.png" alt="Example image"/><figcaption>This is an `inline` figure</figcaption></figure>

Here, a part of a poem is marked up using figure:

<figure>
    &#8216;Twas brillig, and the slithy toves<br/>
    Did gyre and gimble in the wabe;<br/>
    All mimsy were the borogoves,<br/>
    And the mome raths outgrabe.
    <figcaption>
        <cite>Jabberwocky</cite> (first verse). Lewis Carroll, 1832-98
    </figcaption>
</figure>

## Text-level Semantics

There are a number of inline <abbr title="HyperText Markup Language" class="smcp">HTML</abbr> elements you may use anywhere within other elements.

### Links and anchors

This is a <a href="/">link</a>.

### Stressed emphasis

This uses the `em` element for _emphasis_. This is <i>italicised</i> using an `i` element.

### Strong importance

This uses the `strong` element for <strong>importance</strong>. This is <b>emboldened</b> using a `b` element.

### Strikethrough

This uses the `s` element to <s>strike through</s>.

### Citations

This uses the `cite` element to for a <cite>citation</cite>.


### Inline quotes

This uses the `q` element to for a <q>quote</q>.

### Definition

The `dfn` element is used to highlight the <dfn>first use of a term</dfn>.

### Abbreviation

The `abbr` element is used for any abbreviated text, like <abbr title="Staffordshire">Staffs.</abbr> and <abbr class="c2sc">BBC</abbr>, the latter uses `class='c2sc'` to specify small-caps.

### Code

The `code` element is used to represent fragments of computer code as we&#8217;ve seen through this page.

### Variable

The `var` element is used to denote a <var>variable</var>.

### Sample output

The `samp` element is used to represent <samp>sample output</samp> from a program.


### Keyboard entry

The `kbd` element is used to denote <kbd>user input</kbd>.


### Superscript and subscript text
The `sup` element represents a superscript and the sub element represents a `sub`. Example:
The coordinate of the i<sup>th</sup> point is (x<sub>i</sub>, y<sub>i</sub>). For example, the 10<sup>th</sup> point has coordinate (x<sub>10</sub>, y<sub>10</sub>).
f(x, n) = log<sub>4</sub>x<sup>n</sup>

### Marked or highlighted text

The `mark` element is used to represent a run of text marked or <mark>highlighted</mark> for reference purposes.

### Edits

The `del` element is used to represent <del>deleted</del> or retracted text. The `ins` element, is used to represent <ins>inserted text</ins>.


## Tabular data

Tables should be used when displaying tabular data.

<figure class="fig-table">
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
</figure>

And this is a wide table to making maximum use of screen estate.

<figure class="fig-table">
<table>
<caption>Font Rendering on Macs</caption>
<thead><tr><th rowspan="2">Browser</th><th colspan="5">Font Format</th></tr><tr><th>TrueType Mac</th><th>TrueType <abbr>PC</abbr></th><th>PostScript</th><th>OpenType PostScript</th><th>OpenType TrueType</th></tr></thead><tbody><tr><th>Camino&nbsp;1.2</th><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td></tr><tr><th>Safari 2</th><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td><td class="yes">good</td></tr><tr><th>Firefox 2</th><td class="yes">good</td><td class="partial">correct italic &amp; bold fonts displayed; miscalculation of space required for italic, bold &amp; underlined fonts resulting in overlappping text</td><td class="no">not rendered</td><td class="partial">italic &amp; bold fonts synthesised; miscalculation of space required for italic, bold &amp; underlined fonts resulting in overlappping text</td><td class="partial">italic &amp; bold fonts synthesised; miscalculation of space required for italic, bold &amp; underlined fonts resulting in overlappping text</td></tr><tr><th>Opera 9</th><td class="yes">good</td><td class="partial">good, but italic font is synthetically obliqued</td><td class="no">not rendered</td><td class="partial">bold font not rendered; italic synthesised</td><td class="partial">bold font not rendered; italic synthesised</td></tr></tbody></table>
</figure>
