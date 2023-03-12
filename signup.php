<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('connection.php');

$username = $_POST['username'];
$password = $_POST['password'];
$yob = $_POST['yob'];
$category = $_POST['category'];
$email    = $_POST['email'];


if ($category=="Employee"){
    $category=2;
} elseif($category=="Patient"){
    $category=3;
}


$check_username = $mysqli->prepare('select name, email from users where email=?');
$check_username->bind_param('s', $email);
$check_username->execute();
$check_username->store_result();
$username_exists = $check_username->num_rows();

$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$response =array();
if ($username_exists > 0) {
    $response['status'] = "failed";
} else {
    $query = $mysqli->prepare('INSERT INTO `users`(`name`, `email`, `password`, `DOB`, `usertype_id`) values(?,?,?,?,?)');
    $query->bind_param('sssii', $username,$email, $hashed_password,$yob, $category);
    $query->execute();
    $response['status'] = "success";
    // $response['username'] = $username;
    // $response['category'] = $category;
}

// $query2=$mysqli->prepare('select id from users where email=?')
// $query2->bind_param('s', $email);
// $query2->execute();
// $query2->store_result();
// $query2->bind_result($id);
// $query2->fetch();
// $response2 = [];
// $response2['user_id'] = $id;
// echo json_encode("res2 is ". $response2);

echo json_encode($response);
?>