<?php
include "utilities/cookie.php";
Cookie::set_cookie("uid", "", time() - 3600);
Cookie::set_cookie("rid", "", time() - 3600);
header('Location: /');
?>