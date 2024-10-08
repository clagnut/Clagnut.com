<footer class="global wrapper">
<p class="copyright">© 2002–<?php echo date('Y'); ?> <a href="/about">Richard&nbsp;Rutter</a></p>
<p class="icons">
<a href="https://mastodon.social/@Richr" class="icon"><img src="/i/icon-mastodon-white.svg" alt="Follow me on Mastodon" title="@mastodon.social@Richr"></a>
<a href="http://twitter.com/clagnut" class="icon"><img src="/i/icon-twitter-white.svg" alt="Follow me on Twitter" title="@clagnut"></a>
<a href="/feeds/fullposts.xml" class="icon"><img src="/i/icon-rss.svg" alt="RSS Feed" title="RSS Feed"></a>
</p>
<nav class="colophon">Published in Brighton, UK · <a href="/colophon">Colophon</a></nav>
</footer>

<script defer="defer" src="/js/prism.js"></script>
<script defer="defer" src="/js/code-block.js"></script>
<script defer="defer" src="/js/global.js"></script>
<script>
// frame-busting after the fact
if (window.location !== window.parent.location) {
	var links = document.getElementsByTagName('a');
	for (link of links) {
		link.setAttribute("target", "_top");
	}
}
</script>
