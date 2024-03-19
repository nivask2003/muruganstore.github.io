<?php
if ($_GET['customer_id']) {
    $_SESSION['customer_id'] = $_GET['customer_id'];
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
    <link rel="stylesheet" href="Assets/CSS/myaccount.css">
    <script src="Assets\JS\toggleTab.js"></script>
    <title>Home</title>
  <style>
  body {
    /* Set the background image */
    background-image: url('Assets/Images/logo.png');
    /* Adjust the position to make it appear as a watermark */
    background-position: center;
    /* Set the background image to fixed so it stays in place while scrolling */
    background-attachment: fixed;
    /* Set the background image to cover the entire viewport */
    background-size:500px;
    background-repeat:no-repeat; 
  }
  body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.5); /* Adjust the last value (0.5) to change opacity */
    z-index: -1; /* Ensure the pseudo-element is behind other content */
}
</style>
</head>
<body>
    <header>
        <div class="header container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <img src="Assets/Images/logo.png" alt="Logo" style="width:80px;">
                    <small id="brandtitle">Murugan Stores</small>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <ul class="navbar navbar-expand-lg">
                        <li class="nav-item">
                            <a href="index.php?page=home&customer_id=<?=$_SESSION['customer_id']?>" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=shop&customer_id=<?=$_SESSION['customer_id']?>" class="nav-link">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=service&customer_id=<?=$_SESSION['customer_id']?>" class="nav-link">Services</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=cart&customer_id=<?=$_SESSION['customer_id']?>" class="nav-link">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=myaccount&customer_id=<?=$_SESSION['customer_id']?>" class="nav-link">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a href="Admin/index.php?page=login" class="nav-link">Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
