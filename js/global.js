$(document).ready(
function() {
	// Gallery slider
	
	
	gal = $(".gallery-photos");
	figCount = $(".gallery-photos figure").length;
	figWidth = $(".gallery-photos figure").outerWidth();
	figWidthMar = $(".gallery-photos figure:last").outerWidth(true);
	galWidth = (figCount*figWidthMar)-figWidthMar+figWidth;
	gal.innerWidth(galWidth);
	var viewWidth = $(".gallery").innerWidth();
	
	$('a.nav.prev').hide();
	if (galWidth <= viewWidth ) {
		$('a.nav.next').hide();
	}
	$("a.nav.next").click(
		function() {
			return slide("next");
		}
	)
	$("a.nav.prev").click(
		function() {
			return slide("prev");
		}
	)
})

// Gallery slider
function slide(dir) {
	var viewWidth = $(".gallery").innerWidth();
	var galPos = gal.position();
	if (dir=="next") {
		var newgalPos = galPos.left - figWidth;
		if (newgalPos-viewWidth <= (-1 * galWidth)) {
			newgalPos = viewWidth-galWidth;
			$('a.nav.next').hide();
		} else {
			$('a.nav.prev').show();
		}
	}
	if (dir=="prev") {
		var newgalPos = galPos.left + figWidth;
		if (newgalPos >= 0) {
			newgalPos = 0;
			$('a.nav.prev').hide();
		} else {
			$('a.nav.next').show();
		}
	}
	$(".gallery-photos").css("left", newgalPos);
	return false;

}