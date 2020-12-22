<?php
    // Empty PHP page that will automatically delete an entry from the Orders History table
    session_start();
    // Must be logged in to access this page
    if(!isset($_SESSION["loggedin"])){
        header("location: login.php");
        exit();
    }

    // Must have an order id to remove
    if(!isset($_GET['id'])) {
        header("location: orderhistory.php");
        exit();
    }

    try {
        // Products catalog display
        $conn = new PDO("mysql:host=localhost;dbname=chromerce", 'root', '');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql to delete a record
        $sql = "DELETE FROM order_history WHERE id=".$_GET['id'];

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Record deleted successfully";

        // Go back to order history page
        header("location: orderhistory.php");
        exit();
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die(); // Kill the page if database is not working
    }
    $conn = null; // Close connection
?>