<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['admin']) || !isset($_SESSION['tab_token'])) {
    header("Location: admin_login.php");
    exit;
}
$error = "";
$successMessage = "";

/* ---------- DELETE PRODUCT ---------- */
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM products WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_sql)) {
        $successMessage = "Product deleted successfully✅";
    } else {
        $error = "Error deleting product: " . mysqli_error($conn);
    }
}

/* ---------- ADD PRODUCT ---------- */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['phone-name'])) {
    $phoneName = trim($_POST['phone-name']);
    $phoneCategory = intval(trim($_POST['phone-category']));
    $phoneDescription = trim($_POST['phone-description']);
    $phonePrice = trim($_POST['phone-price']);

    if (empty($phoneName) || empty($phoneCategory) || empty($phoneDescription) || empty($phonePrice)) {
        $error = "All fields are required.";
    } else {
        if (isset($_FILES['phone-image']) && $_FILES['phone-image']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $maxSize = 3 * 1024 * 1024; // 3MB

            if (!in_array($_FILES['phone-image']['type'], $allowedTypes)) {
                $error = "❌Invalid image type. Only JPEG, PNG, and JPG are allowed";
            } elseif ($_FILES['phone-image']['size'] > $maxSize) {
                $error = "Image size exceeds the maximum limit of 3MB.";
            } else {
                $categoryFolders = [
                    1 => "Samsung",
                    2 => "iPhone",
                    3 => "Earphones",
                    4 => "Laptops",
                    5 => "iPads",
                    6 => "Smartwatch"
                ];

                $categoryFolder = $categoryFolders[$phoneCategory] ?? "Other";
                $baseFolder = "Images";
                $categoryPath = "$baseFolder/$categoryFolder";

                if (!is_dir($categoryPath)) {
                    mkdir($categoryPath, 0777, true);
                }

                $imageNewName = uniqid('', true) . '.' . pathinfo($_FILES['phone-image']['name'], PATHINFO_EXTENSION);
                $imagePath = "$categoryPath/$imageNewName";

                if (!move_uploaded_file($_FILES['phone-image']['tmp_name'], $imagePath)) {
                    $error = "Error uploading the image.";
                }
            }
        } else {
            $error = "Please upload a phone image.";
        }

        if (empty($error)) {
            $stmt = $conn->prepare("SELECT id FROM categories WHERE id = ?");
            $stmt->bind_param("i", $phoneCategory);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 0) {
                $error = "Invalid category ID.";
            } else {
                $stmt->close();
                $query = $conn->prepare("INSERT INTO products (name, price, description, image, category_id) VALUES (?, ?, ?, ?, ?)");
                $query->bind_param("ssssi", $phoneName, $phonePrice, $phoneDescription, $imagePath, $phoneCategory);

                if ($query->execute()) {
                    $successMessage = "Phone added successfully✅";
                } else {
                    $error = "Error: " . $query->error;
                }
                $query->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <title>SmartX Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url(Images/a7adf41edf32a903205261917fb7d1e6.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            color: #333;
        }

        header {
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        h1 {
            font-family: "Poppins", sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: #0A3D62;
        }

        h1 .x {
            color: #0b57d0;
        }

        .logo-box img {
            width: 100px;
            cursor: pointer;
        }

        .title h1 {
            font-size: 28px;
            margin: 0;
            color: #333;
            font-weight: 700;
            text-shadow: 1px 1px 2px #ddd;
            margin-left: 65px;
        }

        .icons a {
            font-size: 16px;
            color: #0b57d0;
            font-weight: bold;
            text-decoration: none;
            background: #dbdfe8ff;
            padding: 8px 15px;
            border-radius: 8px;
        }

        .icons a:hover {
            background: #d2e3fc;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: rgba(51, 170, 206, 0.85);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #fff;
            font-weight: 700;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            color: #fff;
            font-weight: bold;
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.25);
            color: #000;
            box-sizing: border-box;
        }

        .form-container select {
            color: #000;
            background: rgba(255, 255, 255, 0.9);
        }

        .btn-submit {
            background-color: rgb(25, 41, 218);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
        }

        .btn-submit:hover {
            background-color: rgb(200, 57, 157);
        }

        .btn-reset {
            background-color: #ff4081;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-reset:hover {
            background-color: #e6006e;
        }

        #txtHint .product {
            background: rgba(255, 255, 255, 0.85);
            padding: 15px;
            margin: 15px auto;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        #txtHint .product-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
            align-items: center;
        }

        #txtHint .product-info span {
            font-weight: bold;
        }

        #txtHint .product img {
            max-width: 150px;
            height: auto;
            border-radius: 6px;
            margin: 10px 0;
        }

        #txtHint .product .button-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            justify-content: center;
        }

        #txtHint .product button.update-btn {
            background-color: #00e676;
            color: #000;
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #txtHint .product button.update-btn:hover {
            background-color: #00c853;
        }

        #txtHint .product button.delete-btn {
            background-color: #ff1744;
            color: #fff;
            flex: 1;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #txtHint .product button.delete-btn:hover {
            background-color: #d50000;
        }

        a.manage-categories {
            display: inline-block;
            font-size: 19px;
            font-weight: 700;
            color: #0b57d0;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            background-color: #e0e7ff;
            box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            margin-top: 7px;
        }

        a.manage-categories:hover {
            background-color: #0b57d0;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-top">
            <div class="logo-box"><img src="Images/SmartX-logo-removebg-preview.png" alt="Logo"></div>
            <div class="title">

                <h1>Smart <span class="x">X</span> Admin</h1>
                <a href="manage_users.php" class="manage-categories">Manage Users</a>
                <a href="manage_categories.php" class="manage-categories">Manage Categories</a>

            </div>
            <div class="icons"><a href="logout.php">Go to Home Page</a></div>
        </div>
    </header>

    <div class="form-container">
        <h2>Add A New Device</h2>

        <?php if (!empty($successMessage)) echo "<div style='color:green'>$successMessage</div>";
        elseif (!empty($error)) echo "<div style='color:red'>$error</div>"; ?>

        <form id="addPhoneForm" action="admin.php" method="POST" enctype="multipart/form-data">
            <label>Phone Name:</label><input type="text" name="phone-name" placeholder="Enter Phone Name" required>
            <label>Phone Price:</label><input type="text" name="phone-price" placeholder="Enter Phone Price" required>
            <label>Phone Description:</label><input type="text" name="phone-description" placeholder="Enter Phone Description" required>
            <label>Phone Category:</label>
            <select name="phone-category" required>
                <option value="">Select Category</option>
                <?php
                $result = $conn->query("SELECT id,name FROM categories");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
            <label>Phone Image:</label><input type="file" name="phone-image" accept="image/*" required>

            <input class="btn-submit" type="submit" value="Add Phone">
            <input class="btn-reset" type="button" value="Reset" id="resetBtn">
        </form>

        <hr>

        <center>
            <select id="categorySelect">
                <option value="">Select Category</option>
                <option value="-1">All Category</option>
                <?php
                $sql = "SELECT * FROM categories";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>
        </center>
        <div id="txtHint"><b>Product info will be listed here...</b></div>

        <script>
            // Show products
            function showProduct(categoryId) {
                if (categoryId == "") {
                    document.getElementById("txtHint").innerHTML = "<b>Product info will be listed here...</b>";
                    return;
                }
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
                xhttp.open("GET", "getProducts.php?q=" + categoryId, true);
                xhttp.send();
            }

            document.getElementById("categorySelect").addEventListener('change', function() {
                showProduct(this.value);
            });

            // Reset button
            document.getElementById("resetBtn").addEventListener('click', function() {
                document.getElementById("addPhoneForm").reset();
                document.getElementById("categorySelect").selectedIndex = 0;
                document.getElementById("txtHint").innerHTML = "<b>Product info will be listed here...</b>";
            });
        </script>

</body>

</html>