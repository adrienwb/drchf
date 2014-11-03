// jQuery to collapse the navbar on scroll
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});

$(function() {
    if(typeof $.cookie('notifyme') !== 'undefined'){
        $('#notifyme_form').remove();
    }

    var opts = {
        language: "fr",
        pathPrefix: "/assets/lang"
    };
    $("[data-localize]").localize("home", opts);

    $('#to-fr').on('click', function() {
        var opts = {
            language: "fr",
            pathPrefix: "/assets/lang"
        };
        $("[data-localize]").localize("home", opts);
        //return false;
    });

    $('#to-en').on('click', function() {
        var opts = {
            language: "en",
            pathPrefix: "/assets/lang"
        };
        $("[data-localize]").localize("home", opts);
        //return false;
    });


    $('#notifyme').on('click', function() {
        var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!regex.test($('#notifyme_email').val())) {
            return false;
        }
        var $btn = $(this).button('loading');
        $.get( "/ajax", { m: "notify",email:$('#notifyme_email').val() }, function( data ) {
            console.log( data ); // John
            if(data.status == 'success'){
                $('#notifyme_form').text(data.message);
                $.cookie('notifyme', '1', { expires: 7, path: '/' });
            }
        }, "json");

    });

})