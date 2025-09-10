
<?php
require 'connect.php';

session_start();

$error = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                $error = "Invalid image type. Only JPEG, PNG, and JPG are allowed.";
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
                    $successMessage = "Phone added successfully.";
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
    <title>Add Phone</title>
    <link rel="stylesheet" href="style/add_room.css">
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
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        .header-top .title h1 {
            margin: 0;
        }

        .header-top .icons a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
            font-size: 18px;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
            font-weight: bold;
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-container .btn-submit {
            background-color: rgb(25, 41, 218);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container .btn-submit:hover {
            background-color: rgb(200, 57, 157);
        }
    </style>
</head>

<body>
    <header>
        <div class="header-top">
            <div class="title">
                <h1>Smart <span class="x">X</span> Admin</h1>
            </div>
            <div class="icons">
                <a href="logout.php">
                    <i class="fa-solid fa-right-from-bracket" style="color: #d32f2f;"></i> Go to Home Page
                </a>
            </div>
        </div>
    </header>
    <center>
        <div class="form-container">
            <h2>Add Phone</h2>

            <?php if (!empty($successMessage)): ?>
                <div style="color: green;">
                    <?php echo htmlspecialchars($successMessage); ?>
                </div>
            <?php elseif (!empty($error)): ?>
                <div style="color: red;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="admin.php" method="POST" enctype="multipart/form-data">
                <p>
                    <label for="phone-name">Phone Name:</label>
                    <input type="text" id="phone-name" name="phone-name" placeholder="Enter Phone Name" required>
                </p>
                <p>
                    <label for="phone-price">Phone Price:</label>
                    <input type="text" id="phone-price" name="phone-price" placeholder="Enter Phone Price" required>
                </p>
                <p>
                    <label for="phone-description">Phone Description:</label>
                    <input type="text" id="phone-description" name="phone-description" placeholder="Enter Phone Description" required>
                </p>
                <p>
                    <label for="phone-category">Phone Category:</label>
                    <select id="phone-category" name="phone-category" required>
                        <?php
                        $result = $conn->query("SELECT id, name FROM categories");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="phone-image">Phone Image:</label>
                    <input type="file" id="phone-image" name="phone-image" accept="image/*" required>
                </p>
                <div>
                    <input class="btn-submit" type="submit" value="Add Phone">
                    <input class="btn-submit" type="reset" value="Reset">
                </div>
            </form>

            <form>
                <center>
                    <select name="categories" onchange="showProduct(this.value)">
                        <option value=" ">Select Category</option>
                        <option value="-1">All Category</option>
                        <?php
                        include "connect.php";
                        $sql = "select * from categories";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                        } ?>
                    </select>
            </form><br>

            <div id="txtHint"><b>Product info will be listed here...</b></div>
    </center>
    </div>
    </center>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['id'])) {
            $sqlquerydelete = "delete from products where id=" . $_GET['id'];
            $QueryResult2 = @mysqli_query($conn, $sqlquerydelete);
        }
     }
        ?>
    </select><br><br>
    <input type="submit" value="Update">
</form>
    <script src="script.js"></script>
</body>
</html>