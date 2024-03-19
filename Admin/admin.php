<?php
$total_users = $pdo->query('SELECT * FROM users')->rowCount();
$total_products = $pdo->query('SELECT * FROM products')->rowCount();
$total_checkout = $pdo->query('SELECT * FROM checkout')->rowCount();

$stmt = $pdo->prepare("SELECT * FROM checkout ORDER BY date_added DESC LIMIT 4");
$stmt->execute();
$checkout = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM users ORDER BY date_added DESC LIMIT 4");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM users ORDER BY date_added");
$stmt->execute();
$customer = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM products ORDER BY date_added");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM checkout ORDER BY date_added");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["addbtn"])) {
    $stmt = $pdo->prepare("INSERT INTO products (name, price, qty, img) VALUES(?,?,?,?)");
    $stmt->execute([$_POST['productname'], $_POST['productprice'], $_POST['qty'], $_POST['img']]);
    header("Location:index.php?page=admin");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <style>
        .navbar .active {
            background-color: blue !important;
            color: white !important;
        }
    </style>
    <title>Dashboard</title>

</head>
<body>
    <header>
        <div class="header container-fluid">
            <small id="brandtitle">Murugan Stores</small>
        </div>
    </header>
    <main>
        <div class="admin d-flex">
            <div class="sidebar bg-light">
                <ul class="navbar">
                    <li class="nav-item d-flex">
                        <a href="#" class="nav-link" onclick="toggleTab('dashboard')">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleTab('user')">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleTab('product')">Product Management</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleTab('order')">Order Management</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleTab('signout')">Sign Out</a>
                    </li>
                </ul>
            </div>
            <!--Dashboard Section-->
            <div class="content container-fluid" id="dashboard">
                <small id="brandtitle">Dashboard</small>
                <div class="info d-flex mt-4">
                    <div class="card container-fluid ">
                        <h2 id="cardtitle">Total Users</h2>
                        <h4 id="cardbody" class="text-secondary"><?=$total_users?></h4>
                    </div>
                    <div class="card container-fluid">
                        <h2 id="cardtitle">Total Product</h2>
                        <h4 id="cardbody" class="text-secondary"><?=$total_products?></h4>
                    </div>
                    <div class="card container-fluid">
                        <h2 id="cardtitle">Total Orders</h2>
                        <h4 id="cardbody" class="text-secondary"><?=$total_checkout?></h4>
                    </div>
                    <div class="card container-fluid">
                        <h2 id="cardtitle">Total Revenue</h2>
                        <h4 id="cardbody" class="text-secondary">NaN</h4>
                    </div>
                </div>
                <div class="recentlyordered mt-4">
                    <small id="brandtitle">Recently Ordered</small>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>No.of Product</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                            <?php if(empty($checkout)):?>
                                <td colspan="4" class="text-center">No Order</td>
                            <?php else:?>
                                <?php foreach($checkout as $check):?>
                                <tr>
                                    <td><?=$check['order_id']?></td>
                                    <td><?=$check['count']?></td>
                                    <td><?=$check['subtotal']?></td>
                                    <td><a href="index.php?page=view&order_id=<?=$check['order_id']?>">View</a></td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif;?>
                        </tbody>
                    </table>
                </div>
                <div class="content container-fluid" id="view">
                        <h1>View</h1>
                    </div>
                <div class="recentusers mt-4">
                    <small id="brandtitle">Recent Users</small>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                            <?php if(empty($users)):?>
                                <td colspan="4" class="text-center">No user</td>
                                <?php else:?>
                                    <?php foreach ($users as $user):?>
                                    <tr>
                                        <td><?=$user['customer_id']?></td>
                                        <td><?=$user['firstname']?></td>
                                        <td><?=$user['middlename']?></td>
                                        <td><?=$user['lastname']?></td>
                                        <td><?=$user['email']?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="content container-fluid" id="user">
                <small id="brandtitle">User Management</small>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody class="table-primary">
                        <?php if (empty($customer)):?>
                            <td colspan="4" class="text-center">No user</td>
                        <?php else:?>
                            <?php foreach ($customer as $cust):?>
                                <tr>
                                    <td><?=$cust['customer_id']?></td>
                                    <td><?=$cust['firstname']?></td>
                                    <td><?=$cust['middlename']?></td>
                                    <td><?=$cust['lastname']?></td>
                                    <td><?=$cust['email']?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            <div class="content container-fluid" id="product">
                <small id="brandtitle">Product Management</small>
                <div class="option mt-4">
                    <a href="#" class="btn" onclick="add()">Add Product</a>
                </div>
                <div class="content mt-4" id="addproduct">
                    <form action="index.php?page=admin" method="post">
                        <div class="form-group">
                            <label for="productname">Product Name</label>
                            <input type="text" name="productname" id="productname" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="productprice">Product Price</label>
                            <input type="text" name="productprice" id="productprice" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="text" name="qty" id="qty" class="form-control">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="img">Image</label>
                            <input type="file" name="img" id="img">
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" value="Enter" name="addbtn" id="addbtn" class="btn">
                        </div>
                    </form>
                </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody class="table-primary">
                    <?php if (empty($customer)):?>
                            <td colspan="4" class="text-center">No user</td>
                        <?php else:?>
                            <?php foreach ($products as $product):?>
                                <tr>
                                    <td><?=$product['id']?></td>
                                    <td><?=$product['name']?></td>
                                    <td><?=$product['qty']?></td>
                                    <td><?=$product['price']?></td>
                                    <td><img src="Assets/Images/<?=$product['img']?>" alt="product<?=$product['id']?>" width="50px" height="50px"></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            <div class="content container-fluid" id="order">
                <small id="brandtitle">Order Management</small>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>OrderID</th>
                            <th>No.of Product</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-primary">
                        <?php if (empty($orders)):?>
                            <td colspan="4" class="text-center">No Order</td>
                        <?php else:?>
                            <?php foreach ($orders as $order):?>
                                <tr>
                                    <td><?=$order['order_id']?></td>
                                    <td><?=$order['count']?></td>
                                    <td><?=$order['subtotal']?></td>
                                    <td><a href="index.php?page=view&order_id=<?=$order['order_id']?>">View</a></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>    
                    </tbody>
                </table>

            </div>
            <div class="content container-fluid" id="signout">Sign Out</div>
            <script src="Assets/JS/toggleTab.js"></script>
            <script src="Assets/JS/addproduct.js"></script>
        </div>
    </main>
</body>
</html>