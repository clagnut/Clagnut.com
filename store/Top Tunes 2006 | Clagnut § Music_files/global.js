$(document).ready(
function() {
	// hide stuff
	$('#machine_tags').hide();

	// deal with form controls with 'valueprompt'
	// takes title and makes it the value unless there's already a value set
	$('.valueprompt').attr("value", function() { return this.title });
	$('.valueprompt').focus(
		function() {
			if(this.value == this.title) {
				this.value = "";
			}
		}
	);
	$('.valueprompt').blur(
		function() {
			if(this.value == "") {
				this.value = this.title;
			}
		}
	);
	
	// toggle machine tags
	$('#machine_tags_toggle').mouseover(
		function() {
			$('.arrow').addClass('hover');
		}
	);
	$('#machine_tags_toggle').mouseout(
		function() {
			$('.arrow').removeClass('hover');
		}
	);
	$('#machine_tags_toggle').click(
		function() {
			if($('#machine_tags_toggle .arrow').text() == "▼") {
				$('#machine_tags_toggle .arrow').text('►')
			} else {
				$('#machine_tags_toggle .arrow').text('▼')
			}
			$('#machine_tags').toggle('fast');
			return false;
		}
	);
	
	// swap out more images on hover
	$('img.more').mouseover(
		function() {
			this.src = "/images/more-hover.png";
		}
	);
	$('img.more').mouseout(
		function() {
			this.src = "/images/more.png";
		}
	);
	
});


