<!--Navbar-->
<?php
include("navbar.php");

$servername = "localhost";
$username = "root";
$password = "";

// Add to cart work
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['code']) && isset($_SESSION["loggedin"])) {
    if (isset($_POST['wishadded'])) {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=chromerce", 'root', '');
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare('INSERT INTO wishlist (uid, productid) VALUES (?, ?)');
            $sql->execute([$_SESSION['id'], $_GET['code']]);
            echo "New record created successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die(); // Kill the page if database is not working
        }
        $conn = null; // Close connection
        header('Location: wishlist.php'); // redirect to 'wishlist' page
        exit;
    } else if (isset($_POST['quantity'])) {
        $conn = new PDO("mysql:host=$servername;dbname=chromerce", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Prepared statement to fetch the cart info needed for the session
        $stmt = $conn->prepare("SELECT product_name, price, product_image FROM products WHERE id=".$_GET['code']);
        $stmt->execute();
        $cart_array = $stmt->fetch();

        // Item array hold the DB fields
        $item_array = ['name' => $cart_array['product_name'], 
            'price' => $cart_array['price'], 
            'image' => $cart_array['product_image'],
            'quantity' => $_POST['quantity']];
        
        // If there is a cart_item session variable
        if(!empty($_SESSION["cart_item"])) {
            // Check if there's a preexisting one for the item (adds to the quantity)
			if (in_array($_GET['code'], array_keys($_SESSION["cart_item"]))) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    // If a matching id is found, add to quantity
                    if($_GET['code'] == $k) {
                        if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                        }
                        $_SESSION["cart_item"][$k]["quantity"] += $item_array["quantity"];
                    }
                }
			} else {
				$_SESSION["cart_item"][$_GET['code']] = $item_array; // Add the new item to the cart
			}
		} else {
			$_SESSION["cart_item"][$_GET['code']] = $item_array; // Add the new item to the cart
        }

        // Cart item added to session, go to cart page.
        header("Location: cart.php");
        exit;
    } else {
        header("Location: products.php");
        exit;
    }
}
?>   

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" type="text/css" href="template.css">
    <link rel="stylesheet" type="text/css" href="reviews.css">
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <title>Chromerce | Online Electronic Retailer</title>
</head>

<body>

<?php if(!isset($_GET['id'])) : ?>
<!--Listed Products-->

<!--First Row-->

    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class ="row">
            <?php
                try {
                    // Products catalog display
                    $conn = new PDO("mysql:host=$servername;dbname=chromerce", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // Prepared statement to fetch all the required information for the base products page
                    $stmt = $conn->prepare("SELECT id, product_name, price, product_image FROM products");
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    // Display each product
                    foreach ($stmt->fetchAll() as $display) {
                        echo '<div class="col-4">';
                            echo "<a href='products.php?id=".$display['id']."'>";
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($display['product_image']).'"/>';
                            echo '</a>';
                            echo '<h4>'.$display['product_name'].'</h4>';
                            echo '<p>$'.$display['price'].'</p>';
                        echo '</div>';                   
                    }
                  } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    die(); // Kill the page if database is not working
                  }
                  $conn = null; // Close connection
            ?>
        </div>
    </div>

<!---promotions-->

    <div class="promotions">
        <div class="small-container">
            <div class="row">
            <?php
                try {
                    // Promotion display
                    $conn = new PDO("mysql:host=$servername;dbname=chromerce", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // Prepared statement to fetch all the required information for the base products page
                    $stmt = $conn->prepare("SELECT id, product_name, product_description, product_image FROM products ORDER BY RAND() LIMIT 1");
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    // Display each product
                    foreach ($stmt->fetchAll() as $display) {
                        echo '<div class="col-2">';
                            echo "<a href='products.php?id=".$display['id']."'>";
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($display['product_image']).'" width="80%" class="promotions-img"/>';
                            echo '</a>';
                        echo '</div>'; 

                        echo '<div class="col-2">';
                            echo '<p style="color:black;">Promotion of the Day</p>';
                            echo '<h1>'.$display['product_name'].'</h1>';
                            echo '<h3>'.$display['product_description'].'</h3>';      
                        echo '</div>';          
                    }
                  } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    die(); // Kill the page if database is not working
                  }
                  $conn = null; // Close connection
            ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="small-container details">
        <div class="row">
            <?php
                try {
                    // Product display
                    $conn = new PDO("mysql:host=$servername;dbname=chromerce", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // Prepared statement to fetch all the required information for the base products page
                    $query = "SELECT id, product_name, product_description, price, product_image, product_image2, " .
                        "product_image3, product_image4, brand FROM products WHERE id=".$_GET['id'];
                    $stmt = $conn->prepare($query);
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $r = $stmt->fetchAll();
                    // If product not found, go to general product page
                    if(empty($r)) {
                        header("Location: products.php");
                        exit;
                    } else{
                        // Display the product info
                        foreach ($r as $display) {
                            echo '<div class="col-2">';
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($display['product_image']).'" width="100%" id="ProductImg"/>';
                                echo '<div class="small-img-row">';
                                    echo '<div class="small-img-col">';
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($display['product_image']).'" width="95%" class="small-img"/>';
                                    echo '</div>';

                                    echo '<div class="small-img-col">';
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($display['product_image2']).'" width="95%" class="small-img"/>';
                                    echo '</div>';

                                    echo '<div class="small-img-col">';
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($display['product_image3']).'" width="95%" class="small-img"/>';
                                    echo '</div>';

                                    echo '<div class="small-img-col">';
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($display['product_image4']).'" width="95%" class="small-img"/>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';

                            echo '<div class="col-2">';
                                echo '<form method="post" action="products.php?action=add&code='.$_GET['id'].'">';
                                echo '<p><a href="products.php">Home</a> / '.$display['brand'].'</p>';
                                echo '<h1>'.$display['product_name'].'</h1>';
                                echo '<h4>$'.$display['price'].'</h4>'; 
                                echo '<input type="number" name="quantity" value="1">';
                                echo '<input type="submit" name="cartadded" id="button" value="Add to Cart">';
                                echo '<input type="submit" name="wishadded" id="button" value="Add to Wishlist">';
                                echo '<h3>Product Details</h3>';
                                echo '<br/>';
                                echo '<p>'.$display['product_description'].'</p>'; 
                                echo '</form>';
                            echo '</div>';
                        }
                    }
                  } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    die(); // Kill the page if database is not working
                  }
                  $conn = null; // Close connection
            ?>
        </div>
    </div>

