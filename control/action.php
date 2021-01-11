<?php 
    require('./conn.php');
    require('./functions.php');
  if (isset($_POST['signup'])) {
     
      $fn =checkForm($_POST['fn']);
      $e = checkForm($_POST['e']);
      $p = checkForm($_POST['p']);
      $g = checkForm($_POST['g']);
      $c = checkForm($_POST['c']);
      $t = checkForm($_POST['t']);
      $password = checkPass($_POST['password']);
      $postArray = array($fn, $e, $p, $g, $c, $t, $password);
      $hp = password_hash($password, PASSWORD_DEFAULT);
      if (!in_array("", $postArray)) {

        // CHECK FOR USERNAME, EMAIL OR PHONE NUMBER EXISTING 
        
        if (dbValCheck($e, 'email', 'users')) {
         echo error('EMAIL ALREADY EXIT');
        }else if(dbValCheck($p, 'phone', 'users')){
          echo error('PHONE NUMBER IS USE');
        }else if (strlen($password) < 6) {
          echo error('PASSWORD: MINIMUM OF 6 CHARACTER');
        }else{
          // CHECK THE ACCOUNT TYPE 
          if ($t === 'merchant') {
          // MERCHANT QUERY 
             // SEND QUERY TO DATABASE 

            //  REGISTER QUERY 
             $sql = "INSERT INTO 
             `users`
                 (`fullname`, `email`, `phone`, `gender`, `country`, `type`, `password`, `transaction_code`, `status`, `verification_code`) 
             VALUES 
                 ('$fn', '$e', '$p', '$g', '$c', '$t','$hp', 'null', 'active', 'xtskeituuy')";
             $query = mysqli_query($conn, $sql);
             if (!$query) {
               die(error('QUERY FAILED ').mysqli_error($conn));
             }else{
                  if ($sQuery == true) {
                    if (!file_exists("../users/sydeestack_$p")) {
                        mkdir("../users/sydeestack_$p", 0777, true);
                    }
                  }
               $t_ref = $e."merchant_activation_fees";
               echo "<span class='text-success'>Registered Successfully Click the button below or Login to Activate</span>";
                echo "
                <form method='POST' action='https://checkout.flutterwave.com/v3/hosted/pay'>
                  <input type='hidden' name='public_key' value='FLWPUBK_TEST-58d949e27145d7b369efaf6099b62d61-X' />
                  <input type='hidden' name='customer[email]' value='$e' />
                  <input type='hidden' name='customer[phone_number]' value='$p' />
                  <input type='hidden' name='customer[name]' value='$fn' />
                  <input type='hidden' name='tx_ref' value='$t_ref' />
                  <input type='hidden' name='amount' value='200' />
                  <input type='hidden' name='currency' value='NGN' />
                  <input type='hidden' name='meta[token]' value='54' />
                  <input type='hidden' name='redirect_url' value='http://localhost/jumga/pay.php' />
                  
                  <button type='submit' class='btn btn-info'>Activate</button> 
                </form>
                 
                ";
             }


          }else{
            // SEND QUERY TO DATABASE 
            $sql = "INSERT INTO 
            `users`
                (`fullname`, `email`, `phone`, `gender`, `country`, `type`, `password`, `transaction_code`, `status`, `verification_code`) 
            VALUES 
                ('$fn', '$e', '$p', '$g', '$c', '$t','$p', 'null', 'active', 'xtskeituuy')";
            $query = mysqli_query($conn, $sql);
            if (!$query) {
              die(error('QUERY FAILED ').mysqli_error($conn));
            }else{
              if ($sQuery == true) {
                if (!file_exists("../users/sydeestack_$p")) {
                    mkdir("../users/sydeestack_$p", 0777, true);
                }
               
            }
              echo info('REGISTERED SUCCESSFULLY CLICK <a href="./login.php">HERE<a> TO LOGIN');
            }
          }
        }
        
        
      }else{
        echo error('all fields required');
      }
      
  }

  if (isset($_POST['login'])) {
    $u = checkForm($_POST['u']);
    $p = checkPass($_POST['p']);

    // CHECK FOR EMPTY FIELDS
    if (!empty($u) && $p !=="") {
       // CHECK IF USERNAME EXIST 

       $uQuery = mysqli_query($conn, "SELECT * FROM users WHERE email='$u' OR phone='$u'");

       if (!$uQuery) {
         die('UNABLE TO VERIFY ACCOUNT '.mysqli_error($conn));
       }else{
          $numRow = mysqli_num_rows($uQuery);

          if ($numRow > 0) {
            // VALIDATE PASSWORD 
            $row = mysqli_fetch_assoc($uQuery);
              $dbPassword = $row['password'];
              if (password_verify($p, $dbPassword)) {
                echo success("VERIFY SUCCESSFULLY");
                $id = $row['id'];
                $type = $row['type'];
                $_SESSION['juId'] = $id;
                $_SESSION['juType'] = $type;
               
              }else{
                echo error("INVALID PASSWORD");
              }
          }else{
            echo error("INVAID USER");
          }
       }
    }else{
        echo error('ALL FIELDS REQUIRED');
    }
    
  }

  if (isset($_POST['fetchSingleProduct'])) {
    $pId = $_POST['fetchSingleProduct'];
    $product_query = mysqli_query($conn, "SELECT * FROM product WHERE id=$pId");
    if (!$product_query) {
        die(error("ERROR LOADING PRODUCTS"));
    }else if(mysqli_num_rows($product_query) > 0){
      $row = mysqli_fetch_assoc($product_query);

      $price = number_format($row['price']);
      $name = ucwords($row['name']);
      $description = $row['description'];
      echo "<div class='cart-item'>
      <p class='cart-name'>$name</p>
      <div class='cart-image'>
          <img src='./pics.png' alt='' class=''>
      </div>
      <div class='description mt-2'>
        <h5>Details</h5>
        <p>$description</p>
      </div>
      <div class='cart-item-details'>
          <div class='price'>Checkout (N $price)</div>
          <div class='more'><a href='' id='$pId' name='add-to-cart'>Add to Cart</a></div>
      </div>
  </div>";
    }
  }