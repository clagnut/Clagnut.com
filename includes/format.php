<?php
// If magic quotes is tuned on then strip slashes
if (get_magic_quotes_gpc()) {
  foreach ($_POST as $key => $value) {
    $_POST[$key] = stripslashes($value);
  }
}

include($dr . "textile.php");
require_once $dr . 'Michelf/MarkdownExtra.inc.php';
use Michelf\MarkdownExtra;


function preformat($text) {
	if (preg_match("/^<p>/",$text)){
		$text = str_replace("\n", "", $text);
	}
	$search = array ("\\", "'mare", "'flu", "'Flu", "---", "--", "<br />");
	$replace = array ("\\\\", "&#8217;mare", "&#8217;flu", "&#8217;Flu", "\nnewsection\n", "-", "\n");
	$text = str_replace($search, $replace, $text);
	
	$reg_patterns = array ("/ (\d+) (px|em|ems|en|ex|rem|dpi|ppi|ch|pt|inch|cm|mm|arcmin|lb|AD|BC|pica|picas|vw|vmin)\b/");
	$reg_replace = array (" $1 $2");
	$text = preg_replace($reg_patterns, $reg_replace, $text);

	return $text;
}

function format($text, $textile="y") {

	$text = preformat($text);

	if($textile=="y") {
		$text = textile($text);
		
		# get amazon store
		$amz_dest = (isset($_COOKIE["amz_dest"]))? $_COOKIE["amz_dest"] : "uk";
		$amz_affil["uk"] = array(".co.uk", "jalfrezi-21", "UK and the rest of Europe");
		$amz_affil["ca"] = array(".ca", "clagnut0d-20", "Canada");
		$amz_affil["com"] = array(".com", "clagnut-20", "US and the rest of the world");
		
		$search = array (
			"<p><p",
			"</p></p>",
			"<p>newsection</p>",
			"newsection<br />",
			"<p><address",
			"</address></p>",
			"<p><form",
			"</form></p>",
			"<p><dl",
			"</dl></p>",
			"<p><table",
			"<table><br />",
			"</table></p>",
			"</table><br />",
			"</tr><br />",
			"</th><br />",
			"</td><br />",
			"</thead><br />",
			"</tfoot><br />",
			"</tbody><br />",
			"</caption><br />",
			" title=\"\"",
			"<pre>",
			"</pre>",
			"<p><a imglink",
			"<p><ai imglink",
			 "<p><imgi",
			"<p><img ",
			"<li><ai imglink",
			"<imgi ",
			"<p><div",
			"</div></p>",
			"<p>&#8224;",
			"<p>&#8225;",
			"<p><ul",
			"</ul></p>",
			"</li><br />",
			"<p><dl",
			"</dt><br />",
			"</dd><br />",
			"</dl><br />",
			"<p><ol",
			"</ol></p>",
			"<p><script",
			"</script></p>",
			"<br />\n<li>",
			"amazon.co.uk",
			"Amazon.co.uk",
			"jalfrezi-21",
			"<p>[firefoxad]</p>",
			"<p><object",
			"<p><h3",
			"</h3></p>",
			"<p><h2",
			"</h2></p>");
		$replace = array (
			"<p",
			"</p>",
			"</section>\n<section>",
			"</section>\n<section>",
			"<address",
			"</address>",
			"<form",
			"</form>",
			"<dl",
			"</dl>",
			"<table",
			"<table>",
			"</table>",
			"</table>",
			"</tr>",
			"</th>",
			"</td>",
			"</thead>",
			"</tfoot>",
			"</tbody>",
			"</caption>",
			"",
			"<pre><code>",
			"</code></pre>",
			"<figure><a",
			"<figure class='inline'><a",
			"<figure class='inline'><img",
			"<figure><img ",
			"<li><a class='inline'",
			"<img ",
			"<div",
			"</div>",
			"<p class='footnote'>&#8224;",
			"<p class='footnote'>&#8225;",
			"<ul",
			"</ul>",
			"</li>",
			"<dl",
			"</dt>",
			"</dd>",
			"</dl>",
			"<ol",
			"</ol>",
			"<script",
			"</script>",
			"\n<li>",
			"amazon".$amz_affil[$amz_dest][0],
			"Amazon".$amz_affil[$amz_dest][0],
			$amz_affil[$amz_dest][1],
			"<div style='float:left; width:125px; margin:0 1em 0.5em 0'><script type='text/javascript'>google_ad_client='pub-0245469311642720'; google_ad_width = 125; google_ad_height = 125; google_ad_format = '125x125_as_rimg'; google_cpa_choice = 'CAAQveHnzwEaCEiH5iXPqf1SKJe193M'; </script><script type='text/javascript' src='http://pagead2.googlesyndication.com/pagead/show_ads.js'></script></div>",
			"<p class='imgholder'><object",
			"<h3",
			"</h3>",
			"<h2",
			"</h2>");
		$text = str_replace($search, $replace, $text);
		
		$search = array (
			"/<figure(.*?)<\/p>/is", 
			"/<p class='imgholder inline'>(.*?)<\/p>/is", 
			"/<p class=\"imgholder inline\">(.*?)<\/p>/is", 
			"/<p class='imgholder'>(.*?)<\/p>/is", 
			"/<p class=\"imgholder\">(.*?)<\/p>/is", 
			"/<figcaption><br \/>/is", 
			"/<\/figure><\/figure>/is", 
			"/<p><figure>/is", 
			"/<code><code>/is", 
			"/<\/code><\/code>/is", 
			"/<table>/is", 
			"/<\/table>/is"
			);
		$replace = array (
			"<figure$1</figure>", 
			"<figure class='inline'>$1</figure>", 
			"<figure class='inline'>$1</figure>", 
			"<figure>$1</figure>", 
			"<figure>$1</figure>", 
			"<figcaption>", 
			"</figure>", 
			"<figure>", 
			"<code>", 
			"</code>", 
			"<figure class='fig-table'><table>", 
			"</table></figure>"
			);
		$text = preg_replace($search, $replace, $text);
	} else {
		
		$text = MarkdownExtra::defaultTransform($text);		
		$text = SmartyPants::defaultTransform($text);
		$search = array (
			"<p>newsection</p>",
			"newsection<br />",
			"<p><figure></p>",
			"<p></figure></p>",
			"</figure></p>",
			"<p><figure",
			"</p>\n\n<figcaption>",
			"</figcaption></p>",
			);
		$replace = array (
			"</section>\n<section>",
			"</section>\n<section>",
			"<figure>",
			"</figure>",
			"</figure>",
			"<figure",
			"<figcaption>",
			"</figcaption>",
			);
		$text = str_replace($search, $replace, $text);
	
	}
		
	$search = array (
		"<figure",
		"</figure>",
		"<section>",
		"</section>",
		"<pre><code>",
		"</code></pre>",
		"<code class=\"language-css\">// html\n",
		" - ",
		" OS X",
		"CSS 2",
		"CSS 3",
		"CSS 4",
		"WOFF 2",
		"HTML 4",
		"HTML 5",
		" × ",
		"imgholder ",
		"URLs",
		);
	$replace = array (
		"</div><!-- /.prose --><figure",
		"</figure><div class='prose'>",
		"<section><div class='prose'>",
		"</div><!-- /.prose --></section>",
		"<figure class=\"pre\" data-element=\"code-block\"><div class=\"code-block__header\"><div role=\"alert\"></div></div><pre><code class=\"language-css\">",
		"</code></pre></figure>",
		"<code class=\"language-html\">",
		" – ",
		" OS X",
		"CSS2",
		"CSS3",
		"CSS4",
		"WOFF2",
		"HTML&nbsp;4",
		"HTML&nbsp;5",
		"&nbsp;×&nbsp;",
		"",
		"<abbr class=\"c2sc\">URL</abbr>s",		);
	$text = str_replace($search, $replace, $text);
	
	$search = array (
		"/(\S+) (\w+<\/h[1-6]>)/i",
		"/<figure class='inline'>(.*?)<\/figure>/i",
		"/<figure class=\"inline\">(.*?)<\/figure>/i",
		"/<figure>[\s]*<p><img/i",
		"/<img/i",
		"/ (\S+<\/h[2-6]>)/",		
		"/([0-9]+)x([0-9]+)/",
		"/\b(x-height)(s?)\b/",
		"/(<h[1-6])&nbsp;/",
		'/\b([A-Z][A-Z0-9]{2,})(s?)\b(?:[(]([^)]*)[)])/',		# 3+ uppercase acronym
		'/(^|[^"][>\s])([A-Z][A-Z0-9\-]+)([^a-zA-Z0-9]|$|s)/',	# 2+ uppercase caps
		);
	$replace = array (
		"$1&nbsp;$2",
		"<figure class='inline'><div class='inline-holder'>$1</div></figure>",
		"<figure class='inline'><div class='inline-holder'>$1</div></figure>",
		"<figure><img",
		"<img loading='lazy'",
		"&nbsp;$1",		
		"$1×$2",
		"<span class='nobr'>$1$2</span>",
		"$1 ",
		"<abbr class='c2sc' title='$3'>$1</abbr>$2",	# 3+ uppercase acronym
		"$1<abbr class='c2sc'>$2</abbr>$3",		# 2+ uppercase caps
		);
	$text = preg_replace($search, $replace, $text);
	
	# some smallcaps corrections
	$search = array (
		"<abbr class='c2sc'>CSS</abbr> Working Group",
		"<abbr class='c2sc'>CSS</abbr> WG",
		);
	$replace = array (
		"CSS Working Group",
		"<abbr class='c2sc'>CSS WG</abbr>",
		);
	$text = str_replace($search, $replace, $text);
	
		
	$text = trim($text);
	
	return $text;
}

