<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chromerce | Login or Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!---------- login ---------->
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-container">
                        <div>
                            <span>Reset Password</span>
                            <hr id="forgotindicator">
                        </div>

                        <form id="forgotForm" onsubmit="return instructions()">
                            <input type="text" placeholder="Username">
                            <button type="submit" class="btn">Send New Password</button>
                            <a href="login.html">Return to login page</a>
                            <h5 id="instructions"></h5>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function instructions() {
            event.preventDefault();
            document.getElementById("instructions").innerHTML = "We have sent you an email with your new password";
        }
    </script>
</body>