<?php
session_start();
include 'connect.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['recover_email'] = $email;
        header("Location: change_password.php"); 
        exit;
    } else {
        $error = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recover Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup-cont" style="display:block;">
        <h1 class="form-title">Recover Password</h1>

        <?php if($error) echo "<p class='error-msg'>$error</p>"; ?>

        <form method="post" action="">
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <input type="submit" class="btn" value="Recover Password">
        </form>
    </div>
</body>
</html>
