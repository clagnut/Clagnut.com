<?php 

/* http://simplescale.online/?scale_base=17&scale_ratio=1.66667&scale_interval=5 */

$sml_textsize_body="1.0625rem"; /* 17px */
$sml_textgrid_body="1.470588235em"; /* 25px */
$sml_textgrid_body_tighter="1.176470588em"; /* 20px */

$sml_textsize_h2="1.4375rem"; /* 23px */
$sml_textgrid_h2="1.086956522em"; /* 25px */

$sml_textsize_h3="1.1875rem"; /* 19px */
$sml_textgrid_h3="1.315789474em"; /* 25px */

$sml_textsize_sm=".9375rem"; /* 15px */
$sml_textgrid_sm="1.133333333em"; /* 17px */
$sml_textgrid_sm_looser="1.33333333em"; /* 20px */

$sml_textsize_pre=".96875rem"; /* 15.5px */
$sml_textgrid_pre="1.290322581em"; /* 20px */

/*
MEDIUM
17	19
20	26
18	21
15	17
15.5 17.5
*/

$med_textsize_body="1.1875rem"; /* 19px */
$med_textgrid_body="1.473684211em"; /* 28px */
$med_textgrid_body_tighter="1.157894737em"; /* 22px */

$med_textsize_h2="1.625rem"; /* 26px */
$med_textgrid_h2="1.230769231em"; /* 32px */

$med_textsize_h3="1.3125rem"; /* 21px */
$med_textgrid_h3="1.333333333em"; /* 28px */

$med_textsize_sm="1.0625rem"; /* 17px */
$med_textgrid_sm="1.117647059em"; /* 19px */
$med_textgrid_sm_looser="1.294117647em"; /* 22px */

$med_textsize_pre="1.09375rem"; /* 17.5px */
$med_textgrid_pre="1.257142857em"; /* 22px */

/*
BIG
17	21
20	
18	
15	
15.5 
*/

$big_textsize_body="1.3125rem"; /* 17 21px */
$big_textgrid_body="1.428571429em"; /* 25 30px */
$big_textgrid_body_tighter="1.142857143em"; /* 20 24px */

$big_textsize_h2="1.75rem"; /* 20 28px */
$big_textgrid_h2="1.071428571em"; /* 25 30px */

$big_textsize_h3="1.4375rem"; /* 18 23px */
$big_textgrid_h3="1.304347826em"; /* 25 30px */

$big_textsize_sm="1.125rem"; /* 15 18px */
$big_textgrid_sm="1.166666667em"; /* 21px */
$big_textgrid_sm_looser="1.333333333em"; /* 24px */

$big_textsize_pre="1.1875rem"; /* 15.5 19px */
$big_textgrid_pre="1.263157895em"; /* 24px */


$sml_styles = "
body {
	font-size: $sml_textsize_body;
	line-height: $sml_textgrid_body;
}

article.post {
	padding-bottom: calc($sml_textgrid_body * 2);
}

#logo {
	font-size: $sml_textsize_h2;
	line-height: $sml_textgrid_h2;
	margin-top: calc($sml_textgrid_h2 / 2);
	margin-bottom: calc($sml_textgrid_h2 / 2);
}

h1 {
	font-size: calc(1.25rem + 3vmin);
	line-height: 1;
	letter-spacing: -0.02em;
}

h2 {
	font-size: $sml_textsize_h2;
	line-height: $sml_textgrid_h2;
	margin-top: $sml_textgrid_h2;
}

h3 {
	font-size: $sml_textsize_h3;
	line-height: $sml_textgrid_h3;
	margin-top: $sml_textgrid_h3;
}

h4, h5, h6 {
	font-size: $sml_textsize_body;
	line-height: $sml_textgrid_body;
	margin-top: calc($sml_textgrid_body / 2);
}

p, ul, ol, dl, dd {
	margin-bottom: calc($sml_textgrid_body / 2);
}

figure {
	margin-top: $sml_textgrid_body;
	margin-bottom: $sml_textgrid_body;
}

figure.fig-table {
	margin-bottom: calc($sml_textgrid_body / 2);
}

table {
	margin-bottom: calc($sml_textgrid_body / 2); /* leaves enough room for scrollbar */ 
}

li {
	margin-left: $sml_textgrid_body;
}

blockquote p {
	margin-bottom: 0;
	padding-left: calc($sml_textgrid_body / 2);
	margin-left: calc($sml_textgrid_body / 2) - 2px;
}

