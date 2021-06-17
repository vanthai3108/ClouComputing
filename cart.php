<html>
<head>
<title>ATN</title>
	<LINK REL="SHORTCUT ICON"  HREF="images/013.svg">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="styles/header.css"> 
    <link rel="stylesheet" href="styles/cart.css"> 
</head>

<body>
	<?php include("include/header.php"); ?>
	<?php 
	if ( !isset($_SESSION['Username']) || $_SESSION['Username'] == null){
		header("location: index.php");
	}
	else {
		$Username = $_SESSION['Username'];
		$sql = " SELECT * FROM user WHERE UserName = '$Username'";
		$result = $connect->query($sql);
		$user =  $result->fetch_object();
		$userID = $user->UserID;
	}
	?>
<div class="container main">

		<div class="row justify-content-center">
							<div class="col col-12">
								<h2 style="text-align:center;">Cart</h2>
							</div>			
						</div>
		<div class="row cart">
			<form method="post" class="col">
				<div class="row justify-content-center">			
			<?php 
				include("include/connect.php");			 						
				$sql1 = " SELECT * FROM cart, product WHERE cart.ProductID= product.ProductID AND UserID=$userID";
				$result1 = $connect->query($sql1);
				while ($cart =  $result1->fetch_object()){
					echo "
                    <div class='col col-3'>
                    <div class='row justify-content-center'>
                        <div class='card col col-11 item'>
                            <div class='row justify-content-center'>
                                <img class='card-img-top col col-10 item-img' src='images/$cart->ProductImage' alt='Card image'>
                            </div>
                            <div class='card-body'>
                                <h6 class='card-title'>$cart->ProductName</h6>    
                                <p class='card-text'>Prices: <span>$cart->ProductPrices</span>$</p>
								<div class='row number'>
									<p class='col-6'>Quantily: </p>
									<input class='col-4' name='number-$cart->CartID' type='number' min='1' value='1'>
								</div>                         
                                <a href='cart.php?del-cart=$cart->CartID' class='btn btn-primary btn-block'>Delete</a>
                            </div>
                        </div>
                    </div>
                    </div>
					";
				}
				?>
				</div>
					
				<div class="row justify-content-center">
					<div class="col col-7 pay">
						<button name="pay" class="btn btn-primary btn-block">Order Now</button>	
					</div>
				</div>
				<?php
			if (isset($_GET["del-cart"])) {	
				$cartID = intval($_GET['del-cart']);
				$UserID = $_SESSION['UserID'];
				$sql4="select*from cart where CartID=$cartID";
				$result4 = mysqli_query($connect, $sql4);
				$cart = $result4->fetch_object();
				$userCart = $cart->UserID;
				if ($UserID ==$userCart) {
					$sql5="delete from cart where CartID=$cartID";
					$result5 = mysqli_query($connect, $sql5);
					if ($result) {
						echo "<script>window.open('cart.php','_self')</script>";	
					}
					else {
						echo "<script>alert('Error')</script>";
						echo "<script>window.open('cart.php','_self')</script>";
					}
				}
				else {
					echo "<script>alert('You do not have the right to delete !')</script>";
					echo "<script>window.open('cart.php','_self')</script>";	
				}
			}
		?>

			</form>
			<?php  
			if (isset($_POST['pay'])) {				
				$sql6= "select*from cart where UserID=$userID";	
				$result6=$connect->query($sql6);
				$check = mysqli_num_rows($result6);	
				if ($check > 0) {
					while ($cart6 = $result6->fetch_object()) {
						$post_num='number-'.$cart6->CartID;
						$number=$_POST[$post_num];
						$CartPro=$cart6->ProductID;
						$CartUser=$cart6->UserID;
						date_default_timezone_set('Asia/Ho_Chi_Minh');
						$day =date('Y/m/d H:i:s');
						$sql7 = "insert into pay values('','$number','$day', $CartUser, $CartPro)";
						$connect->query($sql7);
						$sql9 = "update product set ProductBought=ProductBought+$number where ProductID=$CartPro";
						$connect->query($sql9);
						$CartID=$cart6->CartID;
						$sql8 = "delete from cart where CartID= $CartID";
						$connect->query($sql8);
					}
					echo "<script>alert('Order successfull!')</script>";
					echo "<script>window.open('cart.php','_self')</script>";	
				}
			}
			?>
			
		</div>
		<div class="row">
			<div class="col pay-list">
				<a href="#">Order history of this establishment</a>	
			</div>			
		</div>							
	</div>	
</div>


</body>
</html>