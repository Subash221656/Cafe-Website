<?php
require_once "../config.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // User-provided input
    $provided_account_id = $_POST['admin_id']; // 221656
    $provided_password = $_POST['password']; // 00000
    $uniqueString = $provided_account_id . $provided_password;

    if ($uniqueString == "22165600000") {
        echo ' Correct';
        header("Location: ../panel/account-panel.php");
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
                <h5>Admin Credentials needed to view Account Details</h5>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Admin Id</label>
                        <input type="number" name="admin_id" class="form-control" placeholder="Enter User Email" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter User Password" required>
                    </div>

                    <button class="btn btn-light" type="submit" name="submit" value="submit">View Accounts</button>
                    <a class="btn btn-danger" href="../posBackend/posTable.php" >Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
