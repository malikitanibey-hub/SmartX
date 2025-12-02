<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['admin']) || !isset($_SESSION['tab_token'])) {
    header("Location: admin_login.php");
    exit;
}

$error = "";
$success = "";

/* ------------ ADD USER ------------ */
if (isset($_POST['add_user'])) {
    $firstName  = trim($_POST['firstName']);
    $lastName   = trim($_POST['lastName']);
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    $passcode   = trim($_POST['passcode']);

    if ($firstName == "" || $lastName == "" || $email == "" || $password == "" || $passcode == "") {
        $error = "All fields are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password, passcode) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $passcode);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: manage_users.php?success=add");
            exit();
        } else {
            $error = "Error adding user: " . $stmt->error;
            $stmt->close();
        }
    }
}

/* ------------ UPDATE USER ------------ */
if (isset($_POST['update_user'])) {
    $id         = intval($_POST['id']);
    $firstName  = trim($_POST['firstName']);
    $lastName   = trim($_POST['lastName']);
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);
    $passcode   = trim($_POST['passcode']);

    if ($firstName == "" || $lastName == "" || $email == "" || $password == "" || $passcode == "") {
        $error = "All fields are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET firstName=?, lastName=?, email=?, password=?, passcode=? WHERE id=?");
        $stmt->bind_param("sssssi", $firstName, $lastName, $email, $hashedPassword, $passcode, $id);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: manage_users.php?success=update");
            exit();
        } else {
            $error = "Error updating user: " . $stmt->error;
            $stmt->close();
        }
    }
}

/* ------------ DELETE USER ------------ */
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    if (mysqli_query($conn, "DELETE FROM users WHERE id = $id")) {
        header("Location: manage_users.php?success=delete");
        exit();
    } else {
        $error = "Error deleting user: " . mysqli_error($conn);
    }
}

$result = mysqli_query($conn, "SELECT * FROM users");

