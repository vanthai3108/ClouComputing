<!DOCTYPE html>
<html>
<head>
  <title>ATN | Admin</title>
	<LINK REL="SHORTCUT ICON"  HREF="../../images/013.svg">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body>

<?php include("../include/header-pro.php"); ?>
<div class="container">
  <div class="row justify-content-center main" style="padding-bottom: 20px;">
      <h4 style="margin: 10px 0px;">Add/Edit Product</h4>
  </div>
  <?php 
  $proID = $_GET['pro-edit'] ?? null;
  if ($proID != null){
  
  $sql= "select*from product where ProductID= $proID";
  $result=$connect->query($sql);
  $pro=$result->fetch_object();
}

  
  ?>

  <div class="row justify-content-center main">
    <form class="col-6" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" class="form-control" name="ProductName" value="<?php if ($proID != null){echo "$pro->ProductName"; }?>" required="" placeholder="Product Name">
      </div>
      <div class="form-group">
        <label>Select Product Image</label>
        <input type="file" class="select-avatar" class="form-control" name="ProductImage"  value="" required="" placeholder="Product Image">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" name="ProductPrices" required=""  value="<?php if ($proID != null){echo "$pro->ProductPrices"; }?>"  placeholder="Product Prices">
      </div>
      <div class="form-group">
    
        <select class="form-control" name="CatID">
          <?php 
          $sql= "select*from category";
          $result=$connect->query($sql);
          while ($cat = $result->fetch_object()) {
            echo"<option value='$cat->CategoryID'";
            if ($proID != null){
            if ($pro->CategoryID == $cat->CategoryID) {
              echo "selected='selected'";
            }
          }
            echo ">$cat->CategoryName</option>";
          }

          ?>
  
    </select>
  </div>
      <div class="form-group">
        <textarea name="ProductScript" placeholder="Product Description" class="form-control" rows="10"><?php if ($proID != null){echo "$pro->ProductScript"; }?></textarea>
      </div>
      
      <div class="row action" style="padding-bottom: 20px;">
        <div class="col-6">
          <button type="submit" name="add" class="btn btn-primary btn-block">Add</button>
        </div>
        <div class="col-6">
          <button type="submit" name="edit" class="btn btn-primary btn-block">Edit</button>
        </div>

      </div>
    </form>
        <?php  
          if(isset($_POST['add'])){
            $file1 = $_FILES['ProductImage']['name'];
            $file_tmp1 = $_FILES['ProductImage']['tmp_name'];
            $path1 = "../../images/";
            include("../../include/newname.php"); 
            move_uploaded_file($file_tmp1, newName($path1,$file1));
            $ProductName = $_POST['ProductName'];
            $ProductScript = $_POST['ProductScript'];
            $ProductPrices = $_POST['ProductPrices'];
            $catID = $_POST['CatID'];

              $sql="insert into product values ('','$ProductName','$ProductScript','$file1', '$ProductPrices', 0,'$catID')";
              $result = mysqli_query($connect, $sql);
              if ($result) {
                echo "<script>alert('Add product successfull!')</script>";
                echo "<script>window.open('pro.php','_self')</script>";
              }
              else {
                echo "<script>alert('Error')</script>";
                echo "<script>window.open('pro-edit.php','_self')</script>";
              }
          }
          if(isset($_POST['edit'])){
            $file1 = $_FILES['ProductImage']['name'];
            $file_tmp1 = $_FILES['ProductImage']['tmp_name'];
            $path1 = "../../images/";
            include("../../include/newname.php"); 
            move_uploaded_file($file_tmp1, newName($path1,$file1));
            $ProductName = $_POST['ProductName'];
            $ProductScript = $_POST['ProductScript'];
            $ProductPrices = $_POST['ProductPrices'];

            $catID = $_POST['CatID'];
            $sql="update product set ProductName='$ProductName', ProductScript='$ProductScript',ProductImage='$file1',ProductPrices='$ProductPrices', CategoryID='$catID' where ProductID='$proID';";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                echo "<script>alert('Edit product successfull!')</script>";
                echo "<script>window.open('pro.php','_self')</script>";
            }
            else {
                echo "<script>alert('Error')</script>";
                echo "<script>window.open('pro-edit.php?pro-edit=$proID','_self')</script>";
              }

          }
        ?>  

  </div> 

</div>
</body>
</html>