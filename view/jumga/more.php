<?php 
    // print_r($_GET);
        if (isset($_GET['p']) && isset($_GET['i'])) {
            $pId = $_GET['i'];
           
                $product_query = mysqli_query($conn, "SELECT * FROM product WHERE id=$pId");
                if (!$product_query) {
                    die(error("ERROR LOADING PRODUCTS"));
                }else if(mysqli_num_rows($product_query) > 0){
                  $row = mysqli_fetch_assoc($product_query);
            
                  $price = number_format($row['price']);
                  $name = ucwords($row['name']);
                  $description = $row['description'];
                  $uId = $row['user_id'];
                  $image = $row['images'];
                  $uIQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$uId");
                  if (!$uIQuery) {
                      die("PUID FAILED ");
                  }
                  $phone = mysqli_fetch_assoc($uIQuery)['phone'];
                  echo "<div class='cart-item'>
                  <p class='cart-name'>$name</p>
                  <div class='cart-image'>
                      <img src='./users/sydeestack_$phone/$image' alt='$name' class=''>
                  </div>
                  <div class='description mt-2'>
                    <h5>Details</h5>
                    <p>$description</p>
                  </div>
                  <div class='cart-item-checkout' id='cart-item-checkout'>
                      
                      <div class='add-to-cart' id='add-to-cart'>
                        <a href='?p=cart&pid=$pId' class='btn btn-info btn-add-to-cart' name='btn-add-to-cart' id='$pId'>Add to Cart</a>
                      </div>
                      <div class='checkout' id='checkout'>
                        <a href='?p=cart&pid=$pId' class='btn btn-success btn-checkout' name='' id=''>View Cart</a>
                      </div>
                      <div>
                        <button class='btn btn-outline-dark' name='btn-like' id='$pId'><i class='fa fa-heart-o' aria-hidden='true'></i></button>
                      </div>
                  </div>
              </div>";
                }
        }
      
