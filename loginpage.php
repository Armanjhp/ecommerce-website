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
    $username_error = "";
    $password_error = "";

    //ALREADY LOGGED IN
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: about.php");
        exit();
    }

    //LOG IN
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty(trim($_POST["username"]))) {
            $username_error = "Please enter your username";
            echo '<script language="javascript">';
            echo 'alert("Pleaser enter your username")';
            echo '</script>';
        }

        else {
            $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST["password"]))) {
            $password_error = "Pleaser enter your password";
            echo '<script language="javascript">';
            echo 'alert("Pleaser enter your password")';
            echo '</script>';
        }

        else {
            $password = trim($_POST["password"]);
        }

        if(empty($username_error) && empty($password_error)) {
            $sql_query = "SELECT id, username, password, FROM chromerce.users WHERE username = ?";

            if($stmt = mysqli_prepare($db, $sql_query)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $username;
                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($password, $hashed_password)) {
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                header("Location: about.php");
                            }

                            else {
                                $password_error = "Password invalid";
                                echo '<script language="javascript">';
                                echo 'alert("Password invalid")';
                                echo '</script>';
                            }
                        }
                    }

                    else {
                        $username_error = "No account has been found with that username";
                        echo '<script language="javascript">';
                        echo 'alert("No account has been found with that username")';
                        echo '</script>';
                    }
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
    <?php 
        include("navbar.php");
    ?>
    <!---------- login ---------->
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <hr id="indicator">
                        </div>

                        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="text" id="username" name="username" placeholder="Username">
                            <input type="password" id="password" name="password" placeholder="Password">
                            <button type="submit" class="btn">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!---------- footer ---------->
    <?php 
        include("footer.php");
    ?>
</body>