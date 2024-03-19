<?php
include "Includes/header.php";
?>
    <main>
        <div class="service container mt-4">
            <small id="title">Service</small>
            <form action="index.php?page=service&customer_id=<?=$_SESSION['customer_id']?>" method="post" class="mt-4">
                <div class="form-group">
                    <label for="service_type">Service:</label>
                    <select name="service_type" id="service_type" class="form-control">
                        <option value="service_type0">--Select any one--</option>
                        <option value="service_type1">Food</option>
                        <option value="service_type2">Milk</option>
                    </select>
                </div>
                <div class="form-group mt-4">
                    <input type="submit" value="Enter Service" class="btn" onclick = "toggleTab('option')">
                </div>
            </form>
        </div>
        <div class="content container" id="option">
            <?php if($_POST['service_type'] == 'milk'):?>
                <form action="" method="post">
                    <label for="milk_variety">Milk Variety:</label>
                    <input type="text" name="milk_variety" id="milk_variety" class="form-control">
                </form>
            <?php endif;?>
        </div>
        
    </main>
    <?php
    include "Includes/footer.php";
    ?>
