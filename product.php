<?php
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
include "Includes/header.php";
?>
<style>
.productpage .image{
    width: 500px;
    height: 500px;
}
.productpage .image img{
    width: 500px;
    height: 500px;
}
.productpage .details #productname{
    color: blue;
}
.productpage .details #productprice{
    color: gray;
}
.productpage .details form .form-group .btn{
    color: white;
    background-color: blue;
}
</style>
<div class="container productpage d-flex mt-5">
    <div class="image me-5">
        <img src="Assets/Images/<?=$product['img']?>" alt="Product Image" srcset="" id="productimage">
    </div>
    <div class="details">
        <h1 id="productname"><?=$product['name']?></h1>
        <h3 id="productprice">&#8377;<?=$product['price']?></h3>
        <form action="index.php?page=cart&customer_id=<?php echo $_SESSION['customer_id'];?>" method="post">
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" name="qty" id="qty" class="form-control" value="1" min="1" max="<?=$product['qty']?>">
            </div>
            <div class="form-group">
                <input type="hidden" name="product_id" value="<?=$product['id']?>">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" value="Add to cart" class="btn">
            </div>
        </form>

        
    </div>
</div>
<?php
include "Includes/footer.php";
?>
