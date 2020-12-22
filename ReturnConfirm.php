<?php
    include ('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Confirm Return</title>
        <link rel="stylesheet" href="template.css">
        <link rel="stylesheet" href="ReturnConfirm.css">
        <link rel ="icon" type="image/png" href="template-images/favicon.png" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <h1>Confirm your return</h1>
                </div>
            </div>
        </div>

        <div class="confirm">
            <div class="card">
                <div class="information">
                    <table>
                        <tr>
                            <td colspan="2">Date: 10-29-2020</td>
                        </tr>
                        <tr>
                            <td rowspan="2"><a href=""><img class="img" src="images/ps5.png" alt="PS5"></a></td>
                            <td><a href="">PlayStation 5</a></td>
                        </tr>
                        <tr>
                            <td>Quantity: 1</td>
                        </tr>
                    </table> 
                </div>
                <br/>
                <div class="returnreason">
                    <p>Why are you returning this?
                    <select class="select">
                        <optgroup label="Reason to return">
                          <option>Bought by mistake</option>
                          <option>Better price available</option>
                          <option>Performance or quantity not adequate</option>
                          <option>No longer needed</option>
                          <option>Wrong product</option>
                        </optgroup>
                    </select>
                    </p>
                    <br>
                </div>
                <input class="button" type="submit" value="Submit" />
                <br>    
            </div>
            
        </div>
    </body>
</html>


<?php
    include ('footer.php');
?>