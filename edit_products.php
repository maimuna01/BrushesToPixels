<?php
  if(isset($_GET['edit_products']))
  {
    $edit_id=$_GET['edit_products'];
    $get_data="SELECT * FROM `artwork` where artwork_id=$edit_id"; 
    $result=mysqli_query($con, $get_data);
    $row=mysqli_fetch_assoc($result);
    $product_title=$row['artwork_title'];
    //echo $product_title;
    $product_description=$row['artwork_desc']; 
    $product_keywords=$row['artwork_keyword']; 
    $category_id=$row['category_id'];
    $product_image=$row['artwork_image'];
    $product_price=$row['artwork_price'];
   }

  // fetchig category name
  $select_category="SELECT * FROM  `category` where category_id=$category_id"; 
  $result_category=mysqli_query($con, $select_category);
  $row_category=mysqli_fetch_assoc($result_category); 
  $category_title=$row_category['category_title'];
  // echo $category_title;

   
?>

  <div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-outline w-50 m-auto mb-4 ">
        <label for="product_title" class="form-label">Product Tiltle</label>
        <input type="text" id="product_title" name="product_title" class="form-control" value="<?php echo $product_title?>">
      </div>
      <div class="form-outline w-50 m-auto mb-4 ">
        <label for="product_desc" class="form-label">Product Description</label>
        <input type="text" id="product_desc" name="product_desc" class="form-control"  value="<?php echo $product_description?>">
      </div>
      <div class="form-outline w-50 m-auto mb-4">
        <label for="product_keyword" class="form-label">Product Keywords</label>
        <input type="text" id="product_keyword" name="product_keyword" class="form-control" value=<?php echo $product_keywords?>>
      </div>
      <div class="form-outline w-50 m-auto mb-4">
        <label for="product_category" class="form-label">Product Category</label>
        <select name="product_category" id="product_category" class="form-select">
          <option value="<?php echo $category_title?>"><?php echo $category_title?></option>
          
          <?php

            $select_category_all="SELECT * FROM  `category`";
            $result_category_all=mysqli_query($con, $select_category_all);
            while($row_category_all=mysqli_fetch_assoc($result_category_all))
            { 
              $category_title=$row_category_all['category_title']; 
              $category_id=$row_category_all['category_id'];
              echo " <option value='$category_id'>$category_title</option>";
         
            };
             ?>
          
       
        </select>
      </div>

      <!-- <div class="form-outline w-50 m-auto mb-4">
        <label for="product_image1" class="form-label">Product Image </label> -->
        <!-- <div class="d-flex">
          <input type="file" id="product_image" name="product_image" class="form-control w-90 m-auto" required="required">
          <img src="./images/product.png" alt="img" class="product_img">
        </div> 
      </div> -->
      <div class="form-outline w-50 m-auto mb-4 ">
        <label for="product_price" class="form-label">Product Price</label>
        <input type="text" id="product_price" name="product_price" class="form-control" value="<?php echo $product_price?>">
      </div>
      <div class="text-center"><input type="submit" name="edit_product" value="update product"></div>
    </form>
  </div>
  
 
  <!-- update  -->

  <?php
  
  if(isset($_POST['edit_product'])){
    $product_title=$_POST['product_title']; 
    $product_desc=$_POST['product_desc'];
    $product_keywords=$_POST['product_keyword'];
    $product_category=$_POST['product_category']; 
    $product_price=$_POST['product_price'];

        
    // query to update products
    $update_product="UPDATE `artwork` set artwork_title='$product_title', artwork_desc='$product_desc', artwork_keyword='$product_keywords', 
    category_id='$product_category', artwork_price='$product_price', artwork_date=NOW() where artwork_id=$edit_id";
    
    $result_update=mysqli_query($con,$update_product);

    if($result_update){
      echo" <script>alert('products updated successfully')</script> ";
      echo" <script>window.open('./admin-dashboard.php', '_self')</script> ";
    }
    }
   
    
    
  
  ?>