blockquote p+p {
	text-indent: $sml_textgrid_body;
}

figcaption, caption, blockquote footer {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm;
	padding-top: calc(($sml_textgrid_sm - $sml_textsize_sm) * 2);
}

.group-with-aside aside {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm_looser;
	padding-top: calc($sml_textgrid_sm_looser - 1em);
}

pre {
	font-size: $sml_textsize_pre;
	line-height: $sml_textgrid_pre;
	margin-top: $sml_textgrid_body;
	margin-bottom: $sml_textgrid_body;
}

th, td {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm;
}

.meta {
	margin-bottom: $sml_textgrid_body;
}

.published, .categories {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm;
}

.tags {
	margin-top: calc($sml_textgrid_body * 2);
	margin-bottom: calc($sml_textgrid_body * 2);
}

.tags ul, .comment {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm;	
}

.relatedposts {
	padding-top: calc($sml_textgrid_body / 2);
}

.relatedposts article {
	margin-top: $sml_textgrid_body;
	margin-bottom: $sml_textgrid_body;
}

.articles h3 {
	font-size: $sml_textsize_body;
	line-height: $sml_textgrid_body_tighter;
}

.articles .summary {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm_looser;
	margin-top: calc($sml_textgrid_sm_looser / 4);
}

.date {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm_looser;
	margin-top: calc($sml_textgrid_sm_looser / 4);
}

.archive section {
	padding-top: $sml_textgrid_body;
}

.listing li {
	margin-bottom: $sml_textgrid_body;
}

.archive .articles h3 {
	font-size: $sml_textsize_h3;
	line-height: $sml_textgrid_h3;
}

.archive .articles .summary {
	font-size: $sml_textsize_body;
}

.archive .date {
	font-size: $sml_textsize_body;
}

.categorylist {
	margin-top: $sml_textgrid_body;
	padding-top: calc($sml_textgrid_body / 2);
}

.categorylist ul {
	margin-top:  calc($sml_textgrid_body / 2);
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm_looser;	
}

.categorylist li {
	margin-bottom: calc($sml_textgrid_sm_looser / 4);	
}

.next-prev {
	padding-top: calc($sml_textgrid_body / 2);
}

footer.global {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm_looser;	
}

.masthead nav {
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm;		
}

form.search {
	margin-top: calc($sml_textgrid_body * -1);	
	margin-bottom: $sml_textgrid_body;
	font-size: $sml_textsize_body;
}

.search input {
	line-height: $sml_textgrid_body;
	font-size: inherit;
}

.introblock strong {
	font-size: $sml_textsize_h3;
	line-height: calc($sml_textgrid_h3);
}

.introblock {
	font-size: $sml_textsize_h3;
	line-height: calc($sml_textgrid_h3);
}

h2.home-latest-posts {
	margin-top: 0;
	margin-bottom: $sml_textgrid_h2;
}

.elsewhere {
	margin-bottom: $sml_textgrid_body;
}

.elsewhere p {
	margin-top: calc($sml_textgrid_sm / 2);	
	margin-bottom: $sml_textgrid_body;
	font-size: $sml_textsize_sm;
	line-height: $sml_textgrid_sm_looser;
}

.album_cover {
	height: calc($sml_textgrid_sm_looser * 2);	
	margin-bottom: calc($sml_textgrid_sm_looser / 2);
}
";


$med_styles = "
body {
	font-size: $med_textsize_body;
	line-height: $med_textgrid_body;
}

article.post {
	padding-bottom: calc($med_textgrid_body * 2);
}

#logo {
	font-size: $med_textsize_h2;
	line-height: $med_textgrid_h2;
	margin-top: calc($med_textgrid_h2 / 2);
	margin-bottom: calc($med_textgrid_h2 / 2);
}

h1 {
	font-size: calc(1.25rem + 3vmin);
	line-height: 1;
	letter-spacing: -0.02em;
}

h2 {
	font-size: $med_textsize_h2;
	line-height: $med_textgrid_h2;
	margin-top: $med_textgrid_h2;
}

h3 {
	font-size: $med_textsize_h3;
	line-height: $med_textgrid_h3;
	margin-top: $med_textgrid_h3;
}

h4, h5, h6 {
	font-size: $med_textsize_body;
	line-height: $med_textgrid_body;
	margin-top: calc($med_textgrid_body / 2);
}

p, ul, ol, dl, dd {
	margin-bottom: calc($med_textgrid_body / 2);
}

