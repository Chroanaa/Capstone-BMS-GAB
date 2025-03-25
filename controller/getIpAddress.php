<?php
 function get_client_ip(){
     $clientIP = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $clientIP = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $clientIP = $_SERVER['REMOTE_ADDR'];
    }
 if ($clientIP === '::1') {
        $clientIP = '127.0.0.1';
    }
     return $clientIP;
 }

?>