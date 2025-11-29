<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require 'connect.php';
session_start();

if (!isset($_SESSION['admin']) || !isset($_SESSION['tab_token'])) {
    header("Location: admin_login.php");
    exit;
}
$error = "";
$success = "";

/* ---------------- Soft Delete ----------------*/
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $sql = "UPDATE categories SET is_hidden = 1 WHERE id = $delete_id";
    if (mysqli_query($conn, $sql)) {
        $success = "Category removed from page successfully ✔️";
    } else {
        $error = " Error removing category ❌";
    }
}

if (isset($_POST['toggle_id'])) {
    $toggle_id = intval($_POST['toggle_id']);

    $result = $conn->query("SELECT is_hidden FROM categories WHERE id = $toggle_id");
    if ($result && $row = $result->fetch_assoc()) {
        $new_status = $row['is_hidden'] == 0 ? 1 : 0;

        $sql = "UPDATE categories SET is_hidden = $new_status WHERE id = $toggle_id";
        if (mysqli_query($conn, $sql)) {
            $success = $new_status ? "Category hidden ✔️" : "Category restored ✔️";
        } else {
            $error = "Error updating category status ❌";
        }
    } else {
        $error = "Category not found ❌";
    }
    header("Location: manage_categories.php");
    exit;
}




/* ---------- ADD CATEGORY ---------- */
if (isset($_POST['add_name'])) {
    $name = trim($_POST['add_name']);
    $description = trim($_POST['add_description']);

    if (empty($name) || empty($description)) {
        $error = "Name and description cannot be empty!";
    } else {
        if (isset($_FILES['add_image']) && $_FILES['add_image']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($_FILES['add_image']['type'], $allowedTypes)) {
                $error = "Invalid image type! Only JPEG/PNG/JPG allowed.";
            } else {
                $imageName = uniqid('', true) . '.' . pathinfo($_FILES['add_image']['name'], PATHINFO_EXTENSION);
                $imagePath = "Images/Categories/$imageName";

                if (!is_dir("Images/Categories")) mkdir("Images/Categories", 0777, true);

                if (!move_uploaded_file($_FILES['add_image']['tmp_name'], $imagePath)) {
                    $error = "Error uploading image.";
                }
            }
        } else {
            $error = "Please upload an image!";
        }

        if (empty($error)) {
            $stmt = $conn->prepare("INSERT INTO categories (name, description, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $description, $imagePath);
            try {
                if ($stmt->execute()) {
                    $msg = urlencode("Category added ✔️");
                    header("Location: manage_categories.php?success=$msg");
                    exit;
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) {
                    $error = "❌ This category name is already taken!";
                } else {
                    $error = "Database error: " . $e->getMessage();
                }
            }
        }
    }
}


/* ---------- UPDATE CATEGORY ---------- */
if (isset($_POST['update_id'])) {
    $id = intval($_POST['update_id']);
    $name = trim($_POST['update_name']);
    $description = trim($_POST['update_description']);

    if (empty($name) || empty($description)) {
        $error = "Name and description cannot be empty!";
    } else {
        $imagePath = null;
        if (isset($_FILES['update_image']) && $_FILES['update_image']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($_FILES['update_image']['type'], $allowedTypes)) {
                $error = "Invalid image type! Only JPEG/PNG/JPG allowed.";
            } else {
                $imageName = uniqid('', true) . '.' . pathinfo($_FILES['update_image']['name'], PATHINFO_EXTENSION);
                $imagePath = "Images/Categories/$imageName";

                if (!is_dir("Images/Categories")) mkdir("Images/Categories", 0777, true);

                if (!move_uploaded_file($_FILES['update_image']['tmp_name'], $imagePath)) {
                    $error = "Error uploading image.";
                }
            }
        }

        if (empty($error)) {
            if ($imagePath) {
                $stmt = $conn->prepare("UPDATE categories SET name=?, description=?, image=? WHERE id=?");
                $stmt->bind_param("sssi", $name, $description, $imagePath, $id);
            } else {
                $stmt = $conn->prepare("UPDATE categories SET name=?, description=? WHERE id=?");
                $stmt->bind_param("ssi", $name, $description, $id);
            }

            if ($stmt->execute()) $success = "Category updated ✔️";
            else $error = "Error updating category!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Manage Categories</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-image: url(Images/a7adf41edf32a903205261917fb7d1e6.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        h3 {
            text-align: center;
        }

        input,
        button,
        textarea {
            width: 100%;
            padding: 9px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            background: #0b57d0;
            color: white;
            cursor: pointer;
        }

        .btn:hover {
            background: #0949b2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }



        .update-btn {
            background: #00c853;
            color: #fff;
            border: none;
            padding: 8px;
            cursor: pointer;
        }

        .logo-box {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-box img {
            width: 150px;
            cursor: pointer;
        }

        .toggle-btn {
            background: transparent;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: #ff1744;
            margin-top: 190px;
            margin-left: 10px;
        }

        .toggle-btn:hover {
            color: #d50000;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo-box"><img src="Images/SmartX-logo-removebg-preview.png" alt="Logo"></div>

        <div style="display:flex; gap:10px; margin-bottom:20px;">
            <a href="admin.php" style="flex:1;text-align:center;background:#0b57d0;padding:10px;color:white;border-radius:6px;text-decoration:none;font-weight:bold;">← Back to Products</a>
            <a href="logout.php" style="flex:1;text-align:center;background:#00c853;padding:10px;color:white;border-radius:6px;text-decoration:none;font-weight:bold;">Home Page</a>
        </div>

        <?php
        if (isset($_GET['success'])) {
            echo "<p style='color:green'>" . htmlspecialchars($_GET['success']) . "</p>";
        }
        if ($error) echo "<p style='color:red'>$error</p>";
        ?>


        <h3>Add Category</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="add_name" placeholder="Category Name" required>
            <textarea name="add_description" placeholder="Category Description" required></textarea>
            <input type="file" name="add_image" accept="image/*" required>
            <button class="btn">Add Category</button>
        </form>

        <hr>

        <h3>Category List</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Update</th>
                <th>Hide</th>
            </tr>
            <?php
            $categories = $conn->query("SELECT * FROM categories ORDER BY id ASC");
            while ($row = $categories->fetch_assoc()) {
                echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['description']}</td>
                <td><img src='{$row['image']}' style='width:80px;height:auto;'></td>
                <td>
                    <form method='POST' enctype='multipart/form-data'>
                        <input type='hidden' name='update_id' value='{$row['id']}'>
                        <input type='text' name='update_name' placeholder='New Name' required>
                        <textarea name='update_description' placeholder='New Description' required></textarea>
                        <input type='file' name='update_image' accept='image/*'>
                        <button class='update-btn'>Update</button>
                    </form>
                </td>
                <td>

                    <form method='POST'>
    <input type='hidden' name='toggle_id' value='{$row['id']}'>
    <button class='toggle-btn'>
        " . ($row['is_hidden']
                    ? "<i class='fa-solid fa-eye'></i>"
                    : "<i class='fa-solid fa-eye-slash'></i>"
                ) . "
    </button>
</form>

                </td>
            </tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>