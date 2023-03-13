<?php
include ("connection.php");

$patientId = $_POST['patientId'];
$hospitalId = $_POST['hospitalId'];

  $query = $mysqli->prepare("UPDATE hospital_users SET hospital_id = ? WHERE user_id = ?");
  $query->bind_param('ii', $hospitalId,$patientId );
  $result = $query->execute();


?>
