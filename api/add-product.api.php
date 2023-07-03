<?php

require "../contoller/config.php";

$response = [];
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(
        !(empty($_POST["productName"])) &&
        isset($_POST["QuantityInStock"]) &&
        isset($_POST["PricePerItem"]) &&
        isset($_SESSION["uid"])
    ){
        $uid = $_SESSION["uid"];
        $product_name = $_POST["productName"];
        $quantity_in_stock = intval($_POST["QuantityInStock"]);
        $price_per_item = number_format(floatval($_POST["PricePerItem"]),2,".","");
        $total_value_number = ($quantity_in_stock * $price_per_item);
        $total_value_number = number_format(floatval($total_value_number),2,".","");
        $check_uid = DB::query("SELECT user_id FROM users WHERE user_id = :user_id",array(":user_id"=>$uid));
        if($check_uid){
            #check for edit
            if($_POST["editRow"] > 0){
                $product_id = $_POST["editRow"];
                $check_product_id = DB::query("SELECT product_id FROM products WHERE user_id = :user_id AND product_id = :product_id",array(":user_id"=>$uid,":product_id"=>$product_id));
                if($check_product_id){
                    DB::query("UPDATE products SET
                        product_name = :product_name,
                        quantity = :quantity,
                        price = :price,
                        total = :total,
                        date_updated = NOW()
                    WHERE product_id = :product_id AND user_id = :user_id",array(
                        ":product_id"=>$product_id,
                        ":user_id"=>$uid,
                        ":product_name"=>$product_name,
                        ":quantity"=>$quantity_in_stock,
                        ":price"=>$price_per_item,
                        ":total"=>$total_value_number
                    ));
                    $response["status"] = true;
                    $response["body"] = "product edited succesfully";
                }else{
                    $response["status"] = false;
                    $response["body"] = "edit product not found";
                }
            }else{
                DB::query("INSERT INTO products(user_id,product_name,quantity,price,total,date_updated) VALUES(
                    :user_id,
                    :product_name,
                    :quantity,
                    :price,
                    :total,
                    NOW()
                )",array(
                    ":user_id"=>$uid,
                    ":product_name"=>$product_name,
                    ":quantity"=>$quantity_in_stock,
                    ":price"=>$price_per_item,
                    ":total"=>$total_value_number
                ));
                $response["status"] = true;
                $response["body"] = "product added succesfully";   
            }
        }else{
            $response["status"] = false;
            $response["body"] = "user not found";
        }
    }else{
        $response["status"] = false;
        $response["body"] = "required field missing";
    }
}else{
    $response["status"] = false;
    $response["body"] = "invalid request method";
}

echo json_encode($response);

?>