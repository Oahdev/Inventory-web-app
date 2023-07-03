<?php

require "../contoller/config.php";
$response = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(
        isset($_POST["login_email"]) &&
        isset($_POST["login_password"])
    ){
        $token = password_hash("h#xCxyRFGmyugsgfkaewnuiy7t87m4smsk2F\v5qN8Qrh5+S-b8",PASSWORD_DEFAULT);
        $login_email = $_POST["login_email"];
        $login_pwd = $_POST["login_password"];

        @$check_db_email = (DB::query("SELECT email FROM users WHERE email = :email",array(":email"=>$login_email)))[0]["email"];
        @$check_db_pwd = (DB::query("SELECT pwd FROM users WHERE email = :email",array(":email"=>$login_email)))[0]["pwd"];

        if($login_email == $check_db_email){
            @$email_token = $token;
        }
        if(password_verify($login_pwd,$check_db_pwd)){
            @$pwd_token = $token;
        }

        if((@$email_token && @$pwd_token) == $token){
            $response["status"] = true;
            $response["body"] = "login successful";
            $user_token = DB::query("SELECT session_token from users WHERE email = :email",array(":email"=>$login_email))[0]["session_token"];
            $num = rand(0,9);
            $new_token = substr($user_token,0,14).$num.substr($user_token,14);
            setcookie("token",$new_token,time()+3600*24*30,"/");
        }else{
            $response["status"] = false;
            $response["body"] = "invalid details";
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