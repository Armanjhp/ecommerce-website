<?php 
include("navbar.php");

$product_array = [];
$banner_array = [];
try {
  $conn = new PDO("mysql:host=localhost;dbname=chromerce", 'root', '');
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, product_name, price, product_image FROM products");
  $stmt->execute();
  $product_array = $stmt->fetchAll();
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die(); // Kill the page if database is not working
}
$conn = null; // Close connection
?>

<!DOCTYPE html> 
<head>
  <title> Home </title>
  <link rel="stylesheet" href="index.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
  <link rel="stylesheet" type="text/css" href="template.css">
  <link rel="icon" type="image/png" href="images/favicon.png"/>
  <script
  src="https://code.jquery.com/jquery-3.1.1.js"
  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
  crossorigin="anonymous"></script>
<script src="index.js"> </script>
</head>
<body>
<!-- BEGIN SLIDE SHOW -->
<div class="flex">
      <div class="container">
          
            <div class="slider-outer">
              <img src="images/arrow-left.png" class="prev" alt="Prev">
              <div class="slider-inner">
                <img src="images/pic-5.jpg" class="active">
                <?php 
                  try {
                    $conn = new PDO("mysql:host=localhost;dbname=chromerce", 'root', '');
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT image FROM banner");
                    $stmt->execute();
                    $banner_array = $stmt->fetchAll();
                    //var_dump($banner_array); die();
                  } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    die(); // Kill the page if database is not working
                  }
                  $conn = null; // Close connection

                  $i = 0;
                  foreach ($banner_array as $banner)
                  {
                    if($i%3 ==0){
                      echo "<tr>";
                    }
                    
                    echo '<img src="data:images/jpeg;base64,'.base64_encode($banner['image'] ).'"/>';
                    
                    if($i%3 ==2) {
                      echo "</tr>";
                    }
                    $i++;
                  }
                ?>
              </div>
              <img src="images/arrow-right.png" class="next" alt="Next">
            </div>
      </div>
</div>


<!-- END SLIDE SHOW -->




<!-- BEGIN HERO -->

<div class="hero">
          <header class="hero-title">
            <h1>FIND THE PRODUCTS OF YOUR DREAMS!</h1>
              <h1>Happiness guranteed!</h1>
              <button><a href="products.php" style="color:white;"><h1>Shop Now!</h1></a></button>
          </header>
    </div>
<!-- END HERO-->



<!-- TRENDING NOW PRODUCTS -->

<div class="products">
       <div class="wrapper">
           <h1>Trending Now!</h1>
            <div class="row">
              <?php
                echo '<div class="col-products">';
                  $rand_index = array_rand($product_array);
                  $tmp = $product_array[$rand_index];
                  echo '<img src="data:image/jpeg;base64,'.base64_encode($tmp['product_image']).'" alt="Category Item1" >';
                  echo '<h1 class="align">'.$tmp['product_name'].'</h1>';
                  echo '<p class="align">'.$tmp['price'].'</p>';
                echo '</div>';

                echo '<div class="col-products">';
                  $rand_index = array_rand($product_array);
                  $tmp = $product_array[$rand_index];
                  echo '<img src="data:image/jpeg;base64,'.base64_encode($tmp['product_image']).'" alt="Category Item2" >';
                  echo '<h1 class="align">'.$tmp['product_name'].'</h1>';
                  echo '<p class="align">'.$tmp['price'].'</p>';
                echo '</div>';

                echo '<div class="col-products">';
                  $rand_index = array_rand($product_array);
                  $tmp = $product_array[$rand_index];
                  echo '<img src="data:image/jpeg;base64,'.base64_encode($tmp['product_image']).'" alt="Category Item3" >';
                  echo '<h1 class="align">'.$tmp['product_name'].'</h1>';
                  echo '<p class="align">'.$tmp['price'].'</p>';
                echo '</div>';
              ?>
            </div>
       </div>
    </div>

    <!-- END OF TRENDING NOW -->


    <!-- PRODUCTS ON SALE -->
    <div class="wrapper">
        <h1 class="align">Products On Sale!</h1>
        <h2 class="align">Best Value</h2>
        <div class="row">
        <?php
          $rand_index = array_rand($product_array);
          $tmp = $product_array[$rand_index];
          echo '<div class="col-sale"> <img src="data:image/jpeg;base64,'.base64_encode($tmp['product_image']).'" id="picsC" alt="'.$tmp['product_name'].'" >';
            echo '<a href="products.php?id='.$tmp['id'].'"><h3 class="align">'.$tmp['product_name'].'</h3> </a>';
          echo '</div>';

          $rand_index = array_rand($product_array);
          $tmp = $product_array[$rand_index];
          echo '<div class="col-sale"> <img src="data:image/jpeg;base64,'.base64_encode($tmp['product_image']).'" id="picsK" alt="'.$tmp['product_name'].'" >';
            echo '<a href="products.php?id='.$tmp['id'].'"><h3 class="align">'.$tmp['product_name'].'</h3> </a>';
          echo '</div>';

          $rand_index = array_rand($product_array);
          $tmp = $product_array[$rand_index];
          echo '<div class="col-sale"> <img src="data:image/jpeg;base64,'.base64_encode($tmp['product_image']).'" id="picsH" alt="'.$tmp['product_name'].'" >';
            echo '<a href="products.php?id='.$tmp['id'].'"><h3 class="align">'.$tmp['product_name'].'</h3> </a>';
          echo '</div>';

          $rand_index = array_rand($product_array);
          $tmp = $product_array[$rand_index];
          echo '<div class="col-sale"> <img src="data:image/jpeg;base64,'.base64_encode($tmp['product_image']).'" id="picsS" alt="'.$tmp['product_name'].'" >';
            echo '<a href="products.php?id='.$tmp['id'].'"><h3 class="align">'.$tmp['product_name'].'</h3> </a>';
          echo '</div>';
        ?>
      </div>      
    </div>
    <!-- END OF PRODUCTS ON SALE -->
  <?php
    include("footer.php");
    ?>
</body>
</html>


