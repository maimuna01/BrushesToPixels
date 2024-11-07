<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
 
    
    <!-- fonts google  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;600;700&family=Outfit:wght@200;300;600&family=Rubik+Mono+One&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
   
    <style>
      .product_img{ 
        width:50%;
      }
    </style>
</head>
<body>

  <h3 class="text-center text-success">All products</h3>
  <table class="table table-bordered mt-5">
    <thead class="bg-info">
      <tr>
        <th>Artwork ID</th>
        <th>Artwork Title</th>
        <th>Artwork Image</th>
        <th>Artowrk Price</th>
        <th>Total Sold</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody class="bg-secondary text-light">
      <?php

        $get_products="SELECT * FROM `artwork`"; 
        $result=mysqli_query($con, $get_products);
        $number=0;
        while($row=mysqli_fetch_assoc($result))
        { 
          $product_id=$row['artwork_id'];
          $product_title=$row['artwork_title'];
          $product_image=$row['artwork_image'];
          $product_price=$row['artwork_price'];
          $status=$row['artwork_status'];
          $number++;
      
          ?>
          
         <tr>
          <td><?php echo "$number"?></td>
          <td><?php echo "$product_title"?></td>
          <td><img src='./images_products_admin/<?php echo "$product_image'"?> class='product_img'</td>
          <td><?php echo "$product_price"?></td>
          <td>
            <?php
              $get_count="SELECT * FROM `pending_orders` where artwork_id=$product_id"; 
              $result_count=mysqli_query($con, $get_count);
              $rows_count=mysqli_num_rows($result_count);
              echo $rows_count; 
              
              ?>
            </td>
          <td><?php echo "$status"?></td>
          <td><a href='admin-dashboard.php?edit_products=<?php echo $product_id ?>' class='text-light'>Add icon </a></td>
          <td><a href='admin-dashboard.php?delete_product=<?php echo $product_id ?>' class='text-light'>Add icon </a></td>
          </tr> 
        <?php
        }     
      ?>
    </tbody>
</body>
</html>

