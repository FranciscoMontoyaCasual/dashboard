<?php
include __DIR__."/../test/db.php";

if(isset($_POST['request_id']) && isset($_POST['last_status']) && isset($_POST['new_status'])){
    $db = DB::connect_db();
    $new_status = $_POST['new_status'];
    $last_status = $_POST['last_status'];
    $temp = [];

    if($last_status == 'Recibida' && ($new_status == 'Trabajando' || $new_status == 'Detenida')){
        DB::change_request_status($db, $_POST['request_id'], $new_status, $_POST['comment']);
        $temp['status'] = true;
        header('Content-Type: application/json');
        echo json_encode($temp);
        exit;
    }else if($last_status == 'Trabajando' && ($new_status == 'Detenida' || $new_status == 'Completada')){
        DB::change_request_status($db, $_POST['request_id'], $new_status, $_POST['comment']);
        $temp['status'] = true;
        header('Content-Type: application/json');
        echo json_encode($temp);
        exit;
    }

    $temp['status'] = false;
    header('Content-Type: application/json');
    echo json_encode($temp);

    exit;
}

?>