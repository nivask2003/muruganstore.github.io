<?php
if (isset($_POST['product_id'], $_POST['qty']) && is_numeric($_POST['product_id']) && is_numeric($_POST['qty'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['qty'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart&customer_id=' . $_GET['customer_id']);

    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart&customer_id=' . $_GET['customer_id']);
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['checkout']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('location: index.php?page=checkout&customer_id=' . $_GET['customer_id']);
    exit;
}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}
// Get the number of items in the shopping cart, which will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
include "Includes/header.php";
?>
    <main>
        <div class="cart container mt-4">
            <small id="title">Shopping Cart</small>
            <div class="row mt-4">
                <form action="index.php?page=cart&customer_id=<?=$_GET['customer_id']?>" method="post" class="d-flex">
                <div class="col-md-6 me-5">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                            <?php if(empty($product)):?>
                                <tr>
                                    <td colspan=5>Your cart is empty</td>
                                </tr>
                            <?php else:?>
                                <?php foreach ($products as $product):?>
                                    <tr>
                                        <td><?=$product['name']?></td>
                                        <td>&#8377;<?=$product['price']?></td>
                                        <td><input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['qty']?>" placeholder="Quantity" required></td>
                                        <td>&#8377;<?=$product['price']*$products_in_cart[$product['id']]?></td>
                                        <td><a href="index.php?page=cart&remove=<?=$product['id']?>&customer_id=<?=$_GET["customer_id"]?>" class="remove text-danger">Remove</a></td>
                                    </tr>
                                <?php endforeach;?>
                            <tr>
                                <td colspan="2"></td>
                                <td>Sub Total</td>
                                <td>&#8377;<?=$subtotal?></td>
                                <td></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Cart Summary
                        </div>
                        <div class="card-body">
                            Total Items : <?=$num_items_in_cart?> <br><br>
                            Sub Total : &#8377;<?=$subtotal?>
                            <div class="form-group mt-4">
                                <input type="submit" value="Update" class="btn" name="update">
                                <input type="submit" value="Checkout" class="btn" name="checkout">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </main>
    <?php
    include "Includes/footer.php";
    ?>
