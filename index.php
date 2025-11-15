<?php
session_start();

// Receive messages from register.php
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
$success = isset($_SESSION['success']) ? $_SESSION['success'] : "";
$activeForm = isset($_SESSION['active_form']) ? $_SESSION['active_form'] : "signin";

// Clear message after showing once
unset($_SESSION['error']);
unset($_SESSION['success']);
unset($_SESSION['active_form']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- SignUp -->
    <div class="signup-cont" id="signup" style="display: <?php echo ($activeForm == "signup") ? "block" : "none"; ?>;">

        <h1 class="form-title">Register</h1>

        <form method="post" action="register.php">
            <?php if (!empty($error)) { ?>
                <p class="error-msg"><?php echo $error; ?></p>
            <?php } ?>

            <?php if (!empty($success)) { ?>
                <p class="success-msg"><?php echo $success; ?></p>
            <?php } ?>

            <div class="input-group">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="fName" placeholder="First Name" required>
            </div>
            <div class="input-group">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="lName" placeholder="Last Name" required>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>

        <p class="or">OR</p>

        <div class="icon">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>

        <div class="links">
            <p>Already Have Account ?</p>
            <button id="signInButton">Sign In</button>
        </div>
    </div>

    <!-- SignIn -->
    <div class="signup-cont" id="signIn" style="display: <?php echo ($activeForm == "signin") ? "block" : "none"; ?>;">
        <h1 class="form-title">Sign In</h1>

        <form method="post" action="register.php">
            <?php if (!empty($error)) { ?>
                <p class="error-msg"><?php echo $error; ?></p>
            <?php } ?>

            <?php if (!empty($success)) { ?>
                <p class="success-msg"><?php echo $success; ?></p>
            <?php } ?>

            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <p class="recover">
                <a href="recover.php">Recover Password</a>
            </p>

            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>

        <p class="or">OR</p>

        <div class="icon">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>

        <div class="links">
            <p>Don't Have Account Yet ?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>