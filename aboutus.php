<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}
$fname = isset($_SESSION['fname']) ? $_SESSION['fname'] : "";
$lname = isset($_SESSION['lname']) ? $_SESSION['lname'] : "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <title>Smart X</title>
    <link rel="stylesheet" href="style.css">
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
                    <span style="font-weight:bold; margin-right:20px;">
                        Welcome, <?php echo htmlspecialchars($fname . ' ' . $lname); ?>
                    </span>
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


    <div class="wallpaper">
        <img src="Images/HD-wallpaper-macbook-pro-apple-technology.jpg">
    </div><br><br>


    <div class="h-bottom">
        <h2>About SmartX Lebanon</h2>
    </div><br><br><br>

    <div class="our-mission">
        <div class="mission">
            <h4>Our Mission</h4>
        </div>
        <div class="text-mission">
            <strong>To provide Lebanon with the highest quality computer systems and parts and service at the lowest available prices.</strong><br><br>
            <p>We know which parts work together efficiently. Also, the computer systems we build are custom made to meet your specific technology needs. At SmartX, we determine the exact needs of our customers by figuring out how the customer plans to use the computer; then we provide the many available pricing options.
                We have been serving Lebanon online since 1998, and we are always planning to excel in the future.</p>
        </div>
    </div><br><br>

    <div class="our-product">
        <div class="product">
            <h4>Our Products</h4>
        </div>
        <div class="text-product">
            <strong>Most components of our systems are independent of one another.</strong><br><br>
            <p>How can a video card be upgraded if it is built into the mainboard? It can’t. If the modem in your system ceases to function, how can you replace it when it is a part of the soundcard? You’ll have to pay the cost of replacing both! Most of the components of Computer Parts systems are independent of one another, which allow you to replace or upgrade at a lower cost. Note that we do incorporate motherboards with built-in components in our offers due to market competitive reasons. Before you buy one of our systems, we’ll explain the maximum technology available for each of our systems.</p>
        </div>
    </div><br><br>

    <div class="our-vision">
        <div class="vision">
            <h4>Our Vision</h4>
        </div>
        <div class="text-vision">
            <strong>To be an active part of people progress in the IT and tech world</strong><br><br>
            <p>As online shopping becomes more popular in Lebanon we intend to grow into every household, not only to be used as a reference but to actually be an active part of peoples progress in the IT and tech world. Most of our customers are tech-savvy people and understand the structure of our website, our aim for the short future is to provide the normal end user with a better online shopping experience with easy to follow instructions and secure payment methods</p>
        </div>
    </div><br><br>


    </div><br><br>

    <footer>
        <p>Copyright 2024 &copy; <b>SmartX Lebanon</b></p>
    </footer>

    <script src="addtoCart.js"></script>
</body>

</html>