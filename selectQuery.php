<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/patient.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Patient($db);

    $item->patientNo = isset($_GET['patientNo']) ? $_GET['patientNo'] : die();
  
    $item->getPatient();

    if($item->name != null){
        // create array
        $emp_arr = array(
            "patientNo" =>  $item->patientNo,
            "name" => $item->name,
            "mobile" => $item->mobile,
            "age" => $item->age,
            "problem" => $item->problem,
            "checkedOn" => $item->checkedOn
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Patient not found.");
    }
?>