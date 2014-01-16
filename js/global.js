$(document).ready(
function() {
	
	$("#menutoggle").click(
		function(e) {
			$("#menutoggle, nav#global").toggleClass("active");
			e.preventDefault();
		}
	)
})