figure {
	margin-top: $med_textgrid_body;
	margin-bottom: $med_textgrid_body;
}

figure.fig-table {
	margin-bottom: calc($med_textgrid_body / 2);
}

table {
	margin-bottom: calc($med_textgrid_body / 2); /* leaves enough room for scrollbar */ 
}

li {
	margin-left: $med_textgrid_body;
}

blockquote p {
	margin-bottom: 0;
	padding-left: calc($med_textgrid_body / 2);
	margin-left: calc($med_textgrid_body / 2) - 2px;
}

blockquote p+p {
	text-indent: $med_textgrid_body;
}

figcaption, caption, blockquote footer {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm;
	padding-top: calc(($med_textgrid_sm - $med_textsize_sm) * 2);
}

.group-with-aside aside {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm_looser;
	padding-top: calc($med_textgrid_sm_looser - 1em);
}

pre {
	font-size: $med_textsize_pre;
	line-height: $med_textgrid_pre;
	margin-top: $med_textgrid_body;
	margin-bottom: $med_textgrid_body;
}

th, td {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm;
}

.meta {
	margin-bottom: $med_textgrid_body;
}

.published, .categories {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm;
}

.tags {
	margin-top: calc($med_textgrid_body * 2);
	margin-bottom: calc($med_textgrid_body * 2);
}

.tags ul, .comment {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm;	
}

.relatedposts {
	padding-top: calc($med_textgrid_body / 2);
}

.relatedposts article {
	margin-top: $med_textgrid_body;
	margin-bottom: $med_textgrid_body;
}

.articles h3 {
	font-size: $med_textsize_body;
	line-height: $med_textgrid_body_tighter;
}

.articles .summary {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm_looser;
	margin-top: calc($med_textgrid_sm_looser / 4);
}

.date {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm_looser;
	margin-top: calc($med_textgrid_sm_looser / 4);
}

.archive section {
	padding-top: $med_textgrid_body;
}

.listing li {
	margin-bottom: $med_textgrid_body;
}

.archive .articles h3 {
	font-size: $med_textsize_h3;
	line-height: $med_textgrid_h3;
}

.archive .articles .summary {
	font-size: $med_textsize_body;
}

.archive .date {
	font-size: $med_textsize_body;
}

.categorylist {
	margin-top: $med_textgrid_body;
	padding-top: calc($med_textgrid_body / 2);
}

.categorylist ul {
	margin-top:  calc($med_textgrid_body / 2);
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm_looser;	
}

.categorylist li {
	margin-bottom: calc($med_textgrid_sm_looser / 4);	
}

.next-prev {
	padding-top: calc($med_textgrid_body / 2);
}

footer.global {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm_looser;	
}

.masthead nav {
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm;		
}

form.search {
	margin-top: calc($med_textgrid_body * -1);	
	margin-bottom: $med_textgrid_body;
	font-size: $med_textsize_body;
}

.search input {
	line-height: $med_textgrid_body;
	font-size: inherit;
}

.introblock, .introblock strong {
	font-size: $med_textsize_h2;
	line-height: calc($med_textgrid_h2);
}

h2.home-latest-posts {
	margin-top: 0;
	margin-bottom: $med_textgrid_h2;
}

.elsewhere {
	margin-bottom: $med_textgrid_body;
}

.elsewhere p {
	margin-top: calc($med_textgrid_sm / 2);	
	margin-bottom: $med_textgrid_body;
	font-size: $med_textsize_sm;
	line-height: $med_textgrid_sm_looser;
}

.album_cover {
	height: calc($med_textgrid_sm_looser * 2);	
	margin-bottom: calc($med_textgrid_sm_looser / 2);
}
";



$big_styles = "
body {
	font-size: $big_textsize_body;
	line-height: $big_textgrid_body;
}

article.post {
	padding-bottom: calc($big_textgrid_body * 2);
}

#logo {
	font-size: $big_textsize_h2;
	line-height: $big_textgrid_h2;
	margin-top: calc($big_textgrid_h2 / 2);
	margin-bottom: calc($big_textgrid_h2 / 2);
}

h1 {
	font-size: calc(1.25rem + 3vmin);
	line-height: 1;
	letter-spacing: -0.02em;
}

h2 {
	font-size: $big_textsize_h2;
	line-height: $big_textgrid_h2;
	margin-top: $big_textgrid_h2;
}

h3 {
	font-size: $big_textsize_h3;
	line-height: $big_textgrid_h3;
	margin-top: $big_textgrid_h3;
}

