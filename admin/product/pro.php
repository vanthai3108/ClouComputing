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
  <div class="row justify-content-center">
      <h4 style="margin: 10px 0px;">List of products</h4>
  </div>
    <div class="row justify-content-center">
      <a href="pro-edit.php" style="margin-bottom: 20px;">Add New</a>
  </div>
  <div class="row justify-content-center main">
    <div class="col-2">
      <h6>Product image</h6>
    </div>
    <div class="col-3">
      <h6>Product name</h6>     
    </div>
    <div class="col-2">
      <h6>Category</h6>
    </div>

    <div class="col-2">
      <h6>Product prices</h6>
    </div>
    <div class="col-1">
      <h6>Bought</h6>
    </div>
    <div class="col-2">
      <h6>Action</h6>
    </div>
  </div> 
  <?php 
   $page = $_GET['page'] ?? 1;
    $perPage = 3;
    $offSet =($page -1) * $perPage;    
  $sql= "select*from product, category where product.CategoryID = category.CategoryID LIMIT $perPage OFFSET $offSet ";
  $result=$connect->query($sql);
  while($pro=$result->fetch_object()) {
    echo"
    <div class='row justify-content-center main' id='pro'>
    <div class='col-2'>
      <p class='row'><img class='col col-12' src='../../images/$pro->ProductImage'></p>
    </div>
    <div class='col-3'>
      <p>$pro->ProductName</p>     
    </div>
    <div class='col-2'>
      <p>$pro->CategoryName</p>
    </div>
    <div class='col-2'>
      <p>$pro->ProductPrices$</p>
    </div>
    <div class='col-1'>
      <p>$pro->ProductBought</p>
    </div>
    <div class='col-1'>
      <p><a href='pro-edit.php?pro-edit=$pro->ProductID'><i class='fas fa-edit'></i></a></p>
    </div>
    <div class='col-1'>
      <p><a href='pro.php?delete-pro=$pro->ProductID'><i  style='color: red' class='fas fa-trash-alt'></i></a></p>
    </div>
  </div> 
    ";
  }
  if (isset($_GET['delete-pro'])) {
    $proID = $_GET['delete-pro'];
    $sql="delete from product where ProductID=$proID";
    $result =$connect->query($sql);
    if ($result) {
          echo "<script>alert('Product has been deleted successfull!')</script>";
          echo "<script>window.open('pro.php','_self')</script>";
        }
        else {
          echo "<script>alert('Error')</script>";
          echo "<script>window.open('pro.php','_self')</script>";

        }
  }
  ?>
<div class="row d-flex justify-content-center" id="page">
        <nav aria-label="...">
            <ul class="pagination">
              <li class="page-item 
                <?php
                      
                if ($page == 1) {
                  echo" disabled";                  
                }               
              ?>
              ">
                  <a class="page-link" 
                  <?php            
                $page = $page - 1;
                echo" href='pro.php?page=$page' ";
              ?> 
                >Previous</a>
              </li>             
            <?php
                        $sql3 = "select count(*) as Total from product";
                        $result3 = $connect->query($sql3);   
                        $resultObject = $result3->fetch_object();
                        $totalArticles = $resultObject->Total;     
                      $totalPages = ceil($totalArticles / $perPage); 
                        for ($i = 1; $i<= $totalPages; $i++){
                            echo "
                            <li class='page-item ";
            
                  $page = $_GET['page'] ?? 1;
                  if ($page == $i) {
                    echo" active";
                    print_r($page, $i);
                  }                             
                echo"
                '>
                <a class='page-link' href='pro.php?page=$i'> $i </a>
                            </li>
                            ";
                        }  
                  ?>
              <li class="page-item 
              <?php   
              if ($page == $totalPages) {
                echo" disabled";
              }               
              ?>
              ">
                  <a class="page-link" 
                  <?php                     
                $page = $page + 1;
                echo" href='pro.php?page=$page' ";             
                  ?> 
                  >Next</a>
              </li>
            </ul>
        </nav>
          
        </div>        
</div>
</div>
</body>
</html>