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
    // SignUp
    if (isset($_POST['signUp'])) {
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']); 

        try {
            // Turn on MySQLi exception mode
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            // Check if email already exists
            $checkEmail = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($checkEmail);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>alert('Email Address Already Exists!');</script>";
            } 
            else {
                // Insert new user
                $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $pass);
                $stmt->execute();
                echo "<script> alert('Registration successful!');  </script>";
                header("Location: index.php");
                exit;
            }

            $stmt->close();
        } 
        catch (mysqli_sql_exception $e) {
            // Detect duplicate error from database
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                echo "<script>
                    alert('Duplicate email or username detected. Please choose another.');
                </script>";
            } 
            else {
                echo "<script>
                    alert('Database Error: Something went wrong, please try again.');
                </script>";
            }
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

