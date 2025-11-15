<?php
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
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart X</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/eed1d22c4c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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


    <div class="container">
        <div class="wrapper">

            <img src="Images/BK6A2819-1.jpg">
            <img src="Images/iPhone.webp">
            <img src="Images/headphone.webp">
            <img src="Images/laptops.webp">
            <img src="Images/Ipads/ipadsimage.jpg">
            <img src="Images/SmartWatch/images.jpeg">

        </div>
    </div>



    <script src="addtoCart.js"></script>
    <script src="script.js"></script>
</body>

</html>