// Get Contact Messages
$msgQuery = "SELECT * FROM contact_messages ORDER BY id ASC";
$msgResult = mysqli_query($conn, $msgQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">

    <head>
        <meta charset="UTF-8">
        <title>Manage Users</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>

    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef1f7;
            margin: 0;
            padding: 0;
        }

        h1,
        h2 {
            color: #0A3D62;
        }

        h2 {
            margin-top: 20px;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 10px 0;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .navbar-left .logo {
            width: 120px;
            height: auto;
        }

        .navbar-center .page-title {
            font-size: 28px;
            font-weight: bold;
            color: #0A3D62;
            text-align: center;
            margin: 0;
            flex-grow: 1;
        }

        .navbar-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }

        .navbar-right .back-btn {
            padding: 6px 12px;
            background-color: #0b57d0;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }

        .navbar-right .back-btn:hover {
            background-color: #094c9e;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .navbar-left,
            .navbar-center,
            .navbar-right {
                justify-content: center;
            }

            .navbar-left .logo {
                width: 100px;
            }
        }

        table {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            border-collapse: collapse;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        table th,
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background: #0b57d0;
            color: white;
        }

        button,
        a.btn-delete {
            padding: 7px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
        }

        button {
            background-color: #0b57d0;
        }

        button:hover {
            background-color: #094c9e;
        }

        a.btn-delete {
            background-color: #e60023;
        }

        a.btn-delete:hover {
            background-color: #b0001a;
        }

        form {
            width: 400px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            text-align: center;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        form button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .popup-bg {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup {
            background: #fff;
            padding: 30px 20px;
            width: 90%;
            max-width: 450px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .popup h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #0A3D62;
        }

        .popup input {
            width: 100%;
            padding: 10px 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .popup button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background: #0b57d0;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .popup button:hover {
            background: #094c9e;
        }

        .popup .close-btn {
            position: absolute;
            top: 30px;
            right: 40px;
            background: #e60023;
            color: #fff;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 3px;
            font-weight: bold;
            text-align: center;
            line-height: 25px;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
            transition: 0.3s;
        }

        .popup .close-btn:hover {
            background: #b0001a;
        }

        .btn-edit,
        .btn-delete {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: #fff;
            font-size: 14px;
        }

        .btn-edit {
            background-color: #0b57d0;
        }

        .btn-edit:hover {
            background-color: #094c9e;
        }

        .btn-delete {
            background-color: #e60023;
            text-decoration: none;
        }

        .btn-delete:hover {
            background-color: #b0001a;
        }

        .btn-edit i,
        .btn-delete i {
            font-size: 16px;
        }


.tab-container {
    width: 90%;
    margin: 20px auto;
}

.tab-buttons {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.tab-buttons button {
    padding: 10px 20px;
    border: none;
    background: #333;
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

.tab-buttons button.active {
    background: #ff2b4f;
}

.tab-content {
    display: none;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}



th, td {
    padding: 12px;
    border: 1px solid #ddd;
}

th {
    background: #333;
    color: white;
}

    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-left">
            <img class="logo" src="Images/SmartX-logo-removebg-preview.png" alt="Logo">
        </div>
        <div class="navbar-center">
            <h1 class="page-title">Manage Users</h1>
        </div>
        
        <div class="navbar-right">
            <a class="back-btn" href="admin.php">⬅ Admin Product</a>
            <a class="back-btn" href="manage_categories.php">⬅ Admin Category</a>
        </div>
    </div>

    <?php
    if ($success) echo "<p class='success'>$success</p>";
    if ($error) echo "<p class='error'>$error</p>";
    if (isset($_GET['success'])) {
        if ($_GET['success'] == "add") echo "<p class='success'>User added successfully.</p>";
        if ($_GET['success'] == "update") echo "<p class='success'>User updated successfully.</p>";
        if ($_GET['success'] == "delete") echo "<p class='success'>User deleted successfully.</p>";
    }
    ?>

    <form method="POST">
        <h2>Add New User</h2>
        <input type="text" name="firstName" placeholder="First Name" required>
        <input type="text" name="lastName" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="password" placeholder="Password" required>
        <input type="text" name="passcode" placeholder="Passcode" required>
        <button type="submit" name="add_user">Add User</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Passcode</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['firstName'] ?></td>
                <td><?= $row['lastName'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>********</td>
                <td><?= $row['passcode'] ?></td>
                <td>
                    <button class="btn-edit" onclick="openEdit(
                           '<?= $row['id'] ?>',
                           '<?= $row['firstName'] ?>',
                           '<?= $row['lastName'] ?>',
                           '<?= $row['email'] ?>',
                           '',
                           '<?= $row['passcode'] ?>'
                           )"><i class="fa-solid fa-pen"></i></button>

                    <a class="btn-delete" href="manage_users.php?delete_id=<?= $row['id'] ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>

                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="popup-bg" id="popup">
        <div class="popup">
            <button class="close-btn" type="button" onclick="closeEdit()">×</button>
            <h3>Edit User</h3>
            <form method="POST">
                <input type="hidden" name="id" id="edit-id">
                <input type="text" id="edit-firstName" name="firstName" placeholder="First Name" required>
                <input type="text" id="edit-lastName" name="lastName" placeholder="Last Name" required>
                <input type="email" id="edit-email" name="email" placeholder="Email" required>
                <input type="text" id="edit-password" name="password" placeholder="Enter new password" required>
                <input type="text" id="edit-passcode" name="passcode" placeholder="Passcode" required>
                <button type="submit" name="update_user">Update User</button>
            </form>
        </div>
    </div>

    <!-- CONTACT MESSAGES -->
    <h2 style="text-align:center; margin-top:40px;">Contact Messages</h2>


    <table>
        <tr>
            <th>ID</th>
            <th>Sender Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date Sent</th>
        </tr>

        <?php
        if ($msgResult && mysqli_num_rows($msgResult) > 0) {
            while ($msg = mysqli_fetch_assoc($msgResult)) {
                echo "<tr>";
                echo "<td>{$msg['id']}</td>";
                echo "<td>" . htmlspecialchars($msg['name']) . "</td>";
                echo "<td>{$msg['email']}</td>";
                echo "<td>" . htmlspecialchars($msg['message']) . "</td>";
                echo "<td>{$msg['created_at']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No messages found</td></tr>";
        }
        ?>
    </table>


    <script>
        function openEdit(id, firstName, lastName, email, password, passcode) {
            document.getElementById("edit-id").value = id;
            document.getElementById("edit-firstName").value = firstName;
            document.getElementById("edit-lastName").value = lastName;
            document.getElementById("edit-email").value = email;
            document.getElementById("edit-password").value = "";
            document.getElementById("edit-passcode").value = passcode;
            document.getElementById("popup").style.display = "flex";
        }

        function closeEdit() {
            document.getElementById("popup").style.display = "none";
        }
    </script>

</body>

</html>