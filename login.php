<?php
session_start();
ob_start();
    if (isset($_SESSION['juId'])) {
        header('Location: ./dashboard/');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUMGA LOGIN</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="./vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
        <div class="row m-5">
            <div class="col-sm">
                <h1 class="text-center">
                    JUMGA
                </h1>
            </div>
            <div class="col-sm">
                <form class="login-form" id="login">
                    <div class="form-group">
                        <input type="text" class="username form-control" id="username" placeholder="Email Address or Phone Number">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="error singup-error" id="login-error"></div>
                       <div class="row">
                           <div class="col-sm">
                               <div>
                                <a href="./signup.php">Create Account</a>
                               </div>
                         
                        </div>
                        
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-info" id="btn-login">
                                Login
                                </button>
                            </div>
                        </div>
                
                    </div>
                </form>
            </div>
        </div>
        <script src="./vendor/jquery/jquery.min.js"></script>
        <script src="./js/sydeestack.js"></script>
        <script src="./js/functions.js"></script>
        <script src="./js/login.js"></script>
</body>
</html>