<?php
include __DIR__."/../test/db.php";

if(isset($_POST['request_id'])){
    $temp = [];
    $db = DB::connect_db();
    $result = DB::get_request_by_id($db, $_POST['request_id']);
    
    foreach($result as $row){
        $temp['area'] = $row['area'];
        $temp['user_name'] = $row['user_name'];
        $temp['request_date'] = $row['request_date'];
        $temp['phone'] = $row['phone'];
        $temp['email'] = $row['email'];
        $temp['service_subtype'] = $row['service_subtype'];
        $temp['res_des'] = $row['res_des'];
    }

    header('Content-Type: application/json');
    echo json_encode($temp);
    exit;
}
?>