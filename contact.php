<?php
include "connect.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}
$fname = isset($_SESSION['fname']) ? $_SESSION['fname'] : "";
$lname = isset($_SESSION['lname']) ? $_SESSION['lname'] : "";

$error = "";
$success = "";

if (isset($_POST['submit_contact'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['comment']);

    $insert = "INSERT INTO contact_messages (name, email, phone, message) 
               VALUES ('$name', '$email', '$phone', '$message')";

    if (mysqli_query($conn, $insert)) {
        $_SESSION['success'] = "✅ Your message has been sent successfully!";
    } else {
        $_SESSION['error'] = "❌ Error: Could not send your message.";
    }

    header("Location: contact.php");
    exit;
}

$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

unset($_SESSION['success']);
unset($_SESSION['error']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <title>Smart X | Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/eed1d22c4c.js" crossorigin="anonymous"></script>
</head>

<body class="contact">
    <header>
        <div class="header">
            <div class="header-Top">
                <div class="title">
                    <img src="Images/SmartX-logo-removebg-preview-crop.png" alt="SmartX Logo" style="height:70px; width:auto;">
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
                        <li><a href="contact.php" class="active">Contact Us</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <section class="contact-section">
            <div class="contact-container">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6625.72905957735!2d35.525417!3d33.867382!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f176fa75f5113%3A0xf2669a46f5084a8d!2sPC%20and%20Parts%20%7C%20Lebanon!5e0!3m2!1sen!2sus!4v1721565810795!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <form class="contact-form" method="POST" action="">
                    <h2>Contact Us</h2>

                    <?php if (!empty($success)): ?>
                        <div class="form-message success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="form-message error"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Your Phone"
                            pattern="[0-9]{8,10}" title="Enter a valid 8-10 digit phone number" required>
                    </div>

                    <div class="form-group">
                        <label for="comment">Message</label>
                        <textarea id="comment" name="comment" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" name="submit_contact">Send Message</button>
                </form>

                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <p>Email: <a href="mailto:SmartX@gmail.com">SmartX@gmail.com</a></p>
                    <p>Direct Line: 03-585-543</p>
                    <p>Corporate Line: 01-685-422</p>
                    <p>Address: Furn El Chebback, Beirut, Lebanon</p>
                    <p>Hours:</p>
                    <ul>
                        <li>Mon-Fri: 8:00 AM - 6:00 PM</li>
                        <li>Saturday: 8:00 AM - 1:00 PM (Excluding Holidays)</li>
                    </ul>
                    <p>If our phone line is busy, please call back, email us, or fill the form above.</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>Copyright 2024 &copy; <b>SmartX Lebanon</b></p>
    </footer>
</body>

</html>