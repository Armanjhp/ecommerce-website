<?php
    session_start();
    $loginname = "";
    $loginpassword = "";
    $loginname_error = "";
    $loginpassword_error = "";

    //ALREADY LOGGED IN
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: index.php");
        exit;
    }

    //LOG IN
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty(trim($_POST["loginname"]))) {
            $username_error = "Please enter your username";
            echo '<script language="javascript">';
            echo 'alert("Pleaser enter your username")';
            echo '</script>';
        }

        else {
            $loginname = trim($_POST["loginname"]);
        }

        if(empty(trim($_POST["loginpassword"]))) {
            $loginpassword_error = "Pleaser enter your password";
            echo '<script language="javascript">';
            echo 'alert("Pleaser enter your password")';
            echo '</script>';
        }

        else {
            $loginpassword = trim($_POST["loginpassword"]);
        }

        if(empty($loginname_error) && empty($password_error)) {
            $sql_query = "SELECT id, username, password, FROM chromerce.users WHERE username = ?";

            if($stmt = mysqli_prepare($db, $sql_query)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                $param_username = $loginname;
                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $id, $loginname, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($loginpassword, $hashed_password)) {
                                session_start();
                                $_SESSION[$loggedin] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["loginname"] = $loginname;

                                header("Location: index.php");
                            }

                            else {
                                $loginpassword_error = "Password invalid";
                                echo '<script language="javascript">';
                                echo 'alert("Password invalid")';
                                echo '</script>';
                            }
                        }
                    }

                    else {
                        $loginname_error = "No account has been found with that username";
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