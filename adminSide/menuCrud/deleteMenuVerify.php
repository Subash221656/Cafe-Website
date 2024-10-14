<?php
require_once "../config.php";

// Check if 'id' is set and not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $menu_id = $_GET['id'];
} else {
    header("Location: ../panel/menu-panel.php");
    exit(); // Make sure to exit after redirect
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // User-provided input
    $provided_account_id = $_POST['admin_id']; // 221656
    $provided_password = $_POST['password']; // 00000
    $uniqueString = $provided_account_id . $provided_password;

    if ($uniqueString == "22165600000") {
        echo ' Correct';
        header("Location: ../menuCrud/deleteItem.php?id=".$menu_id ."");
    } else {
        echo '<script>alert("Incorrect ID or Password!")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="../css/verifyAdmin.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login_wrapper">
            <div class="wrapper">
                <h2 style="text-align: center;">Admin Login</h2>
                <h5>Admin Credentials needed to Delete Item</h5>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Admin Id</label>
                        <input type="number" name="admin_id" class="form-control" placeholder="Enter User Email" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter User Password" required>
                    </div>

                    <button class="btn btn-light" type="submit" name="submit" value="submit">Delete Menu Item</button>
                    <a class="btn btn-danger" href="../panel/menu-panel.php" >Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
