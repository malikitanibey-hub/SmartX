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
        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(35px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-Top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            background: #ffffff;
            border-bottom: 1px solid #e6e6e6;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header-Top .title {
            flex: 0;
        }

        .header-Top .icons {
            display: flex;
            align-items: center;
            gap: 18px;
            justify-content: flex-end;
            flex: 1;
        }

        .header-Top .icons span {
            margin-right: 10px;
            font-size: 16px;
            color: #333;
        }

        .header-Top .icons i {
            font-size: 22px;
            transition: 0.3s ease;
        }

        .header-Top .icons i:hover {
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .header-Top {
                flex-direction: column;
                gap: 10px;
                padding: 15px;
            }

            .header-Top .icons {
                justify-content: center !important;
                flex: unset;
            }
        }

        .navbar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 17px;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 8px;
            transition: 0.3s ease;
        }

        .navbar ul li a:hover,
        .navbar ul li a.active {
            background: #ff2b4f;
        }

        .h-bottom {
            text-align: center;
            font-family: Georgia, serif;
            color: #333;
            margin: 55px 0;
            animation: fadeUp 1s ease forwards;
        }

        .wallpaper img {
            width: 100%;
            max-height: 350px;
            object-fit: cover;
            border-radius: 12px;
            animation: fadeUp 1.2s ease forwards;
        }

        .section-box {
            width: 85%;
            margin: 0 auto 70px auto;
            padding: 40px;
            background: linear-gradient(135deg, #ffffff, #f2f6f9);
            border-radius: 20px;
            box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.12);
            display: flex;
            align-items: center;
            gap: 40px;
            animation: fadeUp 1.1s ease forwards;
            transition: 0.35s ease;
        }

        .section-box:hover {
            transform: translateY(-6px);
            box-shadow: 0px 12px 26px rgba(0, 0, 0, 0.22);
        }

        .section-image {
            flex: 1;
            border-radius: 15px;
            overflow: hidden;
            max-width: 420px;
        }

        .section-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .section-text {
            flex: 2;
        }

        .section-text h4 {
            font-size: 28px;
            color: #243447;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-text h4 i {
            color: #ff2b4f;
            font-size: 26px;
        }

        .section-text strong {
            font-size: 20px;
            color: #314e36;
            font-family: "Lucida Sans", sans-serif;
        }

        .section-text p {
            font-family: Arial, sans-serif;
            color: #485449;
            margin-top: 12px;
            line-height: 1.7;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .header-Top {
                flex-direction: column;
                gap: 10px;
                padding: 20px;
            }

            .navbar ul {
                gap: 20px;
            }

            .section-box {
                flex-direction: column;
                text-align: center;
            }

            .section-image {
                max-width: 100%;
            }

            .header-Top span {
                margin-right: 0 !important;
            }
        }
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