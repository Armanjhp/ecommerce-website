    <div class="navbar-container">
        <nav>
            <a href="index.php" class="logo"><img src="images/logo.png" alt="Chromerce logo" height="250" width="250"></a>
            <input type="checkbox" id="toggle-navbar" value="2">
            <label for="toggle-navbar" class="hamburger">
                <img src="images/hamburger.png" alt="hamburger icon">
            </label>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="location.php">Location</a>
                <a href="products.php">Products</a>
                <?php
                session_start();
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                    echo '<a href="logout.php">Logout</a>';
                    echo '<a href="userprofile.php">Account</a>';
                }
                else {
                    echo '<a href="login.php">Login</a>';
                }
                ?>
                <a href="cart.php"><img class="cart" src="images/cart.png" alt="Cart image" height="30" width="30" /></a>
            </div>
        </nav>
    </div>