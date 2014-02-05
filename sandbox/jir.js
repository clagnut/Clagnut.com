/* 
JavaScript enhancement to image replacement
See clagnut.com/sandbox/js-enhanced-IR/ for an explanation
*/

function checkImages() {
	if (document.getElementById) {
		var x = document.getElementById('logoimg').offsetWidth;
		if (x != '134') {
			document.getElementById('heading').style.textIndent = "0";
		}
	}
}

window.onload = checkImages;