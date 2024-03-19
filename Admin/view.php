<?php
$stmt = $pdo->prepare("SELECT * FROM checkout WHERE order_id = ?");
$stmt->execute([$_GET['order_id']]);
$info = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->execute([$_GET['order_id']]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>View</title>
    <style>
        .card{
            box-shadow: 0 0 5px;
        }
        thead{
            background-color:blue;
        }
        thead th{
            color:white
        }
        .btn{
            background-color:blue;
            color:white;
        }
    </style>

</head>
<body>
    <header>
        <div class="header container-fluid p-2">
            <small id="brandtitle">Murugan Stores</small>
        </div>
    </header>
    <main>
        <div class="viewpage container mt-4">
            <div class="card p-3">
            <small><b>Order ID : <?=$_GET['order_id']?><br><br>Email : <?=$info['email']?> </b></small>
            </div>
            <br>
            <div class="card p-3">
                <small><b>Shipping Address: <br><br> <?=$info['address']?></b></small>
            </div>
            <br>
            <div class="card p-3">
            <table class="table ">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                                    <tr>
                                        <td><?=$order['products']?></td>
                                        <td>&#8377;<?=$order['price']?></td>
                                        <td><?=$order['qty']?></td>
                                        <td>&#8377;<?=$order['price']*$order['qty']?></td>
                                    </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>Sub Total</td>
                                <td>&#8377;<?=$info['subtotal']?></td>

                            </tr>
                        </tbody>
                    </table>
            </div>
            <br>
            <a href="index.php?page=admin" class="btn">Back to Dashboard</a>
        </div>
    </main>