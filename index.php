<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="styles/index.css">  
</head>
<body>
<?php

include("include/header.php");
?>
<div class="container  main">
    <div class="row">
        <div class="col col-3">
            <ul id="sidebar">
                <li><a>Categories</a></li>
                <?php  
					include("include/connect.php"); 
					$search=$_GET['key'] ?? null;	
					$sql = " select * from category";
					$result = mysqli_query($connect, $sql);
					while($cat = $result->fetch_object()){						
							echo "<li";
							$Cat = $_GET['cat'] ?? 1 ;
							if (isset($search) != null){
								$Cat=0;
							}
							if($Cat == $cat->CategoryID){
								echo " class='now'";
							}
							echo "
							><a href='index.php?cat=$cat->CategoryID'>$cat->CategoryName</a></li>";
					}
				?>
			</ul>
        </div>
        <div class="col col-9">
            <div class="row justify-content-center">
  
            <?php 
				include("include/connect.php");
				$Cat = $_GET['cat'] ?? 1 ;				
                $page = $_GET['page'] ?? 1;
                $perPage = 6;
                $offSet =($page -1) * $perPage;				 						
				$sql1 = "SELECT * FROM product WHERE CategoryID=$Cat LIMIT $perPage OFFSET $offSet";
				if (isset($search) != null){
					$sql1 = "SELECT * FROM product WHERE ProductName like ('%$search%')  LIMIT $perPage OFFSET $offSet";
					echo"<div class='col col-12'><h3 style='text-align:center;'>Results</h3></div>";
				}
				

				$result1 = $connect->query($sql1);
				while ($pro =  $result1->fetch_object()){
					echo "
                <div class='col col-4'>
                    <div class='row justify-content-center'>
                        <div class='card col col-11 item'>
                            <div class='row justify-content-center'>
                                <img class='card-img-top col col-10 item-img' src='images/$pro->ProductImage' alt='Card image'>
                            </div>
                            <div class='card-body row justify-content-center'>
                                <h6 class='card-title'>$pro->ProductName</h6>
                                <div class='col col-12'>
                                    <div class='row  justify-content-center'>
                                        <p class='card-text col col-6'>Prices: <span>$pro->ProductPrices</span>$</p>
                                    </div>                            
                                </div>
                                <a href='index.php?add_cart=$pro->ProductID' class='btn btn-primary'>Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
					";

				}

			?>


                
                
            </div>
			<?php
				$sql3 = "select count(*) as Total from product WHERE CategoryID=$Cat";
				if (isset($search) != null){
					$sql3 = "select count(*) as Total from product WHERE ProductName like ('%$search%')";
				}
				$result3 = $connect->query($sql3);   
				$resultObject = $result3->fetch_object();
				$totalArticles = $resultObject->Total; 
				$totalPages = ceil($totalArticles / $perPage); 
				if ($totalArticles > 0) {
					echo "
            <div class='row d-flex justify-content-center' id='page'>
				<nav aria-label='...'>
  					<ul class='pagination'>
    					<li class='page-item"; 
								    
								
								if ($page == 1) {
									echo" disabled";									
								}								
								echo"
    					'>
      						<a class='page-link' ";       			 
							$page = $page - 1;
							
							if (isset($search) == null){
								echo" href='index.php?cat=$Cat&&page=$page' ";
							}
							else {
								echo " href='index.php?key=$search&&page=$page'  ";
							}	
							echo"
							>Previous</a></li> "; 					

                  			for ($i = 1; $i<= $totalPages; $i++){
                      			echo "
                      			<li class='page-item ";
            
									$page = $_GET['page'] ?? 1;
									if ($page == $i) {
										echo" active";
										print_r($page, $i);
									}
									if (isset($search) == null){
										echo"
										'>
										<a class='page-link' href='index.php?cat=$Cat&&page=$i'> $i </a>
										  </li>
										  ";
									}
									else {
										echo"
										'>
										<a class='page-link' href='index.php?key=$search&&page=$i'> $i </a>
										  </li>
										  ";
									}                       			

                  			}  
						echo"
    					<li class='page-item ";
							if ($page == $totalPages) {
								echo" disabled";
							}								
						echo "
    					'><a class='page-link' ";     						    
								$page = $page + 1;
								if (isset($search) == null){
									echo" href='index.php?cat=$Cat&&page=$page' ";
								}
								else {
									echo " href='index.php?key=$search&&page=$page'  ";
								}						  
      						
							echo">Next</a>						  	  
    					</li>
  					</ul>
				</nav>
					
				</div>";	
					}
					else {
						echo"
						<h4>There are currently no products </h4>";
					}
				?>				
        </div>
    </div>   
</div>
<div class="container footer">
	<div class="row">
		<h2 class="col">© 2021 Cloud Computing. Copyright by ATN</h2>
	</div>
</div>

<?php
if (isset($_GET["add_cart"])) {	
    $productID =  intval($_GET['add_cart']);
    if (isset($_SESSION['Username']) && $_SESSION['Username'] != null){
        $UserName = $_SESSION['Username'];
        $UserID = $_SESSION['UserID'];
        $sql4="select * from cart where ProductID=$productID AND UserID=$UserID";
        $result4 = mysqli_query($connect, $sql4);
        $check_pro = mysqli_num_rows($result4);
        if ($check_pro > 0) {
            echo "<script>alert('Products already in the cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
        else {
            $sql = " insert into cart values ('', $UserID, $productID) ";
            $result = mysqli_query($connect, $sql);	
            if ($result) {
                echo "<script>alert('Product added to the cart successfully!')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
            else {
                echo "<script>alert('Error')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
    }
    else {
        echo "<script>alert('You need to be logged in to perform this action')</script>";
    }
    }				
   
?>

</body>
</html>
