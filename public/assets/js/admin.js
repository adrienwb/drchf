$(function() {

    api.init();

    $('#side-menu').metisMenu();

    $( "#signin" ).submit(function( event ) {
        $.post( "/admind/login", { email: $("#login_email").val(), password: $("#login_password").val() }, function( data ) {
            if(data.status == 'success') window.location = '/admind';
        },'json');
        event.preventDefault();
    });

    $(".menu-link").on("click",function(){
        var module = $(this).data('link');
        var template = '/admind/pages?module='+module;
        $( "#page-wrapper" ).load( template, function() {
            //console.log( module + " was loaded." );
        });
    });

    $(".active").trigger('click');

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    })
})
