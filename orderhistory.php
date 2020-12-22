<?php
    include ('navbar.php');
    // Must be logged in to access this page
    if(!isset($_SESSION["loggedin"])){
        header("location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Order History</title>
        <link rel="stylesheet" href="template.css">
        <link rel="stylesheet" href="orderhistory.css">
        <link rel ="icon" type="image/png" href="images/favicon.png" />
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <h1>Order History</h1>
                </div>
            </div>
        </div>

        <div class="history">
            <?php
                try {
                    // Order history display
                    $conn = new PDO("mysql:host=localhost;dbname=chromerce", 'root', '');
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // Prepared statement to fetch the order history for the user
                    $stmt = $conn->prepare("SELECT oh.id, oh.quantity, oh.purchasedate, oh.productid, p.product_name, p.product_image FROM order_history oh" 
                        . " INNER JOIN products p ON oh.productid = p.id WHERE oh.uid = ".$_SESSION['id']." ORDER BY oh.purchasedate DESC");
                    $stmt->execute();
                    $ctr = 1;
                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    // Display each product
                    foreach ($stmt->fetchAll() as $display) {
                        echo '<div class="card">';
                            echo '<div class="item'.$ctr.'">';
                                echo '<table>';
                                    echo '<tr>';
                                        echo '<td colspan="2">Date: '.$display["purchasedate"].'</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td rowspan="2"><a href="products.php?id='.$display["productid"].'"><img class="img" src="data:image/jpeg;base64,'
                                            .base64_encode($display['product_image']).'"></a></td>';
                                        echo '<td><a href="products.php?id='.$display["productid"].'">'.$display["product_name"].'</a></td>';
                                        echo '<td class="buttontd" rowspan="2">';
                                            echo '<a class="button" href="returnconfirm.php?id='.$display["id"].'">Delete</a>';
                                        echo'</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>Quantity: '.$display["quantity"].'</td>';
                                    echo '</tr>';
                                echo '</table>';
                            echo '</div>';
                        echo '</div>';
                        $ctr++;         
                    }
                  } catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    die(); // Kill the page if database is not working
                  }
                  $conn = null; // Close connection
            ?>
        </div>
    </body>
</html>

<?php
    include ('footer.php');
?>