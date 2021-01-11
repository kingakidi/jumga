<?php 
    include "./functions.php";
    $userid = $_SESSION['juId'];
    if (isset($_POST['aPForm'])) {
        $name =  checkForm($_POST['name']);
        $des =   trim(mysqli_escape_string($conn, ($_POST['des'])));
        $price = checkForm($_POST['price']);
        $cat = checkForm($_POST['cat']);
        $qty = checkForm($_POST['qty']);
        if (!empty($name) && !empty($des) && !empty($price) && !empty($cat) && !empty($qty)) {
        //    CHECK IF PRODUCT ALREADY EXIST WITH THE SAME MERCHANT 
                $pCQuery = mysqli_query($conn, "SELECT * FROM `product` WHERE product.name='$name' AND product.user_id='$userid'");
                if (!$pCQuery) {
                    die(error("Product Verification Failed ").mysqli_error($conn));
                }else{
                    
                    if (mysqli_num_rows($pCQuery) > 0) {
                        echo error("YOU HAVE ALREADY ADD THIS PRODUCT");
                    }else{
                        // INSERT THE PRODUCT INTO DB
                        $sql = "INSERT INTO `product`(`user_id`, `name`, `description`, `category_id`, `qty`, `price`, `images`) VALUES ($userid, '$name', '$des', $cat, $qty, $price,'product.jpg')";
                        if (!mysqli_query($conn, $sql)) {
                            die(error("Production upload failed try again ".mysqli_error($conn)));
                        }else{
                            echo info("Product Added successfully");
                        }


                    }
                }
        }else{
            echo error("ALL FIELDS REQUIRED");
        }
    }

    // ALL PRODUCTS TABLES 


    if (isset($_POST['allProducts'])) {
        
        $aPQuery = mysqli_query($conn, "SELECT * FROM product");
        if (!$aPQuery) {
            die(error("PRODUCT FETCH FAILS ".mysqli_error($conn)));
        }else if(mysqli_num_rows($aPQuery) < 1){
            echo error("<h2 class='m-3'>NO PRODUCT UPLOADED</h2>");
        }else{
?>
<table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>MERCHANT NAME</th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>PRICE</th>
                <th>QTY UPLOADED</th>
                <th>IMAGE</th>
                <th>CATEGORY</th>
                <th>DATE</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
<?php
            // BRING PRODUCTS TABLES 
            $sn = 1;
            while ($row = mysqli_fetch_assoc($aPQuery)) {
                $mid = $row['user_id'];
                $n = $row['name'];
                $des = $row['description'];
                $p = $row['price'];
                $q = $row['qty'];
                $c = $row['category_id'];
                $image = $row['images'];
                $date = $row['date'];

                echo "<tr>
                <td>$sn</td>
                <td>$mid</td>
                <td>$n</td>
                <td>$des</td>
                <td>$p</td>
                <td>$q</td>
                <td>$image</td>
                <td>$c</td>
                <td>$date</td>
                <td>Action</td>
            </tr>";
            $sn++;
            }

            echo "   </tbody>
            </table>";
        }
    }

    ?>
    
    <?php
    // MY PRODUCTS 

            if (isset($_POST['myProducts'])) {
                
                $aPQuery = mysqli_query($conn, "SELECT * FROM product WHERE user_id=$userid");
                if (!$aPQuery) {
                    die(error("PRODUCT FETCH FAILS ".mysqli_error($conn)));
                }else if(mysqli_num_rows($aPQuery) < 1){
                    echo error("<h2 class='m-3'>NO PRODUCT UPLOADED</h2>");
                }else{
        ?>
        <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>PRICE</th>
                        <th>QTY UPLOADED</th>
                        <th>IMAGE</th>
                        <th>CATEGORY</th>
                        <th>DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
        <?php
                    // BRING PRODUCTS TABLES 
                    $sn = 1;
                    while ($row = mysqli_fetch_assoc($aPQuery)) {
                        $mid = $row['user_id'];
                        $n = $row['name'];
                        $des = $row['description'];
                        $p = $row['price'];
                        $q = $row['qty'];
                        $c = $row['category_id'];
                        $image = $row['images'];
                        $date = $row['date'];

                        echo "<tr>
                        <td>$sn</td>
                        <td>$n</td>
                        <td>$des</td>
                        <td>$p</td>
                        <td>$q</td>
                        <td>$image</td>
                        <td>$c</td>
                        <td>$date</td>
                        <td>Action</td>
                    </tr>";
                    $sn++;
                    }

                    echo "   </tbody>
                    </table>";
                }
            }

    // ADDING CATEGORY 
    if (isset($_POST['catAdd'])) {
        $cn = checkForm($_POST['cn']);
        $p = checkPass($_POST['p']);
       
        // CHECK IF ALL FIELD IS FILLED

        if (!empty($cn) && !empty($p)) {
            // CHECK IF CATEGORY ALREADY EXIST 
            $cCQuery = mysqli_query($conn, "SELECT * FROM category WHERE title='$cn'");
            if(!$cCQuery){
                die(error('CATEGORY CHECK FAILED ').mysqli_error($conn));
            }else if(mysqli_num_rows($cCQuery) > 0){
                echo error("CATEGORY ALREADY EXIST");
                exit();
            }else{
                // CHECK IF PASSWORD IS CORRECT
                $uQuery = mysqli_query($conn, "SELECT * FROM users WHERE id=$userid");
                $row = mysqli_fetch_assoc($uQuery);
                $dbPassword = $row['password'];
                
                if (password_verify($p, $dbPassword)) {
                //   UPDATE THE CATEGORY 

                    $category_query = mysqli_query($conn, "INSERT INTO `category`(`title`, `status`) VALUES ('$cn', 'approve')");
                    if (!$category_query) {
                        die(error("CATEGORY FAIL ").mysqli_error($conn));
                    }else{
                        echo info("CATEGORY ADDED SUCCESSFULLY");
                    }

                }else{
                    echo error("INVALID PASSWORD");
                }
                
            }
        }else{
            echo error("ALL FIELD REQUIRED");
        }
    }

    if (isset($_POST['viewCat'])) {
    
            // SELECT ALL CATEGORY 
            $category_query = mysqli_query($conn, "SELECT * FROM category");
            if (!$category_query) {
                die(error("CATEGORY QUERY FAILED ").mysqli_error($conn));
            }else if(mysqli_num_rows($category_query) < 1){
                echo info("<h2>NO CATEGORY</h2>");
            }else{
                echo '<table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>NAME</th>
                        <th>NO OF PRODUCTS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>';
                $sn = 1;
              while ($row = mysqli_fetch_assoc($category_query)) {
                  $id = $row['id'];
                  $title = ucwords($row['title']);

                echo "<tr>
                        <td>$sn</td>
                        <td>$title</td>
                        <td>78</td>
                        <td>Action</td>
                    </tr>";
                $sn++;
              } 
              echo '</tbody>
              </table>';
            }
        }

?>          

        
  