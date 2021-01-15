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
    <?php 
    // print_r($_SESSION['cart']);
      
    ?>

    <div class="main-container">
        <nav>
           
            <div class="link">
                             
                <button class="btn" id="btn-show-cart-number">  
                    <span >
                        <a href="" id="link-show-cart-number"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> My Cart
                        
                        <?php
                            if (isset($_SESSION['cart'])) {
                                $cartCount = count($_SESSION['cart']);
                                echo "<span id='show-cart-number'> $cartCount </span></a>";
                            }else{
                                echo '<span id="show-cart-number"></span></a> ';
                            }
                        ?>
                        
                    </span>
                </button>
                <?php
                    if (isset($_SESSION['juId'])) {
                        echo '
                        <button class="btn">
                
                        <span>
                            <a href=""><i class="fa fa-truck" aria-hidden="true"></i>  Orders</a>
                        </span>
                    </button>
                    <button class="btn">
                    <span>
                     <a href=""><i class="fa fa-money" aria-hidden="true"></i> Sell on JUMGA</a>
                        </span>
                    </button>
                    <button class="btn">
                    <span>
                    
                            <a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Physical Store</a>
                        </span>
                    </button>';
                    }

                ?>
                
            </div>
            <div class="action">
            <?php
                if (isset($_SESSION['juId'])) {
                   echo ' <a href="./dashboard/" class="btn"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>';
                }else{
                    echo '
                    <a href="./login.php" class="btn"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                    <a href="./signup.php" class="btn"><i class="fa fa-user" aria-hidden="true"></i> Create Account</a>
                    ';
                }
            
            ?>
               
            </div>
        </nav>
      
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

                        
                        if (isset($_GET['p'])) {

                            $p = $_GET['p'];
                            switch ($p) {
                                case 'more':
                                    include "./view/jumga/more.php";
                                    break;
                                case 'checkout':
                                    include "./view/jumga/checkout.php";
                                    break;
                                case 'cart':
                                    include "./view/jumga/cart.php";
                                    break;
                                default:
                                include "./view/jumga/home.php";
                                    break;
                            }                            
                        }else {
                            include "./view/jumga/home.php";
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
    <!-- <script src="./index.js"></script> -->
   

</body>
</html>