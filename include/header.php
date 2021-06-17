<div class="container menu">
    <nav class="navbar navbar-expand-sm bg-info navbar-dark">
        <a class="navbar-brand" href="index.php"><img src="images/013.svg" alt="logo" style="height:50px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Top Sales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">New!</a>
                </li>
            </ul>
            <form class="form-inline mr-auto" method="get" action="index.php" id="form-inline" style="margin-bottom:0px;">
                <input class="form-control mr-sm-2" style="max-width: 400px;" type="text" name="key" placeholder="Search product">
                <button class="btn btn-success" style="height: 38px;" type="submit"><i class="fas fa-search"></i></button>
            </form>
            
            <ul class="navbar-nav">
                
            <?php 
	            session_start();
	            include("include/connect.php"); 
	            if (isset($_SESSION['Username']) && $_SESSION['Username'] != null){
  	                $Username = $_SESSION['Username'];
  	                $sql=" select * from user where Username = '$Username' ";
  	                $result = mysqli_query($connect, $sql);
	                $row_user =  mysqli_fetch_array($result);
	                $avatar = $row_user['AvataImage'];
                    $sql2="select * from user where Username='$Username' AND Permission='1'";
                    $result2 = mysqli_query($connect, $sql2);
                    $check_permission = mysqli_num_rows($result2);
	                echo "
                        <li class='nav-item'>
                            <a class='nav-link' href='cart.php'><i class='fas fa-shopping-cart fa-2x'></i></a>
                        </li>
		                <li class='nav-item dropdown avatar'>
                            <a class='nav-link  dropdown-toggle' href='#'' id='navbardrop' data-toggle='dropdown'>
                                <img src='images/$avatar'>
                            </a>
                            <div class='dropdown-menu'>
        
	                    ";
                    if ($check_permission > 0) {
                        echo "<a class='dropdown-item' href='admin/index.php'>Admin</a>";
                    }
                    echo "<a class='dropdown-item' href='#'>Profile</a>
                            <a class='dropdown-item' href='logout.php'>Logout</a>        
                        </div>
                        </li>";
	
	            }
	            else{
		            echo"
                    <li class='nav-item'>
                        <a class='nav-link' href='login.php'>Login</a>
                    </li>
	                    		
		            ";   
                    // <li class='nav-item'>
                    //     <a class='nav-link' href='register.php'>Register</a>
                    // </li>  	
	            }

            ?>	
            </ul>
        </div>
    </nav>
</div>