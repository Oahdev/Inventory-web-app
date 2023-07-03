$("document").ready(function(){
    $("#reportForm").on("submit",function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "./api/report-issue.api.php",
            data: $(this).serialize(),
            beforeSend: function(){
                $("#reportBtn").attr("disabled", "");
            },
            success: function (response) {
                var response = JSON.parse(response);
                if(response.status==1){
                    $("#success-response").css({display:"flex"}).fadeIn(400).fadeOut(10000);
                    $("#success-response div").html(response.body);
                    $("#email").val("");
                    $("#issue").val("");
                }else{
                    $("#error-response").css({display:"flex"}).fadeIn(400).fadeOut(3000);
                    $("#error-response div").html(response.body);
                }
            },
            complete: function(){
                $("#reportBtn").removeAttr("disabled");
            },
        });
    })

    $("#exit").on("click",function(){
        window.history.back();
    })
})