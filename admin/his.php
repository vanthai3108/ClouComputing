<html>
<head>
<title>ATN</title>
	<LINK REL="SHORTCUT ICON"  HREF="../images/013.svg">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/main.css">


</head>

<body>
    <?php
    include("include/header-index.php");
    ?>
    <div class="container">
  <div class="row justify-content-center main">
      <h4 style="margin: 20px 0px;">Transaction history</h4>
  </div>
  <form class="row justify-content-center main" method="GET" enctype="multipart/form-data">
  <select class="form-control col-2" name="UserID">
  <option value="0">Select Facility</option>
      <?php
      $sql = "select * from user";
      $result = mysqli_query($connect, $sql);
      while ($user = $result->fetch_object()) {
        echo"<option value='$user->UserID'>$user->FullName</option>";
      }
      ?>
      </select>
      <input class='col-1 btn btn-primary' type="submit" value='Search' name='search'>
  </form>
  <?php
     $page = $_GET['page'] ?? 1;
     $perPage = 5;
     $offSet =($page -1) * $perPage;
     if (isset($_GET['search']) && $_GET['UserID'] !== "0") {
         $userID =$_GET['UserID'];
         $sql="select*from pay, user, product where pay.UserID=user.UserID AND product.ProductID=pay.ProductID AND pay.UserID=$userID ORDER BY PayDate DESC LIMIT $perPage OFFSET $offSet";
         $sql2="select FullName from user where UserID=$userID";
         $result2=$connect->query($sql2);
         $pay2=$result2->fetch_object();
         echo"<div class='row justify-content-center main'>
         <h4 style='margin: 20px 0px;'>Transaction history of $pay2->FullName</h4>
         </div>";
     }
     else {
         $sql="select*from pay, user, product where pay.UserID=user.UserID AND product.ProductID=pay.ProductID ORDER BY PayDate DESC LIMIT $perPage OFFSET $offSet";
     }
  ?>
  <div class="row justify-content-center main">
  <div class="col-2">
  <div class='row'>
    <div class='col-9'>
      <h6>Pro image</h6>
    </div>
    </div>
    </div>
    <div class="col-2">
      <h6>Pro name</h6>
    </div>
    <div class="col-1">
      <h6>Quality</h6>     
    </div>
    <div class="col-1">
      <h6>Total prices</h6>
    </div>
    <div class="col-2">
      <h6>Facility</h6>
    </div>
    <div class="col-2">
      <h6>Time</h6>
    </div>
  </div> 
  <?php 


  $result=$connect->query($sql);
  while($pay=$result->fetch_object()) {
      $number=$pay->PayNumber;
      $prices=$pay->ProductPrices;
      $total=$prices*$number;
    echo"
    <div class='row justify-content-center main' id='pro'>
    <div class='col-2'>
    <div class='row'>
    <div class='col-9'>

      <p class='row'><img class='col col-12' src='../images/$pay->ProductImage'></p>
    </div>
    </div>
    </div>

    <div class='col-2'>
      <p>$pay->ProductName</p>     
    </div>
    <div class='col-1'>
      <p>$pay->PayNumber</p>     
    </div>
    <div class='col-1'>
      <p>$total$</p>
    </div>
    <div class='col-2'>
      <p>$pay->FullName</p>
    </div>
    <div class='col-2'>
      <p>$pay->PayDate</p>
    </div>
  </div> 
    ";
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
                if (isset($_GET['search']) && $_GET['UserID'] !== "0") {
                    echo" href='his.php?UserID=$userID&search=Search&page=$page' ";
                }
                else {
                    echo" href='his.php?page=$page' ";
                }
               
              ?> 
                >Previous</a>
              </li>             
            <?php
                if (isset($_GET['search']) && $_GET['UserID'] !== "0") {
                    $userID =$_GET['UserID'];
                    $sql3 = "select count(*) as Total from pay Where UserID=$userID";
                }
                else {
                    $sql3 = "select count(*) as Total from pay";
                }
                       
                        
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
                  if (isset($_GET['search']) && $_GET['UserID'] !== "0") {
                    echo" '><a class='page-link' href='his.php?UserID=$userID&search=Search&page=$i'> $i </a></li>";
                }
                else {
                    echo" '><a class='page-link' href='his.php?page=$i'> $i </a></li>";
                }                            
                
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
                if (isset($_GET['search']) && $_GET['UserID'] !== "0") {
                    echo" href='his.php?UserID=$userID&search=Search&page=$page' ";
                }
                else {
                    echo" href='his.php?page=$page' ";
                }            
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