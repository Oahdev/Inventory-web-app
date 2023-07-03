function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function edit(val){
    $("#Pn").val($("#pn-"+val).html());
    $("#QiS").val($("#qt-"+val).html().replace(",",""));
    $("#PpI").val($("#pr-"+val).html().replace(",","").split(" ")[1]);      
    document.getElementById("Er").setAttribute("value",parseInt(val));
    $("#cancel-edit-btn").css("display","block");
    $(".submit-Btn button:first").text("Edit Product");
}

function get_estimate(){
    $.ajax({
        type: "GET",
        url: "./api/get-total-estimate.php",
        success: function (response) {
            var response = JSON.parse(response);
            if(response.status==1){
                $("#total_estimation ul li:first p:nth-child(2)").html(":  <b>"+response.body[0])+"</b>";
                $("#total_estimation ul li:nth-child(2) p:nth-child(2)").html(":  <b>"+response.body[1])+"</b>";
                $("#total_estimation ul li:nth-child(3) p:nth-child(2)").html(":  <b>"+response.body[2])+"</b>";
            }
        }
    });
}
function load_products(){
    $.ajax({
        type: "GET",
        url: "./api/load-table.php",
        success: function (response) {
            var response = JSON.parse(response);
            if(response.status==1){
                $("#table_body").html(response.body);
                get_estimate();
            }
        }
    });
}

function delete_product(val){
    $.ajax({
        type: "POST",
        url: "./api/delete.api.php",
        data:{product_id: val},
        success: function (response) {
            var response = JSON.parse(response);
            if(response.status==1){
                $("#success-response").css({display:"flex"}).fadeIn(400).fadeOut(3000);
                $("#success-response div").html(response.body);
                load_products();
            }else{
                $("#error-response").css({display:"flex"}).fadeIn(400).fadeOut(3000);
                $("#error-response div").html(response.body);
            }
        }
    });
}

$("document").ready(function(){
    
    load_products();

    $("#logoutBtn").on("submit",function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "./api/logout.api.php",
            success: function (response) {
                var response = JSON.parse(response);
                if(response.status==1){
                    //redirect to home page
                    // location.href = "https://oah-inventory.000webhostapp.com/";
                }
            }
        });
    });
    
    $("#add-productForm").on("submit",function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "./api/add-product.api.php",
            data: $(this).serialize(),
            beforeSend: function(){
                $("#addProductBtn").attr("disabled", "");
                $("#cancel-edit-btn").attr("disabled", "");
            },
            success: function (response) {
                var response = JSON.parse(response);
                if(response.status==1){
                    $("#success-response").css({display:"flex"}).fadeIn(400).fadeOut(4000);
                    $("#success-response div").html(response.body);
                    $("#Pn").val("");
                    $("#QiS").val("");
                    $("#PpI").val("");
                    $("#cancel-edit-btn").css("display","none");
                    $(".submit-Btn button:first").text("Add Product");
                    document.getElementById("Er").setAttribute("value","0");
                    load_products();
                }else{
                    $("#error-response").css({display:"flex"}).fadeIn(400).fadeOut(3000);
                    $("#error-response div").html(response.body);
                }
            },
            complete: function(){
                $("#addProductBtn").removeAttr("disabled");
                $("#cancel-edit-btn").removeAttr("disabled");
            },
        });    
    });

    $("#cancel-edit-btn").click(function(){
        $("#Pn").val("");
        $("#QiS").val("");
        $("#PpI").val("");      
        document.getElementById("Er").setAttribute("value","");
        $("#cancel-edit-btn").css("display","none");
        $(".submit-Btn button:first").text("Add Product");
    });

});
