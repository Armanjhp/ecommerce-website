<?php
    include ('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Cart</title>
        <script src="Cart.js" type="text/javascript"></script>
        <link rel="stylesheet" href="Cart.css"/>
        <link rel="stylesheet" href="template.css">
        <link rel ="icon" type="image/png" href="template-images/favicon.png" />
    </head>

    <body>

        <div>
          <h1>Place Your Order</h1>
        </div>

        <div class="tips warp">
          <ui>
            <li>
              <input type="checkbox" name="fav" id="all" onclick="checkTest1(this),checkTest2()"/>Slect All</li>
            <li>Product</li>
            <li>Unit Price</li>
            <li>Quantity</li>
            <li>Total Price</li>
            <li>Action</li>
          </ui>
        </div>

        <div class="info warp">
            
              <ul>
                <li class="info_1"><input type="checkbox" name="fav" onclick="checkTest2()" /> </li>
                <li class="info_2"> <img src="images/xsx.png" height="90px" width="80px"/> </li>
                <li class="info_3"><a>Xbox Series X</a></li>
                <li class="info_4"><a>1 TB</a> </li>
                <li class="info_5">499.00</li>
                <li class="info_6">
                  <button onclick="checkTest3(this,1),checkTest2()" >-</button>
                  <input type="text" name="" id="" value="1" />
                  <button class="bot" onclick="checkTest3(this,2),checkTest2()" >+</button>
                  
                </li>
                <li class="info_7">$499.00</li>
                <li class="delete">
                  <a href="javascript:void(0)" onclick="checkTest4(this),checkTest2()" >Delete</a><br />
                </li>
              </ul>
            
        </div>
          
        <div class="info warp">
          <ul>
            <li class="info_1"><input type="checkbox" name="fav" onclick="checkTest2()" /> </li>
            <li class="info_2"> <img src="images/xss.png" height="90px" width="80px"/> </li>
            <li class="info_3"><a>Xbox Series S</a></li>
            <li class="info_4"><a>512 GB</a> </li>
            <li class="info_5">299.00</li>
            <li class="info_6">
              <button onclick="checkTest3(this,1),checkTest2()">-</button>
              <input type="text" name="" id="" value="1" />
              <button class="bot" onclick="checkTest3(this,2),checkTest2()">+</button> 
            </li>
            <li class="info_7">$299.00</li>
            <li class="delete">
              <a href="javascript:void(0)" onclick="checkTest4(this),checkTest2()" >Delete</a><br />
            </li>
          </ul>
        </div>
          
        <div class="info warp">
          <ul>
            <li class="info_1"><input type="checkbox" name="fav" onclick="checkTest2()" /> </li>
            <li class="info_2"> <img src="images/ps5.png" height="90px" width="80px"/> </li>
            <li class="info_3"><a>PlayStation 5</a></li>
            <li class="info_4"><a>1 TB</a> </li>
            <li class="info_5">499.00</li>
            <li class="info_6">
              <button onclick="checkTest3(this,1),checkTest2()">-</button>
              <input type="text" name="" id="" value="1" />
              <button class="bot" onclick="checkTest3(this,2),checkTest2()">+</button> 
            </li>
            <li class="info_7">$499.00</li>
            <li class="delete">
              <a href="javascript:void(0)" onclick="checkTest4(this),checkTest2()" >Delete</a><br />
            </li>
          </ul>
        </div>

        <div class="balance warp">
          <ul class="balance_ul1">
            <li><input type="checkbox" name="fav" onclick="checkTest1(this),checkTest2()" />Select All</li>
          </ul>
          <ul class="balance_ul2">
            <li>Total of <span id="snum">0</span> products</li>
            <li>Total Price: <span id="total">$0</span></li>
            <li class="butt">Check out</li>
          </ul>
        </div>
    </body>
</html>

<?php
    include ('footer.php');
?>