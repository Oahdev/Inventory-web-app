<?php

require "../contoller/config.php";

$response = [];

if($_SERVER["REQUEST_METHOD"] == "GET"){
    function user_data(){
        session_start();
        $uid = $_SESSION["uid"];
        $user_currency = (DB::query("SELECT user_currency FROM users WHERE user_id = :uid",array(":uid"=>$uid)))[0]["user_currency"];
        $user_products = DB::query("SELECT * FROM products WHERE user_id = :uid ORDER BY product_id DESC",array(":uid"=>$uid));
        $user_rows = "";
        if(count($user_products)>0){
            foreach ($user_products as $key => $value) {
                $user_rows .= '
                    <tr id="'.$value["product_id"].'">
                    <td id="pn-'.$value["product_id"].'">'.$value["product_name"].'</td>
                    <td id="qt-'.$value["product_id"].'">'.number_format($value["quantity"]).'</td>
                    <td id="pr-'.$value["product_id"].'">'.$user_currency.' '.number_format($value["price"],2).'</td>
                    <td>'.$user_currency.' '.number_format($value["total"],2).'</td>
                    <td onclick=edit("'.$value["product_id"].'")><img id="editBtn" src="./images/pen.png"></td>
                    <td onclick=delete_product("'.$value["product_id"].'")><img id="deleteBtn" src="./images/delete-icon.png"></td>
                    </tr>
                ';
            }
        }else{
            $user_rows = "<p id='no-product-msg'>No products found</p>";
        }
        return $user_rows;
    }
    
    $response["status"] = true;
    $response["body"] = user_data();
}else{
    $response["status"] = false;
    $response["body"] = "invalid request method";
}

echo json_encode($response);
?>