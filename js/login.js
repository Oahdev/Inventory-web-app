$("document").ready(function(){
    $("#loginForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "./api/login.api.php",
            data: $(this).serialize(),
            beforeSend: function(){
                $("#loginBtn").attr("disabled", "");
            },
            success: function (response) {
                var response = JSON.parse(response);
                if(response.status==1){
                    $(".form-control").css("border-color","#ced4da");
                    $("#error-response").css({display:"none"});
                    $("#success-response").css({display:"flex"});
                    $("#success-response div").html(response.body);
                    location.href = "./dashboard.php";
                }else{
                    $("#email").css("border-color","red");
                    $("#pwd").css("border-color","red");
                    $("#success-response").css({display:"none"});
                    $("#error-response").css({display:"flex"});
                    $("#error-response div").html(response.body);
                }
            },
            complete: function(){
                $("#loginBtn").removeAttr("disabled");;
            }
        });

    });
})