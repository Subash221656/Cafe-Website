<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            margin: 0;
            padding: 0;
            background-size: cover;
            background-position: center;
        }



        .wrapper {
            width: 360px;
            padding: 20px;
            z-index: 1;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .close-button {
            position: absolute;
            right: 20px;
            top: 20px;
            color: white;
            font-size: 24px;
            cursor: pointer;
            text-decoration: none;
        }

        h2{
            text-align: center;
        }

        .form-group {
            margin: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 85%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .form-group button {
            width: 50%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: #fff;
            background: #333;
            margin: 20px 25%;
        }

        .video-background {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -100;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <video autoplay loop muted class="video-background">
        <source src="../vd/staff.mp4" type="video/mp4">
    </video>
     
    <section id="signup">
    <div class="container my-6 ">
        
    <div class="wrapper">
    <a href="../../customerSide/home/home.php" class="close-button">&times;</a>
       
    <?php 
if(!empty($login_err)){
    echo '<div class="alert alert-danger">' . $login_err . '</div>';
}        
?>

<form action="login_process.php" method="post" >
    <div class="form-group">
        <label for="account_id">Staff Account ID</label>
        <input type="number" id="account_id" name="account_id" placeholder="Enter Account ID" required class="form-control <?php echo (!empty($account_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo isset($account_id) ? $account_id : ''; ?>">
        <span class="invalid-feedback"><?php echo isset($account_id_err) ? $account_id_err : ''; ?></span>
    </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
        </div>
            
        <div class="form-group">
            <button class="btn btn-light" type="submit" name="submit" value="Login">Login</button>
        </div>
    </form>
    </div>
    </section>
</body>
</html>
