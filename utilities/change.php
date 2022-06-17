<?php
include __DIR__."/../test/db.php";
require __DIR__.'/../vendor/autoload.php';
use GuzzleHttp\Client;

if(isset($_POST['request_id']) && isset($_POST['last_status']) && isset($_POST['new_status'])){
    $db = DB::connect_db();
    $url = "https://script.google.com/macros/s/AKfycbxPxAHMoeGCkr2tU9ZUtjPvMasDbFG4WYYskgmcpi896hwv7MFTQadS3L_LgRWYbTKZ/exec";
    $request_id = $_POST['request_id'];
    $comment = $_POST['comment'];
    $new_status = $_POST['new_status'];
    $last_status = $_POST['last_status'];
    $temp = [];

    if($last_status == 'Recibida' && ($new_status == 'Trabajando' || $new_status == 'Detenida')){
        DB::change_request_status($db, $_POST['request_id'], $new_status, $_POST['comment']);
        $temp['status'] = true;

        if($new_status == 'Detenida'){
            $client = new GuzzleHttp\Client();

            $request = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                    'status' => 'D',
                    'request_id' => $request_id,
                    'send_to' => 'franciscomontoyacasual@gmail.com',
                    'comment' => $comment
                ])
            ]);
        }

        header('Content-Type: application/json');
        echo json_encode($temp);
        exit;
    }else if($last_status == 'Trabajando' && ($new_status == 'Detenida' || $new_status == 'Completada')){
        DB::change_request_status($db, $_POST['request_id'], $new_status, $_POST['comment']);
        $temp['status'] = true;

        if($new_status == 'Detenida'){
            $client = new GuzzleHttp\Client();
                
            $request = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                    'status' => 'D',
                    'request_id' => $request_id,
                    'send_to' => 'franciscomontoyacasual@gmail.com',
                    'comment' => $comment
                ])
            ]);
        }

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