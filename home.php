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
                    <img src="Images/SmartX-logo-removebg-preview-crop.png"
                        alt="SmartX Logo"
                        style="height:70px; width:auto;">
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
                        <li><a href="home.php" class="active">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>


    <div class="slideshow-container">

        <div class="slide fade">
            <img src="Images/BK6A2819-1.jpg" alt="Slide 1">
        </div>

        <div class="slide fade">
            <img src="Images/iPhone.webp" alt="Slide 2">
        </div>

        <div class="slide fade">
            <img src="Images/headphone.webp" alt="Slide 3">
        </div>

        <div class="slide fade">
            <img src="Images/laptops.webp" alt="Slide 4">
        </div>

        <div class="slide fade">
            <img src="Images/Ipads/ipadsimage.jpg" alt="Slide 5">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>

    <div class="dots-container" style="text-align:center; margin-top:15px;">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
        <span class="dot" onclick="currentSlide(5)"></span>
    </div>

    <div class="home-section ">
        <h2>Welcome to Smart X</h2>
        <p>Discover the latest gadgets, electronics, and accessories at unbeatable prices.</p>

        <div class="home-cards">
            <div class="card">
                <img src="Images/iPhone.webp" alt="iPhone">
                <h3>Latest Phones</h3>
                <p>Check out the newest phones with amazing features.</p>
            </div>
            <div class="card">
                <img src="Images/Ipads/ipadsimage.jpg" alt="Laptop">
                <h3>Laptops & Tablets</h3>
                <p>High performance devices for work, study, and gaming.</p>
            </div>
            <div class="card">
                <img src="Images/headphone.webp" alt="Headphones">
                <h3>Accessories</h3>
                <p>Headphones, smartwatches, and all essential accessories.</p>
            </div>
        </div>
    </div>

<div class="home-section bordered-section">
    <h2>What is SmartX?</h2>
    <p>
        SmartX is your go-to platform in Lebanon for the latest technology, computers, accessories, and tech services. 
        We provide high-quality products, custom-built PCs, laptops, iPads, smartwatches, and headphones. 
        Our mission is to make technology simple, reliable, and accessible to everyone.
    </p>
</div>

<div class="home-section bordered-section">
    <h2>Our Ideas to Improve Your Experience</h2>
    <ul class="ideas-list">
        <li>Offer tutorials and guides for tech beginners.</li>
        <li>Provide personalized recommendations based on user preferences.</li>
        <li>Enable a community forum for tech discussion and support.</li>
        <li>Regularly update with the latest gadgets and trends.</li>
        <li>Offer seasonal discounts and exclusive deals for loyal customers.</li>
    </ul>
</div>



    <footer>
        <p>Copyright 2024 &copy; <b>SmartX Lebanon</b></p>
    </footer>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slide");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

        setInterval(function() {
            plusSlides(1);
        }, 5000);
    </script>

    <script src="addtoCart.js"></script>
    <script src="script.js"></script>
</body>

</html>