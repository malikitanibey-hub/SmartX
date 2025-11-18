<?php
session_start();
include 'connect.php';

$host = 'localhost';
$dbname = 'login';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // SIGN UP
    if (isset($_POST['signUp'])) {

        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $passcode = $_POST['passcode'];

        // Check if email exists
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

        // Insert user
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
        $pass = md5($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['fname'] = $user['firstName'];
            $_SESSION['lname'] = $user['lastName'];
            $_SESSION['email'] = $email;
            header("Location: home.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid username or password!";
            $_SESSION['active_form'] = "signin";
            header("Location: index.php");
            exit;
        }
    }
}
?>
