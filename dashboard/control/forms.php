<?php 
     include "./functions.php";
    if (isset($_POST['aPForm'])) {
        
        echo '
                <form enctype="multipart/form-data" class="addProduct" id="addProduct">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" placeholder="Product Name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="des">Description</label>
                        <textarea name="" id="des" cols="20" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" placeholder="Price" id="price">
                    </div>
                    <div class="form-group">
                        <label for="qty">Quantity Available</label>
                        <input type="number" class="form-control" placeholder="Quantity Available" id="qty">
                    </div>
                    <div class="form-group">
                        <label for="cat">Select Category</label>
                        <select name="category" id="cat" class="form-control">
                        <option value="" selected disabled>Select Category</option>';


                        // CATEGORY SELECTION 

                        $cQuery = mysqli_query($conn, "SELECT * FROM category WHERE category.status ='approve'");
                        if (!$cQuery) {
                            die(error("Category Fails"));
                        }else if(mysqli_num_rows($cQuery) < 1){
                            echo "<option value=''>NO CATEGORY</option>";
                        }else{

                            while ($row = mysqli_fetch_assoc($cQuery)) {
                                $title = ucwords($row['title']);
                                echo $title;
                                $id = $row['id'];
                                echo "<option value='$id'>$title</option>";
                            }
                            
                        }

                    echo '
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="p-image">Select Images </label>
                        <input type="file" name="p-image" id="p-image" class="file">
                    </div>
                    <div class="error" id="pfError"></div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-info" id="btn-pf">Add</button>
                    </div>
                </form>
       ';

    }

    if (isset($_POST['aCForm'])) {
       echo '<form class="category-form" id="category-form">
       <div class="form-group">
           <label for="category-name"> Category Name</label>
           <input type="text" class="form-control" placeholder="Category Name" id="category-name">
       </div>
       <div class="form-group">
           <label for="password">Password</label>
           <input type="password" class="form-control" id="password" placeholder="Password">
       </div>
       <div class="error error-cf text-center" id="error-cf"></div>
       <div class="form-group text-right">
            <button type="submit" id="btn-af" class="btn btn-info">Add</button>
       </div>
   </form>';
    }
?>

