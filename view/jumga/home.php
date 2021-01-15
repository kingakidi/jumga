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
                        $numRow = mysqli_num_rows($product_query);
                       
                        if (!$product_query) {
                            die(error("ERROR LOADING PRODUCTS"));

                        }else if($numRow > 0){
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
                                    <div class='more'><a href='?p=more&i=$p_id' id='$p_id' name='more'>More</a></div>
                                </div>
                            </div>";

                            }
                            echo '</div>';
                        }   
                    }   
                }
            ?>