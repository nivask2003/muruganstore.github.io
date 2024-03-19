<?php
if (isset($_POST['regbtn'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    if ($password == $confirmpassword) {
        $customid = generateCustomerId();
        $stmt = $pdo->prepare("INSERT INTO users (customer_id, firstname, middlename, lastname, email, password) value(?,?,?,?,?,?)");
        $stmt->execute([$customid, $firstname, $middlename, $lastname, $email, $password]);
        header("Location:index.php");
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
    <title>Register</title>
</head>
<body>
    <header>
        <div class="header container-fluid">
            <small id="brandtitle">Murugan Stores</small>
        </div>
    </header>
    <main>
        <div class=" register container mt-4">
            <div class="d-flex justify-content-center"> 
            <div class="card">
                <div class="card-header">Register Page</div>
                <div class="card-body">
                <form action="index.php?page=register" method="post">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="middlename">Middle Name (Optional)</label>
                        <input type="text" name="middlename" id="middlename" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Register" name="regbtn" class="btn">
                    </div>
                    <div class="form-group mt-4">
                        <a href="index.php?page=login">Already register?</a>
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
