<html lang="en">
<head>
	<title>ATN | Login</title>
	<LINK REL="SHORTCUT ICON"  HREF="images/013.svg">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="styles/login.css">
</head>

<body>
				<?php 
					session_start();				 
					include("include/connect.php");
					if(isset($_POST['login'])){
						$username = $_POST['Username'];
						$password = $_POST['Password'];
						$sql="select * from user where Username='$username' AND Password='$password'";
						$result = mysqli_query($connect, $sql);
						$check_login = mysqli_num_rows($result);						
						if ($check_login > 0 ) {
							$user = $result->fetch_object();
							if($user->Status !== "true"){
								echo"<script>alert('Account has been locked !')</script>";
								echo "<script>window.open('login.php','_self')</script>";
							}
							else {
							header("location: index.php");
							$_SESSION['Username'] = $username;
							$_SESSION['UserID'] = $user->UserID;
							}
						} 	
					}

				?>
<div class="container-fluid">
	<div class="container">
		<div class="row justify-content-center" id="logo">
			<a class="col col-4" href="index.php">
				<div class="row">
					<img class="col col-12" src="images/013.svg">						
				</div>
			</a>				
		</div>
		<div class="row">
			<div class="col">
				<div class="row d-flex justify-content-center">
					<h1 class="col col-12">Login</h1>	
				</div>
				<div class="row d-flex justify-content-center">
					<form class="col col-4" method="post">
  						<div class="form-group">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" name="Username" placeholder="Username">
  						</div>
  						<div class="form-group">
  							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-lock"></i></span>
							</div>
							<input type="Password" class="form-control" name="Password" placeholder="Password" id="pass">
  						</div>
  						<div>
  						<?php
							if(isset($_POST['login'])){ 
								if ($check_login == 0){
									echo "<span style='color: red; font-size:18px; padding-bottom: 20px;'>Password or Username is incorrect, please try again !</span>";
								}
							}
  						?>  							
  						</div>

  						<div class="row justify-content-center">
  							<button  type="submit" class="btn btn-primary col col-4" name="login" value="login">Login</button>
  						</div>
					</form>						
				</div>
				<div class="row d-flex justify-content-center">
					<!-- <p class="col-12 register">Don't have an account? <a href="register.php" style="color: white;">Register here!</a></p> -->
				</div>	
			</div>

		</div>		
	</div>	
</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>