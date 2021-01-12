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
      <div class='cart-item-checkout' id='cart-item-checkout'>
          
          <div class='add-to-cart' id='add-to-cart'>
            <button class='btn btn-info btn-add-to-cart' name='btn-add-to-cart' id='$pId'>Add to Cart</button>
          </div>
          <div class='checkout' id='checkout'>
            <button class='btn btn-success btn-checkout' name='btn-checkout' id='$pId'>Checkout</button>
          </div>
          <div>
            <button class='btn btn-outline-dark' name='btn-like' id='$pId'><i class='fa fa-heart-o' aria-hidden='true'></i></button>
          </div>
      </div>
  </div>";
    }
  }


    if (isset($_POST['singleCheckOut'])) {
      $spId = $_POST['singleCheckOut'];

      // CHECK IF USER IS LOGIN 
      if (isset($_SESSION['juId'])) {
       
        $product_query = mysqli_query($conn, "SELECT * FROM product WHERE id=$spId");
          if (!$product_query) {
              die(error("ERROR LOADING PRODUCTS"));
          }else if(mysqli_num_rows($product_query) > 0){
            $row = mysqli_fetch_assoc($product_query);
            $fPrice = number_format($row['price']);
            $price = $row['price'];
            $name = ucwords($row['name']);
            $description = $row['description'];
            $qty = 1;

            // SET THE PRODUCT CART SESSION 
              
              if (isset($_SESSION['cart'])) {
                // CHECK IF THE PRODUCT ALREADY EXIST IN THE ARRAY 
                if (!array_key_exists ($spId, $_SESSION['cart'])) {
                  $_SESSION['cart'][$spId] = $name;
                }
                 
              }else{
                // SET THE SESSION AND CREAT THE FIRST ARRAY 
                $_SESSION['cart'] = array($spId => $name);
              }
            
            echo "<div class='container'>
            <form id='singleCheckOutForm'>
                <div >
                  <input type='text' id='price' value='$price' disabled hidden>
                </div>
                  <table class='table table-responsive'>
                      <thead>
                          <tr>
                              <td>Image</td>
                              <td>Product</td>
                              <td>Price</td>
                              <td>Quantity</td>
                              <td>Total</td>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td> <img src='./pics.png' alt='$name' class='img-checkout'> </td>
                              <td>$name</td>
                              <td>N $fPrice</td>
                              <td><input type='number' value='1' class='checkout-input' id='qty' min='1'></td>
                              <td><input type='text' value='Total' class='checkout-input-total' id='total' disabled></td>
                              
                          </tr>
                          <tr>
                            <td colspan='5'>
                                <div class='form-group text-right'>
                                <input type='submit' value='Checkout' class='btn btn-jumga'>
                            </div>
                            </td>
                          </tr>
                      </tbody>
              </table>
              
            </form>
            </div>";
          }else{
              echo "PRODUCT NOT AVAILABLE AT THE MOMENT";
          }


      }else{
        echo "You are not login";
      }
      
    }


    if (isset($_POST['showCart']) && count($_SESSION['cart']) > 0) {
          echo "
                  <thead>
                  <tr>
                      <td>Image</td>
                      <td>Product</td>
                      <td>Price</td>
                      <td>Quantity</td>
                      <td>Total</td>
                  </tr>
              </thead>
              <tbody>
          ";
        foreach ($_SESSION['cart'] as $key => $value) {
             $pId = $key;
             $product_query = mysqli_query($conn, "SELECT * FROM product WHERE id=$pId");
          if (!$product_query) {
              die(error("ERROR LOADING PRODUCTS"));
          }else if(mysqli_num_rows($product_query) > 0){
            $row = mysqli_fetch_assoc($product_query);
            $fPrice = number_format($row['price']);
            $price = $row['price'];
            $name = ucwords($row['name']);
            $description = $row['description'];
            $qty = 1;
            echo "
                          <tr>
                              <td> <img src='./pics.png' alt='$name' class='img-checkout'> </td>
                              <td>$name</td>
                              <td>N $fPrice</td>
                              <td><input type='number' value='1' class='checkout-input' id='qty' min='1'></td>
                              <td><input type='text' value='Total' class='checkout-input-total' id='total' disabled></td>
                              
                          </tr>
                          <tr>";
          }

        }

        echo "
          <td colspan='5'>
          <div class='form-group text-right'>
          <input type='submit' value='Checkout' class='btn btn-jumga'>
      </div>
      </td>
    </tr>
  </tbody>
  </table>

  </form>
  </div>
        ";
    }
  ?>


  
  
  