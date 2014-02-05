// Dynamically change layout based on window sized
// Based on work by Simon Collison et al
// http://www.collylogic.com/?/comments/redesign-notes-1-width-based-layout/


wraphandler = {
  init: function() {
    if (!document.getElementById) return;
    // set up the appropriate wrapper
    wraphandler.setWrapper();
    // and make sure it gets set up again if you resize the window
    wraphandler.addEvent(window,"resize",wraphandler.setWrapper);
  },

  setWrapper: function() {
    // width stuff from ppk's
http://www.evolt.org/article/document_body_doctype_switching_and_more/17/30655/index.html
    var theWidth = 0;
    if (window.innerWidth) {
	theWidth = window.innerWidth
    } else if (document.documentElement &&
                document.documentElement.clientWidth) {
	theWidth = document.documentElement.clientWidth
    } else if (document.body) {
	theWidth = document.body.clientWidth
    }
    if (theWidth != 0) {
      if (theWidth < 600) {
        document.getElementById('wrapper').className = 'layout-default';
      } else if (theWidth < 800) {
        document.getElementById('wrapper').className = 'layout-medium1';
      } else if (theWidth < 1000) {
        document.getElementById('wrapper').className = 'layout-medium2';
      } else {
        document.getElementById('wrapper').className = 'layout-widest';
      }
    }
  },

  addEvent: function( obj, type, fn ) {
    if ( obj.attachEvent ) {
      obj['e'+type+fn] = fn;
      obj[type+fn] = function(){obj['e'+type+fn]( window.event );}
      obj.attachEvent( 'on'+type, obj[type+fn] );
    } else {
      obj.addEventListener( type, fn, false );
    }
  }
}

wraphandler.addEvent(window,"load",wraphandler.init);
