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

<?php include("../include/header-cat.php"); ?>
<div class="container">
  <div class="row justify-content-center main">
      <h4 style="margin: 10px 0px;">Add/Edit Category</h4>
  </div>
  <?php 
  $catID = $_GET['cat-edit'] ?? null;
  if ($catID != null){
  
  $sql= "select*from category where CategoryID= $catID";
  $result=$connect->query($sql);
  $cat=$result->fetch_object();
}

  
  ?>

  <div class="row justify-content-center main" style="padding-bottom: 20px;">
    <form class="col-6" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" class="form-control" name="CatName" value="<?php if ($catID != null){echo "$cat->CategoryName"; }?>" required="" placeholder="Category Name">
      </div>
      
      <div class="row action">
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

            $CatName = $_POST['CatName'];
              $sql="insert into category values ('','$CatName')";
              $result = mysqli_query($connect, $sql);
              if ($result) {
                echo "<script>alert('Add category successfull!')</script>";
                echo "<script>window.open('cat.php','_self')</script>";
              }
              else {
                echo "<script>alert('Error')</script>";
                echo "<script>window.open('cat.php','_self')</script>";
              }
          }


          if(isset($_POST['edit'])){

            $CatName = $_POST['CatName'];

            $sql="update category set CategoryName='$CatName' where CategoryID='$catID';";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                echo "<script>alert('Edit category successfull!')</script>";
                echo "<script>window.open('cat.php','_self')</script>";
            }
            else {
                echo "<script>alert('Error')</script>";
                echo "<script>window.open('cat-edit.php?cat-edit=$catID','_self')</script>";

              }

          }
        ?>  

  </div> 

</div>
</body>
</html>