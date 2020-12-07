<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chromerce | Login or Register</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="template.css">
</head>
<body>
<?php
    require_once "database.php";
    $username = "";
    $password = "";
    $confirm_password = "";
    $username_error = "";
    $password_error = "";
    $confirm_password_error = "";

    //REGISTER
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //Username validation
        if(empty(trim($_POST["username"]))) {
            $username_error = "Please enter a username";
            echo '<script language="javascript">';
            echo 'alert("Please enter a username")';
            echo '</script>';
        }

        else {
            $sql_query = "SELECT id FROM users WHERE username = ?";

            if($stmt = mysqli_prepare($db,$sql_query)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = trim($_POST["username"]);

                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        $username_error = "This username is already taken";
                        echo '<script language="javascript">';
                        echo 'alert("This username is already taken")';
                        echo '</script>';
                    }
    
                    else {
                        $username = trim($_POST["username"]);
                    }
                }
                mysqli_stmt_close($stmt);
            }
        }

        if(empty(trim($_POST["password"]))) {
            $password_error = "Please enter a password";
        }

        elseif(strlen(trim($_POST["password"])) < 8) {
            $password_error = "Password must be at least 8 characters long";
            echo '<script language="javascript">';
            echo 'alert("Password must be at least 8 characters long")';
            echo '</script>';
        }

        else {
            $password = trim($_POST["password"]);
        }

        if(empty(trim($_POST["confirm_password"]))) {
            $confirm_password_error = "Confirm your password";
        }

        else {
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_error) || ($password != $confirm_password)) {
                $confirm_password = "Passowrds must match";
                echo '<script language="javascript">';
                echo 'alert("Passwords must match")';
                echo '</script>';
            }
        }

        if(empty($username_error) && empty($password_error) && empty($confirm_password_error)) {
            $sql_query = "INSERT INTO chromerce.users (username, password) VALUES (?, ?)";

            if ($stmt = mysqli_prepare($db, $sql_query)) {
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_passowrd);
                $param_username = $username;
                $param_passowrd = password_hash($password, PASSWORD_DEFAULT);

                if(mysqli_stmt_execute($stmt)) {
                    header("Location: index.php");
                }

                else {
                    echo "ERROR: POST error";
                }

                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($db);
    }
?>
    <!---------- navbar ----------->
    <div class="navbar-container">
        <nav>
            <a href="index.html" class="logo"><img src="login-images/logo.png" alt="Chromerce logo" height="250" width="250"></a>
            <input type="checkbox" id="toggle-navbar" value="2">
            <label for="toggle-navbar" class="hamburger">
                <img src="login-images/hamburger.png" alt="hamburger icon">
            </label>
            <div class="menu">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
                <a href="#">Account</a>
                <a href="#">Product</a>
                <a href="#"><img class="cart" src="login-images/cart.png" alt="Cart image" height="30" width="30" /></a>
            </div>
        </nav>
    </div>
    <!---------- login ---------->
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="indicator">
                        </div>

                        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["login.php"]); ?>" method="post">
                            <input type="text" id="loginname" name="loginname" placeholder="Username">
                            <input type="password" id="loginpassword" name="loginpassword" placeholder="Password">
                            <button type="submit" class="btn">Login</button>
                        </form>

                        <form id="registerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="<?php echo (!empty($username_error)) ? 'has-error' : ''; ?>">
                                <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>">
                            </div>
                            <div class="passwordinfo <?php echo (!empty($password_error)) ? 'has-error' : ''; ?>">
                                <input type="password" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                                <div class="info">&#x1F6C8;
                                    <span class="infotext">Password must be 8 characters long</span>
                                </div>
                            </div>
                            <div class="<?php echo (!empty($confirm_password_error)) ? 'has-error' : ''; ?>">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>">
                            </div>
                            <button type="submit" class="btn">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!---------- footer ---------->

	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="footer-col-1">
					<h3>Download Our App</h3>
					<p>Download App for Android and ios devices</p>
					<div class="app-logo">
						<a href="https://play.google.com/">
							<img src="about-images/play-store.png" alt="Google Play Store logo">
						</a>
						<a href="https://www.apple.com/shop">
							<img src="about-images/app-store.png" alt="Apple Store Logo">
						</a>
					</div>
				</div>
				<div class="footer-col-2">
					<h3>Useful links</h3>
					<ul>
						<li>Coupons</li>
						<li>Return Policy</li>
						<li>Join Affiliate</li>
					</ul>
				</div>
				<div class="footer-col-3">
					<h3>Follow us</h3>
					<ul>
						<li><a href="https://www.facebook.com/">Facebook</a></li>
						<li><a href="https://twitter.com/">Twitter</a></li>
						<li><a href="https://instagram.com/">Instagram</a></li>
					</ul>
				</div>
			</div>
			<hr>
			<p class="copyright">Copyright 2020 - Chromerce </p>
		</div>
	</div>

    <!---------- JS Account ---------->
    <script>
        var loginForm = document.getElementById("loginForm");
        var registerForm = document.getElementById("registerForm");
        var indicator = document.getElementById("indicator");

        function register() {
            registerForm.style.transform = "translateX(0px)";
            loginForm.style.transform = "translateX(0px)";
            indicator.style.transform = "translateX(60px)";
        }

        function login() {
            registerForm.style.transform = "translateX(300px)";
            loginForm.style.transform = "translateX(300px)";
            indicator.style.transform = "translateX(-60px)";
        }
    </script>
</body>