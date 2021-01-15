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
    <title>JUMGA SIGNUP</title>
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
            <h1 class="text-center">JUMGA</h1>
        </div>
        <div class="col-sm">
            <form class="signup" id="signup">
                <div class="form-group">
                    <label for="fullname">Fullname <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" class="fullname" id="fullname" placeholder="Fullname">
                    <!-- <div class="error fullname-error" id="fullname-error"></div> -->
                </div>
                <div class="form-group">
                    <label for="email">Email Address <sup class="text-danger">*</sup></label>
                    <input type="email" name="email" id="email" class="form-control email" placeholder="Email Address">
                    <!-- <div class="error email-error" id="email-error"></div> -->
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number <sup class="text-danger">*</sup></label>
                    <input type="number" placeholder="Phone Number" id="phone" class="form-control number">
                    <!-- <div class="error phone-error" id="phone-error"></div> -->
                </div>
                <div class="form-group">
                    <label for="gender">Gender <sup class="text-danger">*</sup></label>
                    <select name="gender" id="gender" class="select form-control">
                        <option value="" disabled selected>Gender</option>
                        <option value="m">Male</option>
                        <option value="f">Female</option>
                    </select>
                    <!-- <div class="error gender-error" id="gender-error"></div> -->
                </div>
                <div class="form-group">
                    <label for="country">Country <sup class="text-danger">*</sup></label>
                    <select name="country" id="country" class="form-control select">
                        <option value="" selected disabled>Select Country</option>
                        <option value="nigeria">Nigeria</option>
                        <option value="ghana">Ghana</option>
                        <option value="kenya">Kenya</option>
                        <option value="uk">UK</option>
                    </select>
                    <!-- <div class="error country-error" id="country-error"></div> -->
                </div>
                <div class="form-group">
                    <label for="type">Account Type <sup class="text-danger">*</sup></label>
                    <select name="account-type" id="type" class="select form-control account-type">
                        <option value="" selected disabled>Select Type</option>
                        <option value="buyer">Buyer</option>
                        <option value="merchant">Merchant</option>
                        <option value="rider">Rider</option>
                    </select>
                    <!-- <div class="error type-error" id="type-error"></div> -->
                </div>
                <div class="form-group">
                    <label for="password">Password <sup class="text-danger">*</sup></label>
                    <input type="password" name="password" id="password" class="form-control password" placeholder="Password">
                    <!-- <div class="error password-error" id="password-error"></div> -->

                </div>
                
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <a href="./login.php">Already has an Account?</a>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group text-right">
                
                            <button type="submit" class="btn btn-info" id="btn-submit">
                            Signup
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="error singup-error" id="signup-error"></div>
        </div>
    </div>
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./js/sydeestack.js"></script>
    <script src="./js/functions.js"></script>
    <script src="./js/signup.js"></script>
</body>
</html>