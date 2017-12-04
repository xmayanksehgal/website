$(document).ready(function() {

    $("#login").click(function() {
        var user_data = $(".form_details").serializeArray();
        console.log(user_data);
        $.ajax({
            type: "POST",
            url: "/login",
            data: user_data,
            dataType: "JSON",
            success: function () {
                window.close();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if(jqXHR.status > 100 && jqXHR.status <400)
                {
                    $(window).unload(function() {
                        $.modal.close();
                    });
                    window.location.reload();
                }
            }
        });
    });
    $("#register").click(function() {
        var user_data = $(".form_details").serializeArray();
        console.log(user_data);
        $.ajax({
            type: "POST",
            url: "/register",
            data: user_data,
            dataType: "JSON",
            success: function () {
                window.close();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if(jqXHR.status > 100 && jqXHR.status <400)
                {
                    if(confirm("Check your Emails"))
                    {
                        $(window).unload(function() {
                            $.modal.close();
                        });
                        window.location.reload();
                    }
                    else{
                        $(window).unload(function() {
                            $.modal.close();
                        });
                        window.location.reload();
                    }
                }
            }
        });
    });

});