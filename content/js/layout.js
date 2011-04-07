(function ($)
    {
        $(function ()
        {
            // DOM READY
            //function for centering popup
            function centerPopup(){
                //request data for centering
                var windowWidth = document.documentElement.clientWidth;
                var windowHeight = document.documentElement.clientHeight;
                var popupHeight = $(".message-box").height();
                var popupWidth = $(".message-box").width();
                //centering
                $(".message-box").css({
                    "position": "absolute",
                    "left": windowWidth/2-popupWidth/2
                });
            }

            //call the centering function
            centerPopup();

            //check if there is a message and display it if so
            if(!status == ""){
                $('.message-box').append("<h1>" + status + "</h1>").fadeIn(500).delay(2000).fadeOut(500);
            }
        });

    })(jQuery);