function makeDescription($maincontent,$description, $textile="y") {
	if ($description == "" OR $description == "<p></p>") {
		$description = $maincontent;
	}
	$description = format($description, $textile);
	$description = str_replace("<br />", " ", $description);
	$description = strip_tags($description);
	$description = substr($description,0,280);
	if (strlen($description) == 280) {
		$description = preg_replace("/\s[^\s!]+\s?$/", "&#8230;", $description);
	}
	return $description;
}


// format comment for display
function formatcomment($thecomment) {
	# turn all HTML to entities
	$thecomment = htmlspecialchars($thecomment);
	# strip PHP and HTML tags to be sure
	$thecomment = strip_tags($thecomment);
	# make lone URLs into Textile links
	$thecomment = preg_replace("/((\s|^)(http(s?):\/\/(www\.)?)|(\s|^)(www\.))(\S+)/i", "$2$6\"$3$7$8\":http$4://$5$7$8", $thecomment);
	
	# put quotes back so textile works
	$thecomment = str_replace("&quot;", "\"", $thecomment);
	# Textilise comment
	$thecomment = preformat($thecomment);
	$thecomment = textile($thecomment, true);
	return $thecomment;
}


// work out simple plural
function plural($number) {
	$plural = ($number == 1)?"":"s";
	
	return $plural;
}


