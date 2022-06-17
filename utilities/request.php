<?php
include __DIR__."/../test/db.php";
require __DIR__.'/../vendor/autoload.php';
use GuzzleHttp\Client;

if(isset($_POST['request_id']) && isset($_POST['area_id']) && isset($_POST['comment'])){
    $db = DB::connect_db();
    DB::assign_request($db, $_POST['request_id'], $_POST['area_id'], $_POST['comment']);
    $result = DB::get_request($db, $_POST['request_id']);

    $client = new GuzzleHttp\Client();

    $url = "https://script.google.com/macros/s/AKfycbxPxAHMoeGCkr2tU9ZUtjPvMasDbFG4WYYskgmcpi896hwv7MFTQadS3L_LgRWYbTKZ/exec";

    $request = $client->post($url, [
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode([
            'status' => 'A',
            'request_id' => 'M004',
            'service_type' => "Seguridad",
            'area' => 'Departamento de Proyección Empresarial e Intercambio y Colaboración  Institucional',
            'area_manager' => 'Ricardo Cortes Baez',
            'user_name' => 'Javier Gutiérrez',
            'request_date' => '2022-04-05',
            'phone' => '2722806259',
            'email' => 'franciscomontoyacasual@gmail.com',
            'category' => 'Seguridad privada',
            'service_subtype' => 'Vigilancia para eventos',
            'description' => 'Pintura para la UAR el viernes 4 de marzo de 6 a 8 pm',
            'send_to' => "franciscomontoyacasual@gmail.com",
	        'comment' => "This is a simple comment"
        ])
    ]);

    $response = $request->getBody();

    return $response;
}
?>