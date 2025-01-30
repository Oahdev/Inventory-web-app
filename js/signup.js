$("document").ready(function(){
    $("#signupForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "./api/signup.api.php",
            data: $(this).serialize(),
            beforeSend: function(){
                $("#loginBtn").attr("disabled", "");
            },
            success: function (response) {
                $(".form-control").css("border-color","#ced4da");
                $("#ucr").css("border-color","#ced4da");
                $(".mb-3 p").html("");
                var response = JSON.parse(response);
                for(var i in response[2]){
                    $("#"+response[2][i]).css("border-color","red");
                    $("#"+response[2][i]+"-error").html(response[1][i]);
                };
                if(response[0]==1){
                    location.href = "./dashboard.php";
                }
            },
            complete: function(){
                $("#loginBtn").removeAttr("disabled");
            }
        });
    });
})