// work out relative time string
// $time should be a Unix timestamp - get it with strtotime()
function get_elapsedtime($time) {

    $gap = max(1, time() - $time);

    if ($gap < 60)  { 
        return $gap.' second'.($gap > 1 ? 's' : '').' ago';
    }

    $gap = round($gap / 60);
    if ($gap < 60)  { 
        return $gap.' minute'.($gap > 1 ? 's' : '').' ago';
    }

    $gap = round($gap / 60);
    if ($gap < 24)  { 
        return $gap.' hour'.($gap > 1 ? 's' : '').' ago';
    }

    $gap = round($gap / 24);
    if ($gap < 7) {
		return $gap.' day'.($gap > 1 ? 's' : '').' ago';
	}

    $gap = round($gap / 7);
    if ($gap < 52) {
		return $gap.' week'.($gap > 1 ? 's' : '').' ago';
	}
	
	$gap = round($gap / 52);
	return $gap.' year'.($gap > 1 ? 's' : '').' ago';

}


#
# SmartyPants  -  Smart typography for web sites
#
# PHP SmartyPants
# Copyright (c) 2004-2016 Michel Fortin
# <https://michelf.ca/>
#
# Original SmartyPants
# Copyright (c) 2003-2004 John Gruber
# <https://daringfireball.net/>
#
# namespace Michelf;


#
# SmartyPants Parser Class
#

class SmartyPants {

	### Version ###

	const  SMARTYPANTSLIB_VERSION  =  "1.8.1";


	### Presets

	# SmartyPants does nothing at all
	const  ATTR_DO_NOTHING             =  0;
	# "--" for em-dashes; no en-dash support
	const  ATTR_EM_DASH                =  1;
	# "---" for em-dashes; "--" for en-dashes
	const  ATTR_LONG_EM_DASH_SHORT_EN  =  2;
	# "--" for em-dashes; "---" for en-dashes
	const  ATTR_SHORT_EM_DASH_LONG_EN  =  3;
	# "--" for em-dashes; "---" for en-dashes
	const  ATTR_STUPEFY                = -1;

