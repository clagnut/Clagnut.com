$(document).ready(
function() {
	// Gallery slider
	$("a.nav.next").click(
		function() {
			var photoWidth = 128;
			var gal = $(".gallery-photos");
			var galWidth = gal.innerWidth();
			var galPos = gal.position();
			var newgalPos = galPos.left - photoWidth;
			$(".gallery-photos").css("left", newgalPos);
			return false;
		}
	)
})