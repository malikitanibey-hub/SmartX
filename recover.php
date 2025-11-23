<?php
session_start();
include 'connect.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $passcode = $_POST['passcode'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND passcode=?");
    $stmt->bind_param("ss", $email, $passcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['recover_email'] = $email;
        header("Location: change_password.php");
        exit;
    } else {
        $_SESSION['recover_error'] = "Email or secret code not found!";
        header("Location: recover.php");
        exit;
    }
}

if (isset($_SESSION['recover_error'])) {
    $error = $_SESSION['recover_error'];
    unset($_SESSION['recover_error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <title>Recover Password</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="signup-cont" style="display:block;">
        <div class="title">
            <img src="Images/SmartX-logo-removebg-preview.png" class="site-logo" alt="SmartX Logo">
        </div>
        <h1 class="form-title">Recover Password</h1>

        <?php if ($error) echo "<p class='error-msg'>$error</p>"; ?>

        <form method="post" action="">
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-key"></i>
                <input type="text" name="passcode" placeholder="Enter your secret code" required>
            </div>

            <input type="submit" class="btn" value="Recover Password">
        </form>
    </div>
</body>

</html>