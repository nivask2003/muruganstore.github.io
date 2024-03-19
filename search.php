<?php
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT LOWER(name) as lower FROM products");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach($search_result as $result):
        switch ($_POST['search']) {
            case ($result['name'] && $row):
                header("Location: index.php?page=product&id=" . $result['id'] . "&customer_id=" . $_GET['customer_id']);
                break;
            default:
                # code...
                break;
        }
    endforeach;

    
}
