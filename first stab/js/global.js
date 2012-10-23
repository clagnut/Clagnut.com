// Bespoke functions here

$(document).ready(
function() {

    $('body').polypage();

    // Movie info popup
    $('.moviepopup').hide();
    $(".movies>li, .movies td").hover(
        function(e) {
          $(this).find('.moviepopup').delay(500).fadeIn(100);
        },
        function(e) {
          $(this).find('.moviepopup').clearQueue().hide();
        }

    )

    // Progressive disclosure sign up form
    $('#player, #player2, #platform, #email_signup, #facebook_connected, #facebook_connect').hide();
    // $('#player, #platform, #email_signup, #facebook_connected').hide();


    $("#medium_player, #medium_platform").live('click', function(e) {
        $('#player, #player2, #platform').hide();
        var choice = $(this).val();
        $("fieldset#"+choice).fadeToggle(500);

        $('label[for^="medium_"]').addClass('dim');
        $('label[for^="medium_'+choice+'"]').removeClass('dim');
    })


    $("#to_email, #to_facebook").live('click', function(e) {
        $('#facebook_signup, #email_signup').toggle();
        e.preventDefault();
    })

    $("#submit_email").live('click', function(e) {
        $('#player').hide();
        $('#player2').show();
        e.preventDefault();
    })

    $("#go_to_facebook").live('click', function(e) {
        $('#facebook_connect').fadeIn(500);
        e.preventDefault();
    })

    $(".section-signup .sign_up_using_facebook").live('click', function(e) {
        $('#player, #facebook_connect').hide();
        $('#player2, #facebook_connected').fadeIn(500);
        e.preventDefault();
    })

    $("form#signup, form#signin").submit(
        function() {
            $('body').trigger('pp_setState', { Signed_in:true });
        }
    );

    $(".section-signin .sign_up_using_facebook").click(
        function() {
            $('body').trigger('pp_setState', { Signed_in:true });
        }
    );

    // Progressive disclosure on How to Get It

    $('.device div').hide();
    $(".device h4 a").live('click', function(e) {
        href = $(this).attr('href');
        $(href).slideToggle(300);
        e.preventDefault();
    })

    // When logging out change polypage state to not signed in and just signed out status to true so that confirmation message can be displayed

    $("form#signout").submit(
        function() {
            $('body').trigger('pp_setState', { Signed_in:false, Just_signedout:true });
        }
    );

    // Operate tabs on Account page

    $(".tabs li a").live('click', function(e) {
        $(".panes .confirmation").hide();
        var href = $(this).attr('href');
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
        $(".pane").addClass("closed");
        $(href).removeClass("closed");
        e.preventDefault();
    })

    // Deal with confirmations on Account changes

    $(".panes .confirmation").hide();

    $(".pane form").on("submit", function(event) {
        var pane = $(this).attr('action');
        if (pane != "cancel-confirmed") {
			var confirm = pane +" .confirmation";
			$(confirm).fadeIn(500);
			event.preventDefault();
		} else {
			$('body').trigger('pp_setState', { Signed_in:false });
		}
    });

    // Deal with competition entry

    $(".section-competition .pp_not_Entry_confirmation form").on("submit", function(event) {
		$('body').trigger('pp_setState', { Entry_confirmation:true });
        event.preventDefault();
    });


});

