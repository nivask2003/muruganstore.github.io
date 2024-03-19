<?php
$stmt = $pdo->prepare("SELECT * FROM products ORDER BY date_added DESC LIMIT 4");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['searchbtn'])) {
    $searchTerm = $_POST['searchBox'];
    // Redirect to search page with the search term
    header("Location: index.php?page=search&term=" .$searchTerm ."&customer_id=" . $_SESSION['customer_id']);
    exit(); // Ensure no further code execution after redirection
}
include "Includes/header.php";
?>
<link rel="stylesheet" href="Assets/CSS/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="container-fluid d-flex justify-content-end mt-4">
    <form action="index.php?page=search&customer_id=<?=$_SESSION['customer_id']?>" method="post" class="mt-3 p-2">
        <input type="text" name="search" id="search" placeholder=" Search Products..">
        <input type="submit" value="Search" class="btn btn-warning">
    </form>
    </div>
    <div class="banner container mt-4">
        <div class="card">
            <h3 id="bannaertitle">Grocery & Stationary</h3>
            <a href="index.php?page=shop&customer_id=<?=$_SESSION['customer_id']?>" class="viewbtn btn btn-warning">View All Products</a>
        </div>
    </div>
    <div class="recently_added_products container mt-4 ">
        <h2 style="color:blue;">Recently Added Products</h2>
        <div class="productbox d-flex">
        <?php foreach ($products as $product):?>
        <div class="card container-fluid mt-4" style="width:225px;">
            <a href="index.php?page=product&id=<?=$product['id']?>&customer_id=<?=$_SESSION['customer_id']?>" class="product">
                <img src="Assets\Images\<?=$product['img']?>" alt="productname" id="productimg">
                <p id="productname"><?=$product['name']?></p>
                <p id="productprice">&#8377;<?=$product['price']?></p>
            </a>
        </div>
        <?php endforeach;?>
        </div>
    </div>
    <?php 
    include "Includes/footer.php"
    ?>