	# The default preset: ATTR_EM_DASH
	const  ATTR_DEFAULT  =  SmartyPants::ATTR_EM_DASH;


	### Standard Function Interface ###

	public static function defaultTransform($text, $attr = SmartyPants::ATTR_DEFAULT) {
	#
	# Initialize the parser and return the result of its transform method.
	# This will work fine for derived classes too.
	#
		# Take parser class on which this function was called.
		$parser_class = \get_called_class();

		# try to take parser from the static parser list
		static $parser_list;
		$parser =& $parser_list[$parser_class][$attr];

		# create the parser if not already set
		if (!$parser)
			$parser = new $parser_class($attr);

		# Transform text using parser.
		return $parser->transform($text);
	}


	### Configuration Variables ###

	# Partial regex for matching tags to skip
	public $tags_to_skip = 'pre|code|kbd|script|style|math';

	# Options to specify which transformations to make:
	public $do_nothing   = 0; # disable all transforms
	public $do_quotes    = 0;
	public $do_backticks = 0; # 1 => double only, 2 => double & single
	public $do_dashes    = 0; # 1, 2, or 3 for the three modes described above
	public $do_ellipses  = 0;
	public $do_stupefy   = 0;
	public $convert_quot = 0; # should we translate &quot; entities into normal quotes?

	# Smart quote characters:
	# Opening and closing smart double-quotes.
	public $smart_doublequote_open  = '&#8220;';
	public $smart_doublequote_close = '&#8221;';
	public $smart_singlequote_open  = '&#8216;';
	public $smart_singlequote_close = '&#8217;'; # Also apostrophe.

	# ``Backtick quotes''
	public $backtick_doublequote_open  = '&#8220;'; // replacement for ``
	public $backtick_doublequote_close = '&#8221;'; // replacement for ''
	public $backtick_singlequote_open  = '&#8216;'; // replacement for `
	public $backtick_singlequote_close = '&#8217;'; // replacement for ' (also apostrophe)

	# Other punctuation
	public $em_dash = '&#8212;';
	public $en_dash = '&#8211;';
	public $ellipsis = '&#8230;';

	### Parser Implementation ###

	public function __construct($attr = SmartyPants::ATTR_DEFAULT) {
	#
	# Initialize a parser with certain attributes.
	#
	# Parser attributes:
	# 0 : do nothing
	# 1 : set all
	# 2 : set all, using old school en- and em- dash shortcuts
	# 3 : set all, using inverted old school en and em- dash shortcuts
	# 
	# q : quotes
	# b : backtick quotes (``double'' only)
	# B : backtick quotes (``double'' and `single')
	# d : dashes
	# D : old school dashes
	# i : inverted old school dashes
	# e : ellipses
	# w : convert &quot; entities to " for Dreamweaver users
	#
		if ($attr == "0") {
			$this->do_nothing   = 1;
		}
		else if ($attr == "1") {
			# Do everything, turn all options on.
			$this->do_quotes    = 1;
			$this->do_backticks = 1;
			$this->do_dashes    = 1;
			$this->do_ellipses  = 1;
		}
		else if ($attr == "2") {
			# Do everything, turn all options on, use old school dash shorthand.
			$this->do_quotes    = 1;
			$this->do_backticks = 1;
			$this->do_dashes    = 2;
			$this->do_ellipses  = 1;
		}
		else if ($attr == "3") {
			# Do everything, turn all options on, use inverted old school dash shorthand.
			$this->do_quotes    = 1;
			$this->do_backticks = 1;
			$this->do_dashes    = 3;
			$this->do_ellipses  = 1;
		}
		else if ($attr == "-1") {
			# Special "stupefy" mode.
			$this->do_stupefy   = 1;
		}
		else {
			$chars = preg_split('//', $attr);
			foreach ($chars as $c){
				if      ($c == "q") { $this->do_quotes    = 1; }
				else if ($c == "b") { $this->do_backticks = 1; }
				else if ($c == "B") { $this->do_backticks = 2; }
				else if ($c == "d") { $this->do_dashes    = 1; }
				else if ($c == "D") { $this->do_dashes    = 2; }
				else if ($c == "i") { $this->do_dashes    = 3; }
				else if ($c == "e") { $this->do_ellipses  = 1; }
				else if ($c == "w") { $this->convert_quot = 1; }
				else {
					# Unknown attribute option, ignore.
				}
			}
		}
	}

