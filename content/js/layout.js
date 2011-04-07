(function ($)
    {
        $(function ()
        {
            // DOM READY

            // Display status message if set
            if(status != "")
            {
                $('.message-box').append("<h1>" + status + "</h1>").fadeIn(500).delay(2000).fadeOut(500);
            }
        });

    })(jQuery);