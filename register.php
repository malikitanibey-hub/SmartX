<?php
include 'connect.php';
session_start();

$host = 'localhost';
$dbname = 'login';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                     //SignUp
    if (isset($_POST['signUp'])) {
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']); 

        $checkEmail = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($checkEmail);
        if ($result->num_rows > 0) {
            echo "<script>alert('Email Address Already Exists!');</script>";
        }
        else{
        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $pass);

        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
       }
    }
                     //SignIn
    if (isset($_POST['signIn'])) {
        $email = $_POST['email'];
        $pass = md5($_POST['password']); 

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['email'] = $user['email'];
            header("Location: home.php");
        } else {
            echo "<script>alert('Invalid username or password!');</script>";
        }
        $stmt->close();
    }
}

?>

