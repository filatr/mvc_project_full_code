<?php
class Csrf {
    public static function token() {
        session_start();
        if(!isset($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32));
        return $_SESSION['csrf'];
    }
}
