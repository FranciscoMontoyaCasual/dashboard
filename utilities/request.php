<?php
include __DIR__."/../test/db.php";

if(isset($_POST['request_id']) && isset($_POST['area_id']) && isset($_POST['comment'])){
    $db = DB::connect_db();
    DB::assign_request($db, $_POST['request_id'], $_POST['area_id'], $_POST['comment']);
}
?>