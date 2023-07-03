<?php
require "../contoller/config.php";
$response = [];
if($_SERVER["REQUEST_METHOD"] == "GET"){
    session_start();
    $uid = $_SESSION["uid"];
    // $uid = "1";
    $user_currency = (DB::query("SELECT user_currency FROM users WHERE user_id = :uid",array(":uid"=>$uid)))[0]["user_currency"];
    $total_cost_in_inventory_db = DB::query("SELECT SUM(total) as total_inventory_cost FROM products WHERE user_id = :uid",array(":uid"=>$uid));
    $total_products_in_inventory_db = DB::query("SELECT SUM(quantity) as total_inventory_quantity FROM products WHERE user_id = :uid",array(":uid"=>$uid));
    $total_items_in_inventory = number_format(count(DB::query("SELECT * FROM products WHERE user_id = :uid",array(":uid"=>$uid))));
    if($total_cost_in_inventory_db[0]["total_inventory_cost"] != null){
        $total_cost_in_inventory =  $user_currency." ".number_format($total_cost_in_inventory_db[0]["total_inventory_cost"],2);
    }else{
        $total_cost_in_inventory = "$user_currency 0";
    }
    if($total_products_in_inventory_db[0]["total_inventory_quantity"] != null){
        
        $total_products_in_inventory = number_format($total_products_in_inventory_db[0]["total_inventory_quantity"]);
    }else{
        $total_products_in_inventory = "0";
    }
    $response["status"] = true;
    $response["body"] = [$total_items_in_inventory,$total_products_in_inventory,$total_cost_in_inventory];
}else{
    $response["status"] = false;
    $response["body"] = "invalid request method";
}
echo json_encode($response);
?>