h4, h5, h6 {
	font-size: $big_textsize_body;
	line-height: $big_textgrid_body;
	margin-top: calc($big_textgrid_body / 2);
}

p, ul, ol, dl, dd {
	margin-bottom: calc($big_textgrid_body / 2);
}

figure {
	margin-top: $big_textgrid_body;
	margin-bottom: $big_textgrid_body;
}

figure.fig-table {
	margin-bottom: calc($big_textgrid_body / 2);
}

table {
	margin-bottom: calc($big_textgrid_body / 2); /* leaves enough room for scrollbar */ 
}

li {
	margin-left: $big_textgrid_body;
}

blockquote p {
	margin-bottom: 0;
	padding-left: calc($big_textgrid_body / 2);
	margin-left: calc($big_textgrid_body / 2) - 2px;
}

blockquote p+p {
	text-indent: $big_textgrid_body;
}

figcaption, caption, blockquote footer {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm;
	padding-top: calc(($big_textgrid_sm - $big_textsize_sm) * 2);
}

.group-with-aside aside {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm_looser;
	padding-top: calc($big_textgrid_sm_looser - 1em);
}

pre {
	font-size: $big_textsize_pre;
	line-height: $big_textgrid_pre;
	margin-top: $big_textgrid_body;
	margin-bottom: $big_textgrid_body;
}

th, td {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm;
}

.meta {
	margin-bottom: $big_textgrid_body;
}

.published, .categories {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm;
}

.tags {
	margin-top: calc($big_textgrid_body * 2);
	margin-bottom: calc($big_textgrid_body * 2);
}

.tags ul, .comment {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm;	
}

.relatedposts {
	padding-top: calc($big_textgrid_body / 2);
}

.relatedposts article {
	margin-top: $big_textgrid_body;
	margin-bottom: $big_textgrid_body;
}

.articles h3 {
	font-size: $big_textsize_body;
	line-height: $big_textgrid_body_tighter;
}

.articles .summary {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm_looser;
	margin-top: calc($big_textgrid_sm_looser / 4);
}

.date {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm_looser;
	margin-top: calc($big_textgrid_sm_looser / 4);
}

.archive section {
	padding-top: $big_textgrid_body;
}

.listing li {
	margin-bottom: $big_textgrid_body;
}

.archive .articles h3 {
	font-size: $big_textsize_h3;
	line-height: $big_textgrid_h3;
}

.archive .articles .summary {
	font-size: $big_textsize_body;
}

.archive .date {
	font-size: $big_textsize_body;
}

.categorylist {
	margin-top: $big_textgrid_body;
	padding-top: calc($big_textgrid_body / 2);
}

.categorylist ul {
	margin-top:  calc($big_textgrid_body / 2);
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm_looser;	
}

.categorylist li {
	margin-bottom: calc($big_textgrid_sm_looser / 4);	
}

.next-prev {
	padding-top: calc($big_textgrid_body / 2);
}

footer.global {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm_looser;	
}

.masthead nav {
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm;		
}

form.search {
	margin-top: calc($big_textgrid_body * -1);	
	margin-bottom: $big_textgrid_body;
	font-size: $big_textsize_body;
}

.search input {
	line-height: $big_textgrid_body;
	font-size: inherit;
}

.introblock, .introblock strong {
	font-size: $big_textsize_h2;
	line-height: calc($big_textgrid_h2);
}

h2.home-latest-posts {
	margin-top: 0;
	margin-bottom: $big_textgrid_h2;
}

.elsewhere {
	margin-bottom: $big_textgrid_body;
}

.elsewhere p {
	margin-top: calc($big_textgrid_sm / 2);	
	margin-bottom: $big_textgrid_body;
	font-size: $big_textsize_sm;
	line-height: $big_textgrid_sm_looser;
}

.album_cover {
	height: calc($big_textgrid_sm_looser * 2);	
	margin-bottom: calc($big_textgrid_sm_looser / 2);
}
";

echo "/* @group Small screens (default) */<br><br>";

echo $sml_styles;

echo "<br><br>/* @end */<br><br>@media all and (min-width: 60em) { /* Tablets */<br><br>";

echo $med_styles;

echo "<br><br>h1 {<br>font-size: calc(2.5rem + 3vmin);<br>}<br>}<br><br>@media all and (min-width:92em) { /* Desktops */<br><br>";

echo $big_styles;

echo "<br>	h1 {<br>font-size: calc(3rem + 3vmin);<br>}<br>}<br><br>";

 ?>