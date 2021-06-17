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

<?php include("../include/header-user.php"); ?>
<div class="container">
  <div class="row justify-content-center">
      <h4 style="margin: 10px 0px;">Add/Edit Establishment</h4>
  </div>
  <?php 
  $userID = $_GET['user-edit'] ?? null;
  if ($userID != null){
  
  $sql= "select*from user where UserID= $userID";
  $result=$connect->query($sql);
  $user=$result->fetch_object();
}

  
  ?>

  <div class="row justify-content-center">
    <form class="col-6" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <input type="text" class="form-control" name="UserName" value="<?php if ($userID != null){ echo "$user->UserName";} ?>" required="" placeholder="Username">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="Password"  value="<?php if ($userID != null){ echo "$user->Password";} ?>" required="" placeholder="Password">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="FullName" required="" value="<?php if ($userID != null){ echo "$user->FullName"; }?>" placeholder="Establishment name">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="PhoneNumber" required=""  value="<?php if ($userID != null){ echo "$user->PhoneNumber";} ?>" placeholder="Hotline">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="Address" required=""  value="<?php if ($userID != null){echo "$user->Address"; }?>"  placeholder="Address">
      </div>
      <div class="form-group">
        <input type="file" class="select-avatar" name="Image" required=""  value="<?php if ($userID != null){ echo "$user->AvataImage"; }?>"  placeholder="Avatar">
      </div>
      <div class="form-group select-type row">
        <div class="col-4">
          <p>Permission:</p> 
        </div>
        <div class="col-4">
          <input type="radio" id="admin" name="checkAdmin" required=""  <?php if( $userID != null ){if($user->Permission == 1){ echo"checked";}} ?>  value="1">
          <label for="admin">Admin</label>  
        </div>
        <div class="col-4">
          <input type="radio" id="user" name="checkAdmin"  required="" <?php if( $userID != null ){if($user->Permission == 0){ echo"checked";}} ?> value="0">
          <label for="user">No</label>
        </div>
      </div>
      <div class="form-group select-type row">
        <div class="col-4">
          <p>Status:</p> 
        </div>
        <div class="col-4">
          <input type="radio" id="status-1" name="checkStatus" required=""  <?php if( $userID != null ){if($user->Status == "true"){ echo"checked";}} ?>  value="true">
          <label for="status-1">True</label>  
        </div>
        <div class="col-4">
          <input type="radio" id="status-2" name="checkStatus"  required="" <?php if( $userID != null ){if($user->Status !== "true"){ echo"checked";}} ?> value="false">
          <label for="status-2">False</label>
        </div>
      </div>
      <div class="row action" style="margin-bottom:20px;">
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
            $file = $_FILES['Image']['name'];
            $file_tmp = $_FILES['Image']['tmp_name'];
            $path = "../../images/";
            include("../../include/newname.php"); 
            move_uploaded_file($file_tmp, newName($path,$file));
            $username = $_POST['UserName'];
            $password = $_POST['Password'];
            $fullname = $_POST['FullName'];
            $address= $_POST['Address'];
            $phone= $_POST['PhoneNumber'];
            $checkadmin = $_POST['checkAdmin'];
            $checkstatus = $_POST['checkStatus'];
            $sql1="select * from user where UserName='$username'";
            $result1 = mysqli_query($connect, $sql1);
            $check_user = mysqli_num_rows($result1);
            if ($check_user > 0 ) {
                echo "<div  class='col-12 check' >
                <small>Add failed, username available</small>
                </div>";  
            }
            else {
              $sql="insert into user values ('','$username','$password','$fullname','$phone','$address','$file','$checkadmin','$checkstatus')";
              $result = mysqli_query($connect, $sql);
              if ($result) {
                echo "<script>alert('Add establishment successfull!')</script>";
                echo "<script>window.open('user.php','_self')</script>";
              }
              else {
                echo "<script>alert('Error')</script>";
              }
            }
          }
          if(isset($_POST['edit'])){
            $file = $_FILES['Image']['name'];
            $file_tmp = $_FILES['Image']['tmp_name'];
            $path = "../../images/";
            include("../../include/newname.php"); 
            move_uploaded_file($file_tmp, newName($path,$file));
            $username = $_POST['UserName'];
            $password = $_POST['Password'];
            $fullname = $_POST['FullName'];
            $address= $_POST['Address'];
            $phone= $_POST['PhoneNumber'];
            $checkadmin = $_POST['checkAdmin'];
            $checkstatus = $_POST['checkStatus'];
            $sql1="select * from user where UserName='$username'";
            $result1 = mysqli_query($connect, $sql1);
            $check_user = mysqli_num_rows($result1);
            if ($check_user > 0 &&  $username != $user->UserName ) {
                echo "<div  class='col-12 check' >
                <small>Edit failed, username available</small>
                </div>";  
            }
            else {
              $sql="update user set UserName= '$username', Password='$password', FullName='$fullname', PhoneNumber='$phone', Address='$address', AvataImage='$file', Permission='$checkadmin', Status='$checkstatus' where UserID='$userID';";

              $result = mysqli_query($connect, $sql);
              if ($result) {
                echo "<script>alert('Edit establishment successfull!')</script>";
                echo "<script>window.open('user.php','_self')</script>";
              }
              else {
                echo "<script>alert('Error')</script>";
              }
            }
          }
        ?>  

  </div> 

</div>
</body>
</html>