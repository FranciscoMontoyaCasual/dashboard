<?php
class Cookie{
    public static function set_cookie($name, $value, $expires){
        setcookie($name, $value, $expires);
    }
}
?>