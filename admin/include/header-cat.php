<div class="container header">
<nav class="navbar navbar-expand-md bg-info navbar-dark">
  <a class="navbar-brand" href="../index.php"><img class='logo' src="../../images/013.svg"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../user/user.php">Manage establishment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../product/pro.php">Manage product</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="cat.php">Manage category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../his.php">Transaction history</a>
      </li>   
    </ul>
<?php  
  include("../../include/connect.php");
  include("header.php");
?>
  </div> 
</nav>
</div>