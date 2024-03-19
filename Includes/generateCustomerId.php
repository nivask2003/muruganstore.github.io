<?php
function generateCustomerId() {
    $prefix = 'CUS'; // You can customize the prefix
    $randomPart = mt_rand(1000, 9999); // You can customize the range for the random part
    $timestampPart = time();

    $customerId = $prefix . $timestampPart . $randomPart;

    return $customerId;
}
?>