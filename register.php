<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // SIGN UP
    if (isset($_POST['signUp'])) {

        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $passcode = $_POST['passcode'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Email Address Already Exists!";
            $_SESSION['active_form'] = "signup";
            header("Location: index.php");
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, passcode) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $pass, $passcode);
        $stmt->execute();

        $_SESSION['success'] = "Registration successful! You can now sign in.";
        header("Location: index.php");
        exit;
    }

    // SIGN IN
    if (isset($_POST['signIn'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['fname'] = $user['firstName'];
                $_SESSION['lname'] = $user['lastName'];
                $_SESSION['email'] = $user['email'];

                header("Location: home.php");
                exit;
            }
        }
        $_SESSION['error'] = "Invalid email or password!";
        $_SESSION['active_form'] = "signin";
        header("Location: index.php");
        exit;
    }
}
