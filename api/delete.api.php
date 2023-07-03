<?php 


require "../contoller/config.php";
$response = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    if(
        isset($_POST["product_id"]) &&
        isset($_SESSION["uid"])
    ){  
        $uid = $_SESSION["uid"];
        $product_id = $_POST["product_id"];
        $check_uid = DB::query("SELECT user_id FROM users WHERE user_id = :user_id",array(":user_id"=>$uid));
        $check_product_id = DB::query("SELECT product_id FROM products WHERE product_id = :product_id AND user_id = :user_id",array(":user_id"=>$uid,":product_id"=>$product_id));
        if($check_uid){
            if($check_product_id){
                DB::query("DELETE FROM products WHERE product_id = :product_id AND user_id = :user_id",array(":user_id"=>$uid,":product_id"=>$product_id));
                $response["status"] = true;
                $response["body"] = "product deleted successfully";
            }else{
                $response["status"] = false;
                $response["body"] = "product not found";
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