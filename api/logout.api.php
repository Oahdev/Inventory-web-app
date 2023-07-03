<?php
$response = [];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    setcookie("token",false,time()-3600,"/");
    $response["status"] = true;
}
echo json_encode($response);
?>