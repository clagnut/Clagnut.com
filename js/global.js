function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

/* Generate a share link for the user's Mastodon domain */
function MastodonShare(e){

    // Get the source text
    src = e.target.getAttribute("data-src");
	
	// see if a domain has been saved as a cookie
	var cookieMastDom = readCookie("mastdom");
	var mastdom = cookieMastDom ? cookieMastDom : "mastodon.social";

    // Get the Mastodon domain
    var domain = prompt("Enter your Mastodon domain", mastdom);

    if (domain == "" || domain == null){
		e.preventDefault();
		return false;
    }
	
	// save domain as a cookie
	createCookie("mastdom",domain,365);

    // Build the URL
    var url = "https://" + domain + "/share?" + src;

    // Open a window on the share page
    window.open(url, '_top');
	e.preventDefault();
	return false;
}
function enableMastodonShare(){
    var eles = document.getElementsByClassName('commentonmastodon');
    for (var i=0; i<eles.length; i++){
        eles[i].addEventListener('click', MastodonShare);
    }
}

document.addEventListener('DOMContentLoaded', function(){
	enableMastodonShare();	
})