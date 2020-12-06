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