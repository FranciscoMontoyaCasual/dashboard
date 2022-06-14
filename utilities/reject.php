<?php
include __DIR__."/../test/db.php";
require __DIR__.'/../vendor/autoload.php';
use GuzzleHttp\Client;

if(isset($_POST['request_id']) && isset($_POST['comment'])){
    $request_id = $_POST['request_id'];
    $comment = $_POST['comment'];

    $db = DB::connect_db();
    DB::reject_request($db, $request_id, $comment);

    $client = new GuzzleHttp\Client();

    $url = "https://script.google.com/macros/s/AKfycbw7Ci9qrAqMS8yBgrPhWnoGNONVjx34-znJ6PF2naiGpH4D4cSkpdxinwzVMpx6MhqS/exec";

    $request = $client->post($url, [
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode([
            'status' => 'R',
            'request_id' => $request_id,
            'send_to' => 'admrecurso@acatlan.unam.mx',
            'comment' => $comment
        ])
    ]);

    $response = $request->getBody();

    return $response;
}
?>