  <ul class='navbar-nav'>
      <?php 
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
        <img class='avatar' src='../../images/$avatar'>
      </a>
      <div class='dropdown-menu'>
        <a class='dropdown-item' href='../../index.php'>User Page</a>        
        <a class='dropdown-item' href='../../logout.php'>Logout</a>        
      </div>
    </li>
  ";
}
  else {
    header("location: ../../index.php");  
  }
  
  }
  else{
    header("location: ../../index.php");   
   }
     ?> 
    </ul>