<?php
require "../contoller/config.php";
$response = [];
$status = false;
$marker = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(
        isset($_POST["email"]) &&
        isset($_POST["business_name"]) &&
        isset($_POST["pwd"]) &&
        isset($_POST["user_currency"]) &&
        isset($_POST["conpwd"])
    ){
        $token = password_hash("8b-S+shsjbsbns;aarQsbhsgkslsbjbs5v\F24mGFRyxCx#h",PASSWORD_DEFAULT);
        $business_name = $_POST["business_name"];
        $user_currency = $_POST["user_currency"];
        $email = $_POST["email"];
        $newPwd = $_POST["pwd"];
        $conPwd = $_POST["conpwd"];

        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            if(!(DB::query("SELECT email FROM users WHERE email = :email",array(":email"=>$email)))){
                @$email_token = $token;
            }else{
                array_push($response,"<b>$email</b> is already registered");
                array_push($marker,"email");
            }
        }else{
            array_push($response,"<b>$email</b> is not a valid email");
            array_push($marker,"email");
        }
        
        if(strlen($newPwd) >= 8){
            if($newPwd === $conPwd){
                @$pwd_token = $token;
                $newPwd = password_hash($newPwd,PASSWORD_DEFAULT);
            }else{
                array_push($response,"password mismatch");
                array_push($marker,"conPassword");
            }
        }else{
            array_push($marker,"Password");
            array_push($response,"mininum of 8 characters");
        }
        
        if($user_currency == "$" || $user_currency == "¥" ||$user_currency == "₦" || $user_currency == "£" || $user_currency == "€"){
            @$currency_token = $token;
        }else{
            array_push($marker,"ucr");
            array_push($response,"select a currency symbol");
        }

        if((@$email_token && @$pwd_token && @$currency_token) == $token){
            DB::query("INSERT INTO users(business_name,email,user_currency,pwd,session_token,date_created) VALUES(
                :business_name,
                :email,
                :user_currency,
                :pwd,
                :session_token,
                NOW()
            )",array(
                ":business_name"=>$business_name,
                ":email"=>$email,
                ":user_currency"=>$user_currency,
                ":pwd"=>$newPwd,
                ":session_token"=>$token
            ));
            $num = rand(0,9);
            $new_token = substr($token,0,14).$num.substr($token,14);
            setcookie("token",$new_token,time()+3600*24*30,"/");
            $status = true;
            $response = "Registration successful";
        }

    }else{
        $status = false;
        $response = "requied field missing";
    }
}else{
    $status = false;
    $response = "invalid request method";
}

$response = [$status,$response,$marker];
echo json_encode($response);
?>