<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

// $x = $_POST['user_id'];
$user_id=5;
$query = $mysqli->prepare('SELECT user_services.user_id, users.name, user_services.service_id, services.description, user_services.done FROM user_services JOIN services ON user_services.service_id = services.id JOIN users ON user_services.user_id = users.id WHERE user_services.user_id = ?');
$query->bind_param('i', $user_id);
$query->execute();
$query->store_result();
$num_rows = $query->num_rows();
$query->bind_result($user_id, $name, $service_id, $service_name, $done);

$response = [];
if ($num_rows > 0) {
    while ($query->fetch()) {
        $services = [
          'user_id' => $user_id,
          'name' => $name,
          'service_id' => $service_id,
          'service_name' => $service_name,
          'done' => $done,
        ];
        array_push($response, $services);
    }
}
echo json_encode($response);
?>
