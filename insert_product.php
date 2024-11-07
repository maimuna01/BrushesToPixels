<?php
  include('includes\connect.php');
  if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keyword = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // Check if the file was uploaded without errors
    if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        // Get the file details
        $product_image = $_FILES['product_image']['name'];
        $temp_image = $_FILES['product_image']['tmp_name'];
        
        // Check if any required fields are empty
        if(empty($product_title) || empty($description) || empty($product_keyword) || empty($product_category) || empty($product_price) || empty($product_image)) {
            echo "<script>alert('Empty fields! Please fill them in.')</script>";
        } else {
            // Move the uploaded file to the desired location
            move_uploaded_file($temp_image, "./images_products_admin/$product_image");

            // Escape values to prevent SQL injection
            $product_title = mysqli_real_escape_string($con, $product_title);
            $description = mysqli_real_escape_string($con, $description);
            $product_keyword = mysqli_real_escape_string($con, $product_keyword);
            $product_category = mysqli_real_escape_string($con, $product_category);
            $product_image = mysqli_real_escape_string($con, $product_image);
            $product_price = mysqli_real_escape_string($con, $product_price);

            // Insert query
            $insert_products = "INSERT INTO `artwork` (artwork_title, artwork_desc, artwork_keyword, category_id, artwork_image, artwork_price, artwork_date, artwork_status) VALUES ('$product_title', '$description', '$product_keyword', $product_category, '$product_image', $product_price, NOW(), '$product_status')";
            
            $result_query = mysqli_query($con, $insert_products);
            
            if($result_query) {
                echo "<script>alert('Successfully inserted product')</script>";
            }
        }
    } else {
        echo "<script>alert('Error uploading file')</script>";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert products-Admin</title>
  <!-- bootstrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/ all.min.css" integrity="sha512-9usAa1@IRO@HhonpyAIVpjrylPvoDwi PUiKdWk5t3PyolY1c0d4DSE@Ga +ri4AuTroPR5aQvXU9xC6q0PnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-light">
  <div class="container mt-3">
    <h1 class="text-center">Insert Products</h1>
    <!-- form -->
    <form action="" method="post" enctype="multipart/form-data"> 
      <!-- title -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_title" class="form-label">Product title</label>
        <input type="text" name="product_title" 
        id="product_title" class="form-control"
        placeholder="Enter product title" autocomplete="off" required="required">
      </div>

      <!-- description -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="description" class="form-label">Product Description</label>
        <input type="text" name="description" id="description"
        class=" form-control " placeholder="Enter product description "
        autocomplete="off"  required ="required">
      </div>

      <!-- keywords -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_keywords" class="form-label">Product Keywords </label>
        <input type="text" name="product_keywords" id="product_keywords" class="form-control"
        placeholder="Enter product keywords" autocomplete="off" required="required">
      </div>

      <!-- categories -->
      <div class="form-outline mb-4 w-50 m-auto">
        <select name="product_category" id="" class="form-select"> 
          <option value="">Select a Category</option> 
          <?php
            $select_query="SELECT * FROM category";
            $result_query=mysqli_query($con, $select_query);
            while($row=mysqli_fetch_assoc($result_query))
            { 
              $category_title=$row['category_title']; 
              $category_id=$row['category_id'];
              echo "<option value='$category_id'>$category_title</option>";
            }         
          ?>
        </select>
      </div>

      <!-- Image -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_image" class="form-label">Product image</label>
        <input type="file" name="product_image"id="product_image" class="form-control" required="required">
      </div>


      <!-- Price -->
      <div class="form-outline mb-4 w-50 m-auto">
        <label for="product_price" class="form-label">Product Price </label>
        <input type="text" name="product_price" id="product_price" class="form-control"
        placeholder="Enter product price" autocomplete="off" required="required">
      </div>

      <!-- Button -->

      <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" name="insert_product" 
        class="btn btn-info mb-3 px-3" 
        value="Add Product"> 
      </div>

</body>
</html>