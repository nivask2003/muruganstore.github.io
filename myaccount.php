<?php
include "Includes/header.php";
if ($_GET['customer_id']) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE customer_id = ?");
    $stmt->execute([$_GET['customer_id']]);
    $user = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT * FROM checkout WHERE customer_id = ?");
    $stmt->execute([$_GET['customer_id']]);
    $ph = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT * FROM checkout WHERE customer_id = ? ORDER BY date_added DESC LIMIT 4");
    $stmt->execute([$_GET['customer_id']]);
    $checkout = $stmt->fetchAll();

    $stmt = $pdo->prepare("SELECT * FROM checkout WHERE customer_id = ?");
    $stmt->execute([$_GET['customer_id']]);
    $order_history = $stmt->fetchAll();
}
if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE users SET firstname = ? ,middlename = ?,lastname = ? ,mobilenumber = ?, email = ? WHERE customer_id = ?");
    $stmt->execute([$_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['mobilenumber'],  $_POST['email']]);
    
}
?>
<main>
        <div class="myaccount d-flex">
            <div class="sidebar bg-light">
                <ul class="navbar">
                    <li class="nav-item d-flex">
                        <a href="#" class="nav-link" onclick="toggleTab('dashboard')">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleTab('my_profile')">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleTab('order_history')">Order History</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleTab('change_password')">Change Password</a>
                    </li>
                    <li class="nav-item">
                        <a href="signout.php" class="nav-link">Sign Out</a>
                    </li>
                </ul>
            </div> 
            <!--Dashboard Section-->
            <div class="content container-fluid" id="dashboard">
                <small id="brandtitle">Dashboard</small>
                <div class="container d-flex justify-content-center">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <p>Alert Message</p>
                        </div>
                        <div class="card-body">
                            <p>Hi customer, In this page you can see your orders and you can change your add address and profile.</p>
                        </div>
                    </div>                    
                </div>
                <div class="accountdetails mt-4">
                    <small id="brandtitle">Account Details</small>
                    <hr>
                    <p><b>Name:</b>&nbsp;<?=$user['firstname']?>&nbsp;<?=$user['middlename']?>&nbsp;<?=$user['lastname']?></p>
                    <p><b>Username:</b>&nbsp;<?=$user['email']?></p>
                    <p><b>Phone number:</b>&nbsp;<?=$ph['phonennumber']?></p> 
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
                            <?php if (empty($checkout)):?>
                                <td colspan="4" class="text-center">No Order</td>
                            <?php else:?>
                                <?php foreach($checkout as $check):?>
                                <tr>
                                    <td><?=$check['order_id']?></td>
                                    <td><?=$check['count']?></td>
                                    <td><?=$check['subtotal']?></td>
                                    <td><a href="" style="text-decoration:none">View</a></td>
                                </tr>
                                <?php endforeach;?>
                            <?php endif;?>    
                        </tbody>
                    </table>
                </div>
            </div>
            <!--My Profile Session-->
            <div class="content container-fluid" id="my_profile">
                <small id="brandtitle">My Profile</small>
                <form action="index.php?page=myaccount&customer_id=<?=$_GET['customer_id']?>" method="post" class="mt-4">
                    <div class="form-group">
                        <label for="firstname" style="font-weight:bold">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" style="width:500px" value="<?=$user['firstname']?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="middlename" style="font-weight:bold">Middle Name</label>
                        <input type="text" name="middlename" id="middlename" class="form-control" style="width:500px" value="<?=$user['middlename']?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="lastname" style="font-weight:bold">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" style="width:500px" value="<?=$user['lastname']?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="mobilenumer" style="font-weight:bold">Mobile Number</label>
                        <input type="text" name="mobilenumber" id="mobilenumber" class="form-control" style="width:500px" value="<?=$ph['phonennumber']?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email" style="font-weight:bold">Email Address</label>
                        <input type="text" name="email" id="email" class="form-control" style="width:500px" value="<?=$user['email']?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="reg_date" style="font-weight:bold">Registration Date</label>
                        <input type="text" name="reg_date" id="reg_date" class="form-control" style="width:500px" value="<?=$user['date_added']?>">
                    </div>
                    <br>
                    <div class="group">
                        <input type="submit" value="Update" class="btn" name="update">
                    </div>
                </form>
            </div>
            <div class="content container-fluid" id="order_history">
            <small id="brandtitle"> Order History</small>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>OrderID</th>
                                <th>No.of Product</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                            <?php if (empty($checkout)):?>
                                <td colspan="4" class="text-center">No Order</td>
                            <?php else:?>
                                <?php foreach($order_history as $order):?>
                                <tr>
                                    <td><?=$order['order_id']?></td>
                                    <td><?=$order['count']?></td>
                                    <td><?=$order['subtotal']?></td>
                                    <td><a href="" style="text-decoration:none">View</a></td>
                                </tr>
                                <?php endforeach;?>
                            <?php endif;?>    
                        </tbody>
                    </table>
            </div>
            <div class="content container-fluid" id="change_password">
                <small id="brandtitle">Change Password</small>
                <form action="index.php?page=myaccount" method="post" class="mt-4">
                    <div class="form-group">
                        <label for="current_password" style="font-weight:bold;">Current Password</label>
                        <input type="text" name="current_password" id="current_password" class="form-control" style="width:500px">
                    </div><br>
                    <div class="form-group">
                        <label for="new_password" style="font-weight:bold;">New Password</label>
                        <input type="text" name="new_password" id="new_password" class="form-control" style="width:500px">
                    </div><br>
                    <div class="form-group">
                        <label for="confirm_password" style="font-weight:bold;">Confirm Password</label>
                        <input type="text" name="confirm_password" id="confirm_password" class="form-control" style="width:500px">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Change" name="change_btn" class="btn">
                    </div>
                </form>
            </div>
    </main>
<?php
include "Includes/footer.php";
?>
