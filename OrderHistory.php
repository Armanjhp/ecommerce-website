<?php
    include ('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Order History</title>
        <link rel="stylesheet" href="template.css">
        <link rel="stylesheet" href="OrderHistory.css">
        <link rel ="icon" type="image/png" href="template-images/favicon.png" />
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
            <div class="card">
                <div class="item1">
                    <table>
                        <tr>
                            <td colspan="3">Date: 10-29-2020</td>
                        </tr>
                        <tr>
                            <td rowspan="2"><a href=""><img class="img" src="images/xsx.png" alt="XSX"></a></td>
                            <td><a href="">Xbox Series X</a></td>
                            <td class="buttontd" rowspan="2"><input class="button" type="submit" value="Return"></td>
                        </tr>
                        <tr>
                            <td>Quantity: 1</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="item2">
                    <table>
                        <tr>
                            <td colspan="2">Date: 10-29-2020</td>
                        </tr>
                        <tr>
                            <td rowspan="2"><a href=""><img class="img" src="images/xss.png" alt="XSS"></a></td>
                            <td><a href="">Xbox Series S</a></td>
                            <td class="buttontd" rowspan="2"><input class="button" type="submit" value="Return"></td>
                        </tr>
                        <tr>
                            <td>Quantity: 1</td>
                        </tr>
                    </table> 
                </div>
            </div>

            <div class="card">
                <div class="item3">
                    <table>
                        <tr>
                            <td colspan="2">Date: 10-29-2020</td>
                        </tr>
                        <tr>
                            <td rowspan="2"><a href=""><img class="img" src="images/ps5.png" alt="PS5"></a></td>
                            <td><a href="">PlayStation 5</a></td>
                            <td class="buttontd" rowspan="2"><a href="ReturnConfirm.php"><input class="button" type="submit" value="Return"></a></td>
                        </tr>
                        <tr>
                            <td>Quantity: 1</td>
                        </tr>
                    </table> 
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    include ('footer.php');
?>