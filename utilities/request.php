<?php
include __DIR__."/../test/db.php";
require __DIR__.'/../vendor/autoload.php';
use GuzzleHttp\Client;

if(isset($_POST['request_id']) && isset($_POST['area_id']) && isset($_POST['comment'])){
    $db = DB::connect_db();
    DB::assign_request($db, $_POST['request_id'], $_POST['area_id'], $_POST['comment']);
    $result = DB::get_request($db, $_POST['request_id']);

    $client = new GuzzleHttp\Client();

    $url = "https://script.google.com/macros/s/AKfycbwQS_ZCFAOeuGT-cMGItfNQslNVD87WhDcoIIrTE-n4H9Y3o3kfjXpIpQ8CQpS6bUc/exec";

    $request = $client->post($url, [
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode([
            'status' => 'A',
            'request_id' => $_POST['request_id'],
            'service_type' => $result['service_type'],
            'area' => $result['area'],
            'area_manager' => $result['area_manager'],
            'user_name' => $result['user_name'],
            'request_date' => '2022-04-05',
            'phone' => $result['phone'],
            'email' => 'franciscomontoyacasual@gmail.com',
            'category' => $result['category'],
            'service_subtype' => $result['service_subtype'],
            'description' => $result['description']
        ])
    ]);

    $response = $request->getBody();

    return $response;
}
?>