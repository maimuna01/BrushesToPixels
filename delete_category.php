<?php
  if(isset($_GET['delete_category'])){
    $delete_category=$_GET['delete_category']; 
    $delete_query="DELETE FROM `category` where category_id=$delete_category"; 
    $result=mysqli_query($con, $delete_query);

    if ($result)
      echo "<script>alert('category deleted successfully')</script>"; 
      echo "<script>window.open('./admin-dashboard.php', '_self')</script>";
  }
?>
