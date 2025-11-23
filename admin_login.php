<?php
session_start();
include 'connect.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); 

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        $tabToken = uniqid('tab_', true);
        $_SESSION['tab_token'] = $tabToken;
        echo "<script>
            sessionStorage.setItem('tab_token', '$tabToken');
            window.location.href = 'admin.php';
        </script>";
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_style.css">
        <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <script src="https://kit.fontawesome.com/eed1d22c4c.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f4f4ff;
            background-image: url(Images/a7adf41edf32a903205261917fb7d1e6.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            margin: 0;
            font-family: "Poppins", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-cont {
            background-color: #f9f9f9af;
            border-radius: 15px;
            width: 400px;
            padding: 2.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: fadeIn 0.9s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .signup-cont .site-logo {
            width: 120px;
            margin-bottom: 1.5rem;
        }

        .form-title {
            font-size: 1.9rem;
            font-weight: 700;
            color: #333333;
            margin-bottom: 2rem;
        }

        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 14px 45px 14px 45px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            color: #333333;
            font-size: 15px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .input-group img.eyeicon {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            width: 22px;
            cursor: pointer;
        }

        .input-group i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #888888;
            font-size: 18px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            background: #ffffff;
            color: #333333;
            font-size: 15px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .input-group input::placeholder {
            color: #aaaaaa;
        }

        .input-group input:focus {
            border-color: #4f8dfd;
            box-shadow: 0 0 8px rgba(79, 141, 253, 0.3);
            outline: none;
        }

        .input-group img {
            position: absolute;
            right: 12px;
            width: 22px;
            cursor: pointer;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            color: #ffffff;
            cursor: pointer;
            background: linear-gradient(135deg, #4f8dfd, #1b3e7c);
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: linear-gradient(135deg, #3c7ce8, #152d5a);
            transform: translateY(-1px);
        }

        .error-msg {
            background: #ffe5e5;
            border: 1px solid #ff7b7b;
            color: #b70000;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <div class="signup-cont">
        <div class="title">
            <img src="Images/SmartX-logo-removebg-preview.png" class="site-logo" alt="Logo">
        </div>

        <h1 class="form-title">Admin Login</h1>

        <?php if (!empty($error)) { ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST">
            <div class="input-group">
                <i class="fa-solid fa-user-shield"></i>
                <input type="text" name="username" placeholder="Admin Username" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" class="password-input" required>
                <img src="Images/eye-close.png" class="eyeicon" onclick="togglePassword()">
            </div>

            <input type="submit" value="Login" class="btn">
        </form>
    </div>

    <script>
        function togglePassword() {
            const passInput = document.querySelector('.password-input');
            const eyeIcon = document.querySelector('.eyeicon');
            if (passInput.type === "password") {
                passInput.type = "text";
                eyeIcon.src = "Images/eye-open.png";
            } else {
                passInput.type = "password";
                eyeIcon.src = "Images/eye-close.png";
            }
        }
    </script>
</body>

</html>