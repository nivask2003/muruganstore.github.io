<?php
// The amounts of products to show on each page
$num_products_on_each_page = 4;
// The current page - in the URL, will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_products = $pdo->query('SELECT * FROM products')->rowCount();
include "Includes/header.php";
?>
    <main>
        <div class="recently_added_products container mt-4 " style="height: 540px;">
            <small id="recentlytitle">Shop</small>
            <p id="totalproduct">Total Product: NaN</p>
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
            <div class="buttons mt-5">
            <?php if ($current_page > 1): ?>
        <a href="index.php?page=shop&p=<?=$current_page-1?>&customer_id=<?=$_SESSION['customer_id']?>" class="btn">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="index.php?page=shop&p=<?=$current_page+1?>&customer_id=<?=$_SESSION['customer_id']?>" class="btn">Next</a>
        <?php endif; ?>
            </div>
        </div>
    </main>
    <?php
include "Includes/footer.php";
?>
