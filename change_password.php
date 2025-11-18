<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['recover_email'])) {
    header("Location: recover.php");
    exit;
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPass = $_POST['new_password'];
    $confirmPass = $_POST['confirm_password'];

    if ($newPass !== $confirmPass) {
        $error = "Passwords do not match!";
    } else {
        $hashedPass = md5($newPass);
        $email = $_SESSION['recover_email'];

        $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hashedPass, $email);
        if ($stmt->execute()) {
            unset($_SESSION['recover_email']);
            $_SESSION['success'] = "Password changed successfully. Please Sign In.";
            header("Location: index.php"); 
            exit;
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/eed1d22c4c.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="signup-cont" style="display:block;">
        <div class="title">
            <img src="Images/SmartX-logo-removebg-preview.png" class="site-logo" alt="SmartX Logo">
        </div>
        <h1 class="form-title">Change Password</h1>

        <?php if($error) echo "<p class='error-msg'>$error</p>"; ?>

        <form method="post" action="">
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="new_password" placeholder="New Password" class="password-input" required>
                <img src="Images/eye-close.png" class="eye-icon">
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="password-input" required>
                <img src="Images/eye-close.png" class="eye-icon">
            </div>
            <input type="submit" class="btn" value="Change Password">
        </form>
    </div>
        <script>
        const eyeIcons = document.querySelectorAll('.eye-icon');
        eyeIcons.forEach(icon => {
            icon.addEventListener('click', () => {
                const input = icon.previousElementSibling;
                if(input.type === 'password') {
                    input.type = 'text';
                    icon.src = 'Images/eye-open.png';
                } else {
                    input.type = 'password';
                    icon.src = 'Images/eye-close.png';
                }
            });
        });
    </script>
</body>
</html>
