<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart X</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/eed1d22c4c.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>

        <div class="header">
            <div class="header-Top">
                <div class="title">
                    <h1>Smart <span class="x">X</span></h1>
                </div>
                <div class="icons">
                    <a href="index.php"> 
                        <i class="fa-solid fa-right-to-bracket fa-beat"></i>
                    </a>
                    <a href="https://twitter.com">
                        <i class="fa-brands fa-x-twitter" style="color: black;"></i>
                    </a>
                    <a href="https://facebook.com">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    
                    <a href="https://instagram.com">
                        <i class="fa-brands fa-instagram" size="40px" style="color: #da1bc0;"></i>
                    </a>
                </div>

            </div>
            <div class="header-bottom">
                <nav class="navbar">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                
                    </ul>
                </nav>
            </div>
        </div>
</header>

<main>
    <div class="cart-container">
        <header>
            <h1 style="color: yellowgreen;"> Earphones Page</h1>
            <div class="shopping">
                <i class="fa-sharp fa-solid fa-cart-shopping fa-fade fa-2xl"></i>
                <span class="quantity">0</span>
            </div>
        </header>
        <div class="list"></div>
    </div>
    <div class="cart">
        <h1>Cart</h1>
        <ul class="listCard"></ul>
        <div class="checkOut">
            <div class="total">0</div>
            <div class="closeShopping">Close</div>
            <button class="buyButton">BUY</button>
        </div>
    </div>

<div class="gallary">
  <?php
    include "connect.php";
    $sql = "SELECT products.id, 
               products.name AS product_name, 
               products.image, 
               products.description, 
               products.price, 
               categories.name AS category_name
        FROM products
        JOIN categories ON products.category_id = categories.id
        WHERE products.category_id = 3";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='cont'  data-product-id='" . $row['id'] . "'>";
                echo "<h3> " . $row['product_name'] . " </h3>";
                echo "<img src='" . $row['image'] . "'>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<h6>" . $row['price'] . " $</h6>";
                echo "<button class='buy-1'>Add To Cart</button>";
                echo "</div>";
            }
        }
    }
     ?>
 </div> 


</div>   
</main>

<footer>
    <p>Copyright 2024 &copy; <b>SmartX Lebanon</b></p>
   </footer>

   <script src="addtoCart.js"></script>
</body>
</html>