<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include ("connection.php");

$query = $mysqli->prepare('select id, name from users where usertype_id = 3');
$query->execute();
$query->store_result();
$num_rows = $query->num_rows();
$query->bind_result($id,$name);

$response = [];
if ($num_rows > 0) {
    while ($query->fetch()) {
      $hospital = [
        'id' => $id,
        'name' => $name,
      ];
      array_push($response, $hospital);
    }
  }
  echo json_encode($response);
  ?>