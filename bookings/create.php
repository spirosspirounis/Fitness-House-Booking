<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/bookings.php';
 
$database = new Database();
$db = $database->getConnection();
 
$items = new Books($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->class) && !empty($data->date) &&
!empty($data->time) && !empty($data->username) && !empty($data->email) && !empty($data->phone_number)){    

    $items->class = $data->class;
    $items->date = $data->date;
    $items->time = $data->time;
    $items->username = $data->username;
    $items->email = $data->email;
    $items->phone_number = $data->phone_number;
    
    if($items->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Item was created."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create item."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
}
?>