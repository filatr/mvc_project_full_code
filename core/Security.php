<?php
class Security {

    public static function headers(): void {
        header('X-Frame-Options: SAMEORIGIN');
        header('X-Content-Type-Options: nosniff');
        header('Referrer-Policy: strict-origin');
        header("Content-Security-Policy: default-src 'self'");
    }
}