	public function transform($text) {

		if ($this->do_nothing) {
			return $text;
		}

		$tokens = $this->tokenizeHTML($text);
		$result = '';
		$in_pre = 0;  # Keep track of when we're inside <pre> or <code> tags.

		$prev_token_last_char = ""; # This is a cheat, used to get some context
									# for one-character tokens that consist of 
									# just a quote char. What we do is remember
									# the last character of the previous text
									# token, to use as context to curl single-
									# character quote tokens correctly.

		foreach ($tokens as $cur_token) {
			if ($cur_token[0] == "tag") {
				# Don't mess with quotes inside tags.
				$result .= $cur_token[1];
				if (preg_match('@<(/?)(?:'.$this->tags_to_skip.')[\s>]@', $cur_token[1], $matches)) {
					$in_pre = isset($matches[1]) && $matches[1] == '/' ? 0 : 1;
				}
			} else {
				$t = $cur_token[1];
				$last_char = substr($t, -1); # Remember last char of this token before processing.
				if (! $in_pre) {
					$t = $this->educate($t, $prev_token_last_char);
				}
				$prev_token_last_char = $last_char;
				$result .= $t;
			}
		}

		return $result;
	}


	function decodeEntitiesInConfiguration() {
	#
	#   Utility function that converts entities in configuration variables to
	#   UTF-8 characters.
	#
		$output_config_vars = array(
			'smart_doublequote_open',
			'smart_doublequote_close',
			'smart_singlequote_open',
			'smart_singlequote_close',
			'backtick_doublequote_open',
			'backtick_doublequote_close',
			'backtick_singlequote_open',
			'backtick_singlequote_close',
			'em_dash',
			'en_dash',
			'ellipsis',
		);
		foreach ($output_config_vars as $var) {
			$this->$var = html_entity_decode($this->$var);
		}
	}


	protected function educate($t, $prev_token_last_char) {
		$t = $this->processEscapes($t);

		if ($this->convert_quot) {
			$t = preg_replace('/&quot;/', '"', $t);
		}

		if ($this->do_dashes) {
			if ($this->do_dashes == 1) $t = $this->educateDashes($t);
			if ($this->do_dashes == 2) $t = $this->educateDashesOldSchool($t);
			if ($this->do_dashes == 3) $t = $this->educateDashesOldSchoolInverted($t);
		}

		if ($this->do_ellipses) $t = $this->educateEllipses($t);

		# Note: backticks need to be processed before quotes.
		if ($this->do_backticks) {
			$t = $this->educateBackticks($t);
			if ($this->do_backticks == 2) $t = $this->educateSingleBackticks($t);
		}

		if ($this->do_quotes) {
			if ($t == "'") {
				# Special case: single-character ' token
				if (preg_match('/\S/', $prev_token_last_char)) {
					$t = $this->smart_singlequote_close;
				}
				else {
					$t = $this->smart_singlequote_open;
				}
			}
			else if ($t == '"') {
				# Special case: single-character " token
				if (preg_match('/\S/', $prev_token_last_char)) {
					$t = $this->smart_doublequote_close;
				}
				else {
					$t = $this->smart_doublequote_open;
				}
			}
			else {
				# Normal case:
				$t = $this->educateQuotes($t);
			}
		}

		if ($this->do_stupefy) $t = $this->stupefyEntities($t);
		
		return $t;
	}


