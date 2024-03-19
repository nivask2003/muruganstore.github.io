<?php
session_start();
include "Includes/function.php";
include "Includes/generateCustomerId.php";
include "Includes/generateOrderId.php";

$pdo = pdo_connet();
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'login';
include $page . '.php';
?>