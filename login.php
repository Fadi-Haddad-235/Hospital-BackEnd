<?php

require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
$secret_key = 'your_secret_key';

include('connection.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = $mysqli->prepare('select * from users where email=?');
$query->bind_param('s', $email);
$query->execute();

$query->store_result();
$num_rows = $query->num_rows();

$query->bind_result($id,$username,$email, $hashed_password,$DOB, $usertype);
$query->fetch();
$response = [];
if ($num_rows == 0) {
    $response['response'] = "user not found";
} else {
    if (password_verify($password, $hashed_password)) {
        $payload = array(
            "user_id" => $id,
            "username" => $username,
            "usertype" => $usertype
        );
        $jwt = JWT::encode($payload, $secret_key,'HS256');
        $response = array(
            "response" => "logged in",
            "user_id" => $id,
            "username" => $username,
            "usertype" => $usertype,
            "jwt" => $jwt
        );
        
    } else {
        $response["response"] = "Incorrect email/password";
    }
}

echo json_encode($response);

?>

