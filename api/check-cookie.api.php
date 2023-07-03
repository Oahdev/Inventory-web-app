<?php
require "./contoller/config.php";
if(isset($_COOKIE["token"])){
    $cookie_token = substr_replace($_COOKIE["token"], '', 14, 1);
    if(DB::query("SELECT session_token FROM users WHERE session_token = :sess_token",array(":sess_token"=>$cookie_token))){
        $user_details = DB::query("SELECT business_name,user_id,user_currency FROM users WHERE session_token = :sess_token",array(":sess_token"=>$cookie_token));
        $uid = $user_details[0]["user_id"];
        $business_name = $user_details[0]["business_name"];
        $user_currency  = $user_details[0]["user_currency"];
        session_start();
        $_SESSION["uid"] = $uid; 
    }else{
        header("location: ./");
    }
}else{
    header("location: ./");
}




?>