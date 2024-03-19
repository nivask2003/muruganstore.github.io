<?php
include "Includes/header.php";
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
    $no_product = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}
if ($_GET['customer_id']) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE customer_id = ?");
    $stmt->execute([$_GET['customer_id']]);
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['placeorder'])) {
    $OrderID = generateOrderId();
    $stmt = $pdo->prepare("INSERT INTO checkout(customer_id, order_id, email, count, address, city, state, pincode, subtotal) VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->execute([$_GET['customer_id'], $OrderID, $_POST['email'], $no_product, $_POST['address'], $_POST['city'], $_POST['state'], $_POST['pincode'], $subtotal]);
    foreach($products as $product):
    $stmt = $pdo->prepare("INSERT INTO orders(customer_id, order_id, products, qty, price, total) VALUES(?,?,?,?,?,?)");
    $stmt->execute([$_GET['customer_id'], $OrderID, $product['name'], $products_in_cart[$product['id']], $product['price'], $product['price']*$products_in_cart[$product['id']]]);
    endforeach;
    $customer_id = $_GET['customer_id'];
    header("Location:index.php?page=placeorder&customer_id=$customer_id");
}
?>
    <main>
        <div class="checkout container mt-4">
            <small id="title">Checkout</small>
            <div class="d-flex justify-content-center">
            <div class="card mt-4">
                <div class="card-header">
                    Checkout
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="" name="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?=$users['email']?>">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                        <br>
                        <div class=" csp form-group d-flex">
                            <div class="form-group me-2">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                            <div class="form-group me-2">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pincode">Pin-code</label>
                                <input type="number" name="pincode" id="pincode" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Placecorder" class="btn btn-success mt-3" name="placeorder">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php
    include "Includes/footer.php";
    ?>