<!-------------js for gallery------------->

    <script>
        var ProductImg = document.getElementById("ProductImg");
        var SmallImg = document.getElementsByClassName("small-img");
            SmallImg[0].onclick = function()
            {
                ProductImg.src = SmallImg[0].src;
            }
            SmallImg[1].onclick = function()
            {
                ProductImg.src = SmallImg[1].src;
            }
            SmallImg[2].onclick = function()
            {
                ProductImg.src = SmallImg[2].src;
            }
            SmallImg[3].onclick = function()
            {
                ProductImg.src = SmallImg[3].src;
            }
    </script>

<div class="small-container">
    <h2 class="title">Suggested Products</h2>
    <div class ="row">
        <?php
            try {
                // Related products display
                $conn = new PDO("mysql:host=$servername;dbname=chromerce", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Prepared statement to fetch all the required information for the base products page
                $query = "SELECT related_product, related_product2, related_product3 FROM products WHERE id=".$_GET['id'];
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                // After executing initial query, get other queries for related products
                $arr1 = $stmt->fetch();
                $query2 = "SELECT id, product_name, price, product_image FROM products WHERE id=".$arr1['related_product'];
                $query3 = "SELECT id, product_name, price, product_image FROM products WHERE id=".$arr1['related_product2'];
                $query4 = "SELECT id, product_name, price, product_image FROM products WHERE id=".$arr1['related_product3'];
                
                $stmt2 = $conn->prepare($query2);
                $stmt2->execute();

                $stmt3 = $conn->prepare($query3);
                $stmt3->execute();

                $stmt4 = $conn->prepare($query4);
                $stmt4->execute();

                $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                $stmt3->setFetchMode(PDO::FETCH_ASSOC);
                $stmt4->setFetchMode(PDO::FETCH_ASSOC);
                
                $arr2 = $stmt2->fetch();
                $arr3 = $stmt3->fetch();
                $arr4 = $stmt4->fetch();

                echo '<div class="col-4">';
                    echo "<a href='products.php?id=".$arr2['id']."'>";
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($arr2['product_image']).'"/>';
                    echo '</a>';
                    echo '<h4>'.$arr2['product_name'].'</h4>';
                    echo '<p>$'.$arr2['price'].'</p>';
                echo '</div>';

                echo '<div class="col-4">';
                    echo "<a href='products.php?id=".$arr3['id']."'>";
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($arr3['product_image']).'"/>';
                    echo '</a>';
                    echo '<h4>'.$arr3['product_name'].'</h4>';
                    echo '<p>$'.$arr3['price'].'</p>';
                echo '</div>';

                echo '<div class="col-4">';
                    echo "<a href='products.php?id=".$arr4['id']."'>";
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($arr4['product_image']).'"/>';
                    echo '</a>';
                    echo '<h4>'.$arr4['product_name'].'</h4>';
                    echo '<p>$'.$arr4['price'].'</p>';
                echo '</div>';
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                die(); // Kill the page if database is not working
            }
            $conn = null; // Close connection
        ?>
    </div>
    <div class="content home">
        <h2 class="title">Reviews</h2>
        <p style="color:black;">Check out the reviews for the product below.</p>
        <div class="reviews"></div>
        
        <script>
            <?php
                echo 'const reviews_page_id = '.$_GET['id'].';';
            ?>
            fetch("reviews.php?page_id=" + reviews_page_id).then(response => response.text()).then(data => {
                document.querySelector(".reviews").innerHTML = data;
                document.querySelector(".reviews .write_review_btn").onclick = event => {
                    event.preventDefault();
                    document.querySelector(".reviews .write_review").style.display = 'block';
                    document.querySelector(".reviews .write_review input[name='name']").focus();
                };
                document.querySelector(".reviews .write_review form").onsubmit = event => {
                    event.preventDefault();
                    fetch("reviews.php?page_id=" + reviews_page_id, {
                        method: 'POST',
                        body: new FormData(document.querySelector(".reviews .write_review form"))
                    }).then(response => response.text()).then(data => {
                        document.querySelector(".reviews .write_review").innerHTML = data;
                    });
                };
            });
        </script>
    </div>
</div>
<?php endif; ?>
</body>
</html>

<!---------- footer ---------->
<?php
include("footer.php");
?>