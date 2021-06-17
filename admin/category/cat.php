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
  <div class="row justify-content-center ">
      <h4 style="margin: 10px 0px;">List of categoris</h4>
  </div>
    <div class="row justify-content-center">
      <a href="cat-edit.php" style="margin-bottom: 20px;">Add New</a>
  </div>
  <div class="row justify-content-center main">
    <div class="col-3">
      <h6>Category name</h6>     
    </div>
    <div class="col-2">
      <h6>Action</h6>
    </div>
  </div> 
  <?php 
    $page = $_GET['page'] ?? 1;
    $perPage = 8;
    $offSet =($page -1) * $perPage;                    
  $sql= "select*from category  LIMIT $perPage OFFSET $offSet";
  $result=$connect->query($sql);
  while($cat=$result->fetch_object()) {
    echo"
    <div class='row justify-content-center main'>
    <div class='col-3'>
      <p>$cat->CategoryName</p>     
    </div>
    <div class='col-1'>
      <p><a href='cat-edit.php?cat-edit=$cat->CategoryID'><i class='fas fa-edit'></i></a></p>
    </div>
    <div class='col-1'>
      <p><a href='cat.php?delete-cat=$cat->CategoryID'><i  style='color: red' class='fas fa-trash-alt'></i></a></p>
    </div>
  </div> 
    ";
  }
  if (isset($_GET['delete-cat'])) {
    $genreID = $_GET['delete-cat'];
    $sql="delete from category where CategoryID=$genreID";
    $result =$connect->query($sql);
    if ($result) {
          echo "<script>alert('Category has been deleted successfull!')</script>";
          echo "<script>window.open('cat.php','_self')</script>";
        }
        else {
          echo "<script>alert('Error')</script>";
          echo "<script>window.open('cat.php','_self')</script>";

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
                echo" href='cat.php?page=$page' ";
              ?> 
                >Previous</a>
              </li>             
            <?php
                        $sql3 = "select count(*) as Total from category";
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
                <a class='page-link' href='cat.php?page=$i'> $i </a>
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
                echo" href='cat.php?page=$page' ";             
                  ?> 
                  >Next</a>
              </li>
            </ul>
        </nav>  
        </div>          
    </div>  
</body>
</html>