	protected function educateQuotes($_) {
	#
	#   Parameter:  String.
	#
	#   Returns:    The string, with "educated" curly quote HTML entities.
	#
	#   Example input:  "Isn't this fun?"
	#   Example output: &#8220;Isn&#8217;t this fun?&#8221;
	#
		$dq_open  = $this->smart_doublequote_open;
		$dq_close = $this->smart_doublequote_close;
		$sq_open  = $this->smart_singlequote_open;
		$sq_close = $this->smart_singlequote_close;
	
		# Make our own "punctuation" character class, because the POSIX-style
		# [:PUNCT:] is only available in Perl 5.6 or later:
		$punct_class = "[!\"#\\$\\%'()*+,-.\\/:;<=>?\\@\\[\\\\\]\\^_`{|}~]";

		# Special case if the very first character is a quote
		# followed by punctuation at a non-word-break. Close the quotes by brute force:
		$_ = preg_replace(
			array("/^'(?=$punct_class\\B)/", "/^\"(?=$punct_class\\B)/"),
			array($sq_close,                 $dq_close), $_);

		# Special case for double sets of quotes, e.g.:
		#   <p>He said, "'Quoted' words in a larger quote."</p>
		$_ = preg_replace(
			array("/\"'(?=\w)/",     "/'\"(?=\w)/"),
			array($dq_open.$sq_open, $sq_open.$dq_open), $_);

		# Special case for decade abbreviations (the '80s):
		$_ = preg_replace("/'(?=\\d{2}s)/", $sq_close, $_);

		$close_class = '[^\ \t\r\n\[\{\(\-]';
		$dec_dashes = '&\#8211;|&\#8212;';

		# Get most opening single quotes:
		$_ = preg_replace("{
			(
				\\s          |   # a whitespace char, or
				&nbsp;      |   # a non-breaking space entity, or
				--          |   # dashes, or
				&[mn]dash;  |   # named dash entities
				$dec_dashes |   # or decimal entities
				&\\#x201[34];    # or hex
			)
			'                   # the quote
			(?=\\w)              # followed by a word character
			}x", '\1'.$sq_open, $_);
		# Single closing quotes:
		$_ = preg_replace("{
			($close_class)?
			'
			(?(1)|          # If $1 captured, then do nothing;
			  (?=\\s | s\\b)  # otherwise, positive lookahead for a whitespace
			)               # char or an 's' at a word ending position. This
							# is a special case to handle something like:
							# \"<i>Custer</i>'s Last Stand.\"
			}xi", '\1'.$sq_close, $_);

		# Any remaining single quotes should be opening ones:
		$_ = str_replace("'", $sq_open, $_);


		# Get most opening double quotes:
		$_ = preg_replace("{
			(
				\\s          |   # a whitespace char, or
				&nbsp;      |   # a non-breaking space entity, or
				--          |   # dashes, or
				&[mn]dash;  |   # named dash entities
				$dec_dashes |   # or decimal entities
				&\\#x201[34];    # or hex
			)
			\"                   # the quote
			(?=\\w)              # followed by a word character
			}x", '\1'.$dq_open, $_);

		# Double closing quotes:
		$_ = preg_replace("{
			($close_class)?
			\"
			(?(1)|(?=\\s))   # If $1 captured, then do nothing;
							   # if not, then make sure the next char is whitespace.
			}x", '\1'.$dq_close, $_);

		# Any remaining quotes should be opening ones.
		$_ = str_replace('"', $dq_open, $_);

		return $_;
	}


	protected function educateBackticks($_) {
	#
	#   Parameter:  String.
	#   Returns:    The string, with ``backticks'' -style double quotes
	#               translated into HTML curly quote entities.
	#
	#   Example input:  ``Isn't this fun?''
	#   Example output: &#8220;Isn't this fun?&#8221;
	#

		$_ = str_replace(array("``", "''",),
						 array($this->backtick_doublequote_open,
							   $this->backtick_doublequote_close), $_);
		return $_;
	}


	protected function educateSingleBackticks($_) {
	#
	#   Parameter:  String.
	#   Returns:    The string, with `backticks' -style single quotes
	#               translated into HTML curly quote entities.
	#
	#   Example input:  `Isn't this fun?'
	#   Example output: &#8216;Isn&#8217;t this fun?&#8217;
	#

		$_ = str_replace(array("`",       "'",),
						 array($this->backtick_singlequote_open,
							   $this->backtick_singlequote_close), $_);
		return $_;
	}


	protected function educateDashes($_) {
	#
	#   Parameter:  String.
	#
	#   Returns:    The string, with each instance of "--" translated to
	#               an em-dash HTML entity.
	#

		$_ = str_replace('--', $this->em_dash, $_);
		return $_;
	}


	protected function educateDashesOldSchool($_) {
	#
	#   Parameter:  String.
	#
	#   Returns:    The string, with each instance of "--" translated to
	#               an en-dash HTML entity, and each "---" translated to
	#               an em-dash HTML entity.
	#

		#                      em              en
		$_ = str_replace(array("---",          "--",),
						 array($this->em_dash, $this->en_dash), $_);
		return $_;
	}


	protected function educateDashesOldSchoolInverted($_) {
	#
	#   Parameter:  String.
	#
	#   Returns:    The string, with each instance of "--" translated to
	#               an em-dash HTML entity, and each "---" translated to
	#               an en-dash HTML entity. Two reasons why: First, unlike the
	#               en- and em-dash syntax supported by
	#               EducateDashesOldSchool(), it's compatible with existing
	#               entries written before SmartyPants 1.1, back when "--" was
	#               only used for em-dashes.  Second, em-dashes are more
	#               common than en-dashes, and so it sort of makes sense that
	#               the shortcut should be shorter to type. (Thanks to Aaron
	#               Swartz for the idea.)
	#

		#                      en              em
		$_ = str_replace(array("---",          "--",),
						 array($this->en_dash, $this->em_dash), $_);
		return $_;
	}


	protected function educateEllipses($_) {
	#
	#   Parameter:  String.
	#   Returns:    The string, with each instance of "..." translated to
	#               an ellipsis HTML entity. Also converts the case where
	#               there are spaces between the dots.
	#
	#   Example input:  Huh...?
	#   Example output: Huh&#8230;?
	#

		$_ = str_replace(array("...",     ". . .",), $this->ellipsis, $_);
		return $_;
	}


	protected function stupefyEntities($_) {
	#
	#   Parameter:  String.
	#   Returns:    The string, with each SmartyPants HTML entity translated to
	#               its ASCII counterpart.
	#
	#   Example input:  &#8220;Hello &#8212; world.&#8221;
	#   Example output: "Hello -- world."
	#

							#  en-dash    em-dash
		$_ = str_replace(array('&#8211;', '&#8212;'),
						 array('-',       '--'), $_);

		# single quote         open       close
		$_ = str_replace(array('&#8216;', '&#8217;'), "'", $_);

		# double quote         open       close
		$_ = str_replace(array('&#8220;', '&#8221;'), '"', $_);

		$_ = str_replace('&#8230;', '...', $_); # ellipsis

		return $_;
	}


	protected function processEscapes($_) {
	#
	#   Parameter:  String.
	#   Returns:    The string, with after processing the following backslash
	#               escape sequences. This is useful if you want to force a "dumb"
	#               quote or other character to appear.
	#
	#               Escape  Value
	#               ------  -----
	#               \\      &#92;
	#               \"      &#34;
	#               \'      &#39;
	#               \.      &#46;
	#               \-      &#45;
	#               \`      &#96;
	#
		$_ = str_replace(
			array('\\\\',  '\"',    "\'",    '\.',    '\-',    '\`'),
			array('&#92;', '&#34;', '&#39;', '&#46;', '&#45;', '&#96;'), $_);

		return $_;
	}


	protected function tokenizeHTML($str) {
	#
	#   Parameter:  String containing HTML markup.
	#   Returns:    An array of the tokens comprising the input
	#               string. Each token is either a tag (possibly with nested,
	#               tags contained therein, such as <a href="<MTFoo>">, or a
	#               run of text between tags. Each element of the array is a
	#               two-element array; the first is either 'tag' or 'text';
	#               the second is the actual value.
	#
	#
	#   Regular expression derived from the _tokenize() subroutine in 
	#   Brad Choate's MTRegex plugin.
	#   <http://www.bradchoate.com/past/mtregex.php>
	#
		$index = 0;
		$tokens = array();

		$match = '(?s:<!--.*?-->)|'.	# comment
				 '(?s:<\?.*?\?>)|'.				# processing instruction
												# regular tags
				 '(?:<[/!$]?[-a-zA-Z0-9:]+\b(?>[^"\'>]+|"[^"]*"|\'[^\']*\')*>)'; 

		$parts = preg_split("{($match)}", $str, -1, PREG_SPLIT_DELIM_CAPTURE);

		foreach ($parts as $part) {
			if (++$index % 2 && $part != '') 
				$tokens[] = array('text', $part);
			else
				$tokens[] = array('tag', $part);
		}
		return $tokens;
	}

}

function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'isOpera';
    elseif (strpos($user_agent, 'Edge')) return 'isEdge';
    elseif (strpos($user_agent, 'Chrome')) return 'isChrome';
    elseif (strpos($user_agent, 'Safari')) return 'isSafari';
    elseif (strpos($user_agent, 'Firefox')) return 'isFirefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'isIE';
    
    return 'isOther';
}

?>