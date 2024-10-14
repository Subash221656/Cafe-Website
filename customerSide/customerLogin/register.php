<?php
// Include your database connection code here (not shown in this example).
require_once "config.php"; // Make sure to replace "config.php" with your actual database connection file.
session_start();

// Define variables and initialize them to empty values
$email = $member_name = $password = $phone_number = "";
$email_err = $member_name_err = $password_err = $phone_number_err = "";

// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate member name
    if (empty(trim($_POST["member_name"]))) {
        $member_name_err = "Please enter your member name.";
    } else {
        $member_name = trim($_POST["member_name"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate phone number
    if (empty(trim($_POST["phone_number"]))) {
        $phone_number_err = "Please enter your phone number.";
    } else {
        $phone_number = trim($_POST["phone_number"]);
    }

    // Check input errors before inserting into the database
    if (empty($email_err) && empty($member_name_err) && empty($password_err) && empty($phone_number_err)) {
        // Start a transaction
        mysqli_begin_transaction($link);

        // Prepare an insert statement for Accounts table
      // Prepare an insert statement for Accounts table
$sql_accounts = "INSERT INTO Accounts (email, password, phone_number, register_date) VALUES (?, ?, ?, NOW())";
if ($stmt_accounts = mysqli_prepare($link, $sql_accounts)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt_accounts, "sss", $param_email, $param_password, $param_phone_number);

    // Set parameters
    $param_email = $email;
    // Store the password as plain text (not recommended for production)
    $param_password = $password;
    $param_phone_number = $phone_number;

    // ...
}

            // Attempt to execute the prepared statement for Accounts table
            if (mysqli_stmt_execute($stmt_accounts)) {
                // Get the last inserted account_id
                $last_account_id = mysqli_insert_id($link);

                // Prepare an insert statement for Memberships table
                $sql_memberships = "INSERT INTO Memberships (member_name, points, account_id) VALUES (?, ?, ?)";
                if ($stmt_memberships = mysqli_prepare($link, $sql_memberships)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt_memberships, "sii", $param_member_name, $param_points, $last_account_id);

                    // Set parameters for Memberships table
                    $param_member_name = $member_name;
                    $param_points = 0; // You can set an initial value for points

                    // Attempt to execute the prepared statement for Memberships table
                    if (mysqli_stmt_execute($stmt_memberships)) {
                        // Commit the transaction
                        mysqli_commit($link);

                        // Registration successful, redirect to the login page
                        header("location: register_process.php");
                        exit;
                    } else {
                        // Rollback the transaction if there was an error
                        mysqli_rollback($link);
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close the statement for Memberships table
                    mysqli_stmt_close($stmt_memberships);
                }
            } else {
                // Rollback the transaction if there was an error
                mysqli_rollback($link);
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close the statement for Accounts table
            mysqli_stmt_close($stmt_accounts);
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
  
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; /* Remove default margin */
            background-color:black;
            background-image: url('../image/loginBackground.jpg'); /* Set the background image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }

        .register-container {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            width: 400px;
            max-width: 90%;
    
        }

        .register-container a {
            text-decoration: none;
        }

        h1, h2, p {
            text-align: center;
            font-family: 'Montserrat', serif;
        }

        .form-group {
            margin-bottom: 15px; /* Add space between form elements */
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

       

        .form-group button {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: none;
    }

    .btn-dark{
            color: white;
           
        }
    </style>
    <?php
// ... existing PHP code ...
$email_err = $member_name_err = $password_err = $phone_number_err = "";

// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... existing PHP code ...
} else {
    // Initialize error variables if the form was not submitted
    $email_err = $member_name_err = $password_err = $phone_number_err = "";
}

?>
</head>
<body>
    <div class="register-container">
        <a class="nav-link" href="../home/home.php#hero"> <h1 style="font-family:Copperplate; color:white;">COFFEE RUSH</h1><span class="sr-only"></span></a><br>
       
        <form action="register.php" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                <span class="text-danger"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group">
                <label>Member Name</label>
                <input type="text" name="member_name" class="form-control" placeholder="Enter Member Name" required>
                                <span class="text-danger"><?php echo $member_name_err; ?></span>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                                <span class="text-danger"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number" required>
                                <span class="text-danger"><?php echo $phone_number_err; ?></span>
            </div>

            <button style="background-color:black;" class="btn-dark" type="submit" name="register" value="Register">Register</button>
        </form>

        <p style="margin-top:1em; color:white;">Already have an account? <a href="../customerLogin/login.php" >Proceed to Login</a></p>
    </div>
</body>
</html>
