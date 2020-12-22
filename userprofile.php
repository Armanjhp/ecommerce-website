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
    <title>Your Account</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="userprofile.css">
    <link rel ="icon" type="image/png" href="images/favicon.png"/>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-1">
                <h1>Hello, <?php echo $_SESSION['username']?></h1>
                <h2>Welcome to your account!</h2>
            </div>
        </div>
    </div>
    
    <div class="options"> 
        <a href="orderhistory.php">
            <div class="card1">
                    <div class="orderhistory">
                        <br>
                        <h4><b>Order History</b></h4>
                        <br>
                        <p>View or return your recent purchases</p>
                    </div>
            </div>
        </a>

        <a href="wishlist.php">
            <div class="card2">
                    <div class="wishlist">
                        <br>
                        <h4><b>Wishlist</b></h4>
                        <br>
                        <p>View your wishlist</p>
                    </div>
            </div>
        </a>
    </div>

</body>
</html>

<?php
    include ('footer.php');
?>