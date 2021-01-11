<?php include './control/conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUMGA</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="./index.css">
   
</head>
<body>

    <div class="main-container">
        <nav>
            <div class="link">
                             
                <button class="btn">  
                    <span>
                        <a href=""> <i class="fa fa-shopping-cart" aria-hidden="true"></i> My Cart</a>
                    </span>
                </button>
                <button class="btn">
                
                    <span>
                        <a href=""><i class="fa fa-truck" aria-hidden="true"></i>  Orders</a>
                    </span>
                </button>
                <button class="btn">
                <span>
                 <a href=""><i class="fa fa-money" aria-hidden="true"></i> Sell on <span>JUMGA</span></a>
                    </span>
                </button>
                <button class="btn">
                <span>
                
                        <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Physical Store</a>
                    </span>
                </button>
            </div>
            <div class="action">
                <a href="./login.php" class="btn"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                <a href="./signup.php" class="btn"><i class="fa fa-user" aria-hidden="true"></i> Create Account</a>
            </div>
        </nav>
        <!-- <div class="search m-2">
            <h3> <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>JUMGA</span></h2>
           <form class="search-form" id="search-form">
              <div class="form-group">
                <input type="search" name="" id="search" placeholder="Search Products" class="form-control">
              </div>
           </form>
        </div> -->
        <div class="content">
           <div class="sidebar">

                <!-- SELECT * CATEGORY -->
                <?php
                $cQuery = mysqli_query($conn, "SELECT * FROM category WHERE category.status ='approve'");
                // print_r(mysqli_fetch_assoc($cQuery));
                if (!$cQuery) {
                    die(error("Category Fails"));
                }else if(mysqli_num_rows($cQuery) < 1){
                    echo "<option value=''>NO CATEGORY</option>";
                }else{
        
                    while ($row = mysqli_fetch_assoc($cQuery)) {
                        $title = ucwords($row['title']);
                        $id = $row['id'];
                        $title = ucwords($row['title']);
                        echo "<div class='category-link-container pl-2'>$title</div>";

                }
            }
                ?>
           </div>
           <div class="product">
           <div class="cart" id="cart">
            <?php
                $cQuery = mysqli_query($conn, "SELECT * FROM category WHERE category.status ='approve'");
                if (!$cQuery) {
                    die(error("Category Fails"));
                }else if(mysqli_num_rows($cQuery) < 1){
                    echo "<option value=''>NO CATEGORY</option>";
                }else{

                    while ($row = mysqli_fetch_assoc($cQuery)) {
                        $title = ucwords($row['title']);
                        $id = $row['id'];
                        $title = $row['title'];
                        
                        // FETCH PRODUCTS 
                        $product_query = mysqli_query($conn, "SELECT * FROM product WHERE category_id=$id");
                        if (!$product_query) {
                            die(error("ERROR LOADING PRODUCTS"));
                        }else if(mysqli_num_rows($product_query) > 0){
                            echo '<div class="cart-category" id="category-id">';
                            // echo "<h3>$title</h3>";
                            while ($row = mysqli_fetch_assoc($product_query)) {
                                $p_id = $row['id'];
                                $price = number_format($row['price']);
                                $name = ucwords($row['name']);

                                echo "<div class='cart-item'>
                                <p class='cart-name'>$name</p>
                                <div class='cart-image'>
                                    <img src='./pics.png' alt='' class=''>
                                </div>
                                
                                <div class='cart-item-details'>
                                    <div class='price'>N $price</div>
                                    <div class='title'></div>
                                    <div class='more'><a href='' id='$p_id' name='more'>More</a></div>
                                </div>
                            </div>";

                            }
                            echo '</div>';
                        }   
                    }   
                }
            ?>
    </div>
      </div>
        </div>
    </div>
    <!-- MODAL PAGE  -->
    <div class="popup-page" id="popup-page">
        <div class="popup-content" id="popup-content">
            <div class="popup-close text-right">
                <button id="btn-popup-close" class="btn-popup-close btn"><i class="fa fa-window-close" aria-hidden="true"></i></button>
            </div>
           
            <div class="popup-show" id="popup-show">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia fugit, hic voluptates sapiente impedit iure laboriosam est natus incidunt vel blanditiis suscipit nisi architecto officiis nostrum nulla dolor, porro minima? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam, fuga eligendi nam quia adipisci pariatur saepe perspiciatis ipsam esse, voluptates consequatur dolore nulla qui molestias veritatis deserunt. Error, nisi suscipit.
                Ratione porro sunt consequatur provident. Cupiditate necessitatibus sit voluptates, quos, odio obcaecati fugit optio voluptas quis tenetur libero vero, magnam cum reiciendis quas eligendi fuga adipisci est quod natus id.
                Ex quidem error ipsa sunt recusandae, quas quod voluptatum ad ipsum quisquam vel officiis nostrum delectus nam sapiente autem magnam mollitia nobis consequatur. Modi, corporis! Illo odio corrupti officiis reprehenderit.
                Quaerat, veritatis. Maiores nam est amet repellendus quas ipsum distinctio id placeat culpa consequuntur eaque ipsa, quisquam mollitia obcaecati, repellat voluptate incidunt, labore nostrum? Dolore possimus excepturi nihil amet placeat!
                Eos commodi aut voluptatibus minima culpa alias delectus, excepturi pariatur, est magnam nemo ducimus molestias sint! Inventore doloremque accusamus praesentium quo sed repudiandae nobis, modi maxime minima neque ea libero? Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, quaerat nihil! Veniam perspiciatis nobis sunt hic magni dolore nemo laboriosam cupiditate? Nam, incidunt porro. Soluta, quo minus? Magni, iure sint.
            </div>
        </div>
    </div>
    <script src="./vendor/jquery/jquery.js"></script>
    <script src="./js/sydeestack.js"></script>
    <script src="./index.js"></script>
   

</body>
</html>