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
    <title>Smart X | About Us</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/eed1d22c4c.js" crossorigin="anonymous"></script>

    <style>

    </style>
</head>

<body class="about-page">

    <header>
        <div class="header">
            <div class="header-Top">
                <div class="title">
                    <img src="Images/SmartX-logo-removebg-preview-crop.png"
                        alt="SmartX Logo"
                        style="height:70px; width:auto;">
                </div>

                <div class="icons">
                    <span style="font-weight:bold; margin-right:20px;">
                        Welcome, <?php echo htmlspecialchars($fname . ' ' . $lname); ?>
                    </span>
                    <a href="index.php"><i class="fa-solid fa-right-to-bracket fa-beat"></i></a>
                    <a href="https://twitter.com"><i class="fa-brands fa-x-twitter" style="color: black;"></i></a>
                    <a href="https://facebook.com"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://instagram.com"><i class="fa-brands fa-instagram" style="color: #da1bc0;"></i></a>
                </div>
            </div>

            <div class="header-bottom">
                <nav class="navbar">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="aboutus.php" class="active">About Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="wallpaper">
        <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8">
    </div>

    <div class="h-bottom">
        <h2>About SmartX Lebanon</h2>
    </div>

    <div class="section-box">
        <div class="section-image">
            <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df" alt="Mission Image">
        </div>
        <div class="section-text">
            <h4><i class="fa-solid fa-bullseye"></i> Our Mission</h4>
            <strong>To provide Lebanon with the highest quality computers, parts, and services at the best prices.</strong>
            <p>
                We build custom computer systems tailored to your needs. At SmartX, we understand what customers require
                by analyzing how they plan to use their device. Since 1998, we have been committed to providing reliable
                service and high-quality technology solutions for all users in Lebanon.
            </p>
        </div>
    </div>

    <div class="section-box">
        <div class="section-text">
            <h4><i class="fa-solid fa-box-open"></i> Our Products</h4>
            <strong>Independent, upgradeable components built for long-term performance.</strong>
            <p>
                Most components in our custom systems work independently. This makes upgrading or replacing parts easier
                and more cost-effective. We guide every customer through the latest technology options to ensure they
                receive a system that fits their exact needs.
            </p>
        </div>
        <div class="section-image">
            <img src="Images/products.jpg" alt="Our Products">
        </div>
    </div>

    <div class="section-box">
        <div class="section-image">
            <img src="Images/vision.jpg" alt="Our Vision">
        </div>
        <div class="section-text">
            <h4><i class="fa-solid fa-eye"></i> Our Vision</h4>
            <strong>To support technological growth in Lebanon.</strong>
            <p>
                As online shopping becomes more integrated into daily life, SmartX aims to bring the best online shopping
                experience to every household. Our goal is to create an easy-to-use platform with clear instructions,
                secure payments, and a smooth experience for beginners and tech-savvy users alike.
            </p>
        </div>
    </div>

    <footer>
        <p>Copyright 2024 &copy; <b>SmartX Lebanon</b></p>
    </footer>

</body>

</html>