<?php
include ("connection.php");

$patient_id=$_POST['patient_id'];
$service_id=$_POST['service_id'];
$status=$_POST['status'];
echo $status;
if($status=="agreed"){
        $query = $mysqli->prepare("UPDATE `user_services` SET `done`='1' WHERE `user_id`='?' and `service_id`='?'");
        $query->bind_param('ii',$patient_id ,$service_id);
        $result = $query->execute();

        if ($result) {
            echo json_encode(['message' => 'Patient assigned to hospital']);
        } 
        else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to assign patient to hospital']);
        }   
        }
elseif($status=="declined"){
    $query = $mysqli->prepare("UPDATE `user_services` SET `done`='0' WHERE `user_id`='?' and `service_id`='?'");
    $query->bind_param('ii',$patient_id ,$service_id);
    $result = $query->execute();

    if ($result) {
        echo json_encode(['message' => 'Patient denied service']);
    } 
    else {
        http_response_code(500);
        echo json_encode(['message' => 'Operation Failed']);
    }   
    }

?>