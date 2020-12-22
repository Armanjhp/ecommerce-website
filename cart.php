<?php
include('navbar.php');
// Must be logged in to access this page
if (!isset($_SESSION["loggedin"])) {
  header("location: login.php");
  exit();
}

if (isset($_GET['clear'])) {
  // Clear the cart
  unset($_SESSION['cart_item']);
  header('Location: products.php'); // redirect to 'products' page
  exit;
}

// Checkout work
if (isset($_POST['ordersubmit'])) {
  $userid = $_SESSION['id'];
  if(isset($_POST['fav']) && in_array('all', $_POST['fav'])) {
    try {
      $conn = new PDO("mysql:host=localhost;dbname=chromerce", 'root', '');
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Iterate through the cart session variable and add all the items to order history
      foreach ($_SESSION['cart_item'] as $cartid => $cart) {
        $newquantity = $_POST['quantity'.$cartid];
        $sql = $conn->prepare('INSERT INTO order_history (uid, productid, quantity) VALUES (?, ?, ?)');
        $sql->execute([$userid, $cartid, $newquantity]);
        echo "New record created successfully";
      }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
         // Kill the page if database is not working
    }
    unset($_SESSION['cart_item']); // Clear the cart session variable
    $conn = null; // Close connection
    header('Location: orderhistory.php'); // redirect to 'order history' page
    exit;
  } else if (isset($_POST['fav'])) {
    try {
      $conn = new PDO("mysql:host=localhost;dbname=chromerce", 'root', '');
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Iterate through checkboxes and add whichever items were picked
      foreach ($_POST['fav'] as $k => $cartid) {
        $newquantity = $_POST['quantity'.$cartid];
        $sql = $conn->prepare('INSERT INTO order_history (uid, productid, quantity) VALUES (?, ?, ?)');
        $sql->execute([$userid, $cartid, $newquantity]);
        echo "New record created successfully";
      }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
         // Kill the page if database is not working
    }
    unset($_SESSION['cart_item']); // Clear the cart session variable
    $conn = null; // Close connection
    header('Location: orderhistory.php'); // redirect to 'order history' page
    exit;
  } else {
    header('Location: cart.php'); // redirect to 'cart' page if no item selected
    exit;
  }   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cart</title>
  <script src="cart.js" type="text/javascript"></script>
  <link rel="stylesheet" href="cart.css" />
  <link rel="stylesheet" href="template.css">
  <link rel="icon" type="image/png" href="images/favicon.png" />
</head>

<body>

  <div>
    <h1>Place Your Order</h1>
  </div>

  <div class="tips warp">
    <ui>
      <li>
        <input type="checkbox" name="fav[]" id="all" onclick="checkTest1(this),checkTest2()" />Select All</li>
      <li>Product</li>
      <li>Unit Price</li>
      <li>Quantity</li>
      <li>Total Price</li>
      <li>Action</li>
    </ui>
  </div>
  <?php if (isset($_SESSION['cart_item'])) : ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <?php
      foreach($_SESSION['cart_item'] as $cartid => $cart) {
        $trueprice = $cart['price'] * $cart['quantity'];
        echo '<div id="info warp" class="info warp">';
          echo '<ul>';
            echo '<li class="info_1"><input type="checkbox" name="fav[]" value="'.$cartid.'" onclick="checkTest2()" /></li>';
            echo '<li class="info_2"><img src="data:image/jpeg;base64,'.base64_encode($cart['image']).'" height="90px" width="80px"/></li>';
            echo '<li class="info_3"><a>'.$cart['name'].'</a></li>';
            echo '<li class="info_4"><a>'."\t".'</a> </li>';
            echo '<li class="info_5">'.$cart['price'].'</li>';
            echo '<li class="info_6">';
              echo '<input type="button" onclick="checkTest3(this,1),checkTest2()" value="-" />';
              echo '<input type="text" name="quantity'.$cartid.'" id="" value="'.$cart['quantity'].'" />';
              echo '<input type="button" class="bot" onclick="checkTest3(this,2),checkTest2()" value="+" />';
            echo '</li>';
            echo '<li class="info_7">'.$trueprice.'</li>';
            echo '<li class="delete">';
              echo '<a href="javascript:void(0)" onclick="checkTest4(this),checkTest2()">Delete</a><br />';
            echo '</li>';
          echo '</ul>';
        echo '</div>';
      }
    ?>
    </div>
    <br />
    <div class="timer" id="notification">
      Please place your order in <span class="time" id="time">10:00</span> or your cart will be emptied!
    </div>
    <div class="balance warp">
      <ul class="balance_ul1">
        <li><input type="checkbox" name="fav[]" value="all" onclick="checkTest1(this),checkTest2()" />Select All</li>
      </ul>

      <ul class="balance_ul2">
        <!-- <li>Total of <span id="snum">0</span> products</li> -->
        <li>Total Price: <span id="total">$0</span></li>
        <li class="butt"><input type="submit" name="ordersubmit" onclick="placeorder()">Check out</li>
      </ul>
    </div>
    </form>
</body>

</html>

<?php
    include('footer.php');
?>

<?php else : ?>
  <div class="balance warp">
    <ul class="balance_ul1">
      <li><input type="checkbox" name="fav" onclick="checkTest1(this),checkTest2()" />Select All</li>
    </ul>

    <ul class="balance_ul2">
      <li>Total of <span id="snum">0</span> products</li>
      <li>Total Price: <span id="total">$0</span></li>
      <li class="butt" input type="button" onclick="placeorder()">Check out</li>
    </ul>
  </div>

  </body>

  </html>

  <?php
    include('footer.php');
  ?>

<?php endif; ?>