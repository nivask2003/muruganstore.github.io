<?php
session_start();
include "Includes/function.php";
$pdo = pdo_connet();
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'login';
include $page . '.php';
?>