<div class="container header">
<nav class="navbar navbar-expand-md bg-info navbar-dark">
  <a class="navbar-brand" href="index.php"><img class='logo' src="../images/013.svg"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="user/user.php">Manage facilities</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product/pro.php">Manage product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="category/cat.php">Manage category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="his.php">Transaction history</a>
      </li>   
    </ul>
    <ul class='navbar-nav'>
<?php  
  include("../include/connect.php");
  session_start();
  if (isset($_SESSION['Username']) && $_SESSION['Username'] != null){
    $Username = $_SESSION['Username'];
    $sql=" select * from user where Username = '$Username' AND Permission='1' ";
    $result = mysqli_query($connect, $sql);
    $check_permission = mysqli_num_rows($result);
    if ($check_permission > 0) {
      $row_user =  mysqli_fetch_array($result);
      $avatar = $row_user['AvataImage'];
      echo "
      <li class='nav-item dropdown'>
        <a class='nav-link  dropdown-toggle' href='#'' id='navbardrop' data-toggle='dropdown'>
          <img class='avatar' src='../images/$avatar'>
        </a>
        <div class='dropdown-menu'>
          <a class='dropdown-item' href='../index.php'>User Page</a>        
          <a class='dropdown-item' href='../logout.php'>Logout</a>        
        </div>
      </li>
      ";
    }
    else {
      header("location:../index.php");  
    }
  }
  else{
    header("location: ../index.php");   
  }
 ?> 
</ul>
  </div> 
</nav>
</div>