<?php   
    require_once '../config.php';

    $cookies = $_GET['cookie'];

    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '';

    $referer = $_SERVER['HTTP_REFERER'] ?? '';

    

 ?>   