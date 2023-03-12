<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   $patientId = $_POST['patientId'];
  
  $query = $mysqli->prepare('SELECT us.user_id, u.name, us.service_id, s.description, us.done FROM user_services us INNER JOIN users u ON us.user_id = u.id INNER JOIN services s ON us.service_id = s.id WHERE us.user_id = ?');
  $query->bind_param('i', $patientId);
  $query->execute();
  $query->store_result();
  $num_rows = $query->num_rows();
  $query->bind_result($userId, $name, $serviceId, $serviceDescription, $done);

  $services = [];
  if ($num_rows > 0) {
    while ($query->fetch()) {
      $service = [
        'userId' => $userId,
        'name' => $name,
        'serviceId' => $serviceId,
        'serviceDescription' => $serviceDescription,
        'done' => $done,
      ];
      array_push($services, $service);
    }
  }
  
  echo json_encode($services);
}
?>
