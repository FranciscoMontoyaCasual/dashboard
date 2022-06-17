<?php
require __DIR__.'/vendor/autoload.php';
use GuzzleHttp\Client;

$client = new GuzzleHttp\Client();
$url = "https://script.google.com/macros/s/AKfycby_FtIY1OCuxUc4xQ9euHC73N7LY0XCC4PJdd-oi3mzcyJbj5g9gdqy_3AZd2aVzMz-/exec";
$request = $client->post($url, [
    'headers' => ['Content-Type' => 'application/json'],
    'body' => json_encode([
        'status' => 'A',
        'request_id' => 'M004',
        'service_type' => "Seguridad",
        'area' => 'Departamento de Proyección Empresarial e Intercambio y Colaboración Institucional',
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

echo $response;

?>
