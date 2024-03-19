<?php
function pdo_connet(){
    $servername = "localhost";
    $username = "root";
    $password = '';
    $dbname = "online e-commerce";
    try {
        return new PDO("mysql:host=" . $servername . ";dbname=" . $dbname . ";charset=utf8" , $username , $password); 
    } catch (PDOException $expection) {
        exit("Failed to connect");
    }
}
?>
