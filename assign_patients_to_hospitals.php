<?php
include ("connection.php");

$patientId = $_POST['patientId'];
$hospitalId = $_POST['hospitalId'];

  $query = $mysqli->prepare("UPDATE hospital_users SET hospital_id = ? WHERE user_id = ?");
  $query->bind_param('ii', $hospitalId,$patientId );
  $result = $query->execute();

  if ($result) {
    echo json_encode(['message' => 'Patient assigned to hospital']);
  } 
  else {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to assign patient to hospital']);
  }
?>
