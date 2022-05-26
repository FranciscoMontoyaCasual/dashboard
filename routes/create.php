<?php
include "/../test/db.php";

$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST"){
    $auth_header = getallheaders()['Authorization'];
    $body = json_decode(file_get_contents('php://input'), true);

    $result = validate_request_information($auth_header, $body);

    if($result)
        echo "Works!";
}else
    header('Location: /');
    
function validate_request_information($auth_header, $body){
    $body_fields = ["request_id", "service_type", "area", "area_manager", 
                    "user_name", "request_date", "phone", "email", 
                    "category", "service_subtype", "description"];
    $idx = 0;
    $token = explode(" ", $auth_header)[1];

    $db = DB::connect_db();
    $result = DB::auth_api_user($db, $token);

    foreach($result as $row)
        if($row['res'] != 1)
            return false;

    if(sizeof($body) != sizeof($body_fields))
        return false;

    foreach($body as $name => $value){
        if($body_fields[$idx] == $name && isset($value) && $value != "")
            echo "";
        else
            return false; 
        $idx = $idx + 1;
    }

    DB::insert_new_request($db, $body['request_id'], $body['service_type'], $body['area'], 
    $body['area_manager'], $body['user_name'], $body['request_date'], $body['phone'], 
    $body['email'], $body['category'], $body['service_subtype'], $body['description']);

    return true;
}
?>