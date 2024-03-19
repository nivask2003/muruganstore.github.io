<?php
if (isset($_POST['logbtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user) {
        if ($email == $user['email'] && $password == $user['password'] ) {
            $customID = $user['customer_id'];
            header("Location:index.php?page=home&customer_id=$customID");
        }
        else {
            ?>
            <script src="Assets/JS/errormessage.js"></script>
            <?php
        }    
    }
    
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
    <title>Login</title>
</head>
<body>
    <header>
        <div class="header container-fluid">
            <small id="brandtitle">Murugan Stores</small>
        </div>
    </header>
    <main>
        <div class=" login container mt-4">
            <div class="d-flex justify-content-center"> 
            <div class="card">
                <div class="card-header">Login Page</div>
                <div class="card-body">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group mt-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group mt-4">
                        <input type="submit" value="Login" class="btn" name="logbtn">
                    </div>
                    <div class="form-group mt-4">
                        <a href="">Forgot Password</a><br>
                        <a href="index.php?page=register">Register</a>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </main>
    <footer>
        <div class="footer container-fluid p-3 mt-4">
            <p>&copy 2024 Murugan Stores</p>
        </div>
    </footer>
</body>
</html>
