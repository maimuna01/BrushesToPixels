<?php 


  if(isset($_GET['delete_product']))
  { 
    $delete_id=$_GET['delete_product'];
    $delete_product="DELETE FROM  `artwork` where artwork_id=$delete_id"; 
    $result_product=mysqli_query($con, $delete_product);
    if ($result_product)
    echo "<script>alert('Product deleted successfully')</script>"; 
    echo "<script>window.open('./admin-dashboard.php', '_self')</script>";

  }

?>