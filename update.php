<?php
require 'connect.php';
session_start();

// Get product ID from query string
if (!isset($_GET['id'])) {
    die("No product ID specified.");
}
$id = intval($_GET['id']);

// Fetch product info
$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    die("Product not found.");
}
$product = mysqli_fetch_assoc($result);

$message = "";

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $category_id = intval($_POST['category']);

     $valid = true; // ✅ Flag to control update

    // Handle image upload
    $imagePath = $product['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $message = "<p style='color:red; text-align:center;'> ❌Invalid image type. Only JPG and PNG are allowed.</p>";
            $valid = false; // ❌ Stop update
        } else {
            $imageNewName = uniqid('', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imagePath = "Images/" . $imageNewName;
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        }
    }

    // Update product
    if ($valid) {
    $updateSql = "UPDATE products 
                  SET name='$name', price='$price', description='$description', image='$imagePath', category_id='$category_id'
                  WHERE id=$id";
    if (mysqli_query($conn, $updateSql)) {
  $message = "<p style='color:green; text-align:center;'>Product updated successfully✅</p>";       
        $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
        $product = mysqli_fetch_assoc($result);
    } else {
            $message = "<p style='color:red; text-align:center;'>Error updating product: " . mysqli_error($conn) . "</p>";
    }
   }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <title>Update Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4ff;
            background-image: url(Images/a7adf41edf32a903205261917fb7d1e6.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ceb02aff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        .btn-submit {
            background-color: rgb(25, 41, 218);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: rgb(200, 57, 157);
        }
        .message {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Update Product</h2>
    <div class="message">
        <?php echo $message; ?>
    </div>

    <form action="update.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label>Product Price:</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>

        <label>Product Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

        <label>Category:</label>
        <select name="category" required>
            <?php
            $catResult = mysqli_query($conn, "SELECT * FROM categories");
            while ($cat = mysqli_fetch_assoc($catResult)) {
                $selected = $product['category_id'] == $cat['id'] ? 'selected' : '';
                echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
            }
            ?>
        </select>

        <label>Current Image:</label><br>
        <img src="<?php echo htmlspecialchars($product['image']); ?>" width="100"><br><br>

        <label>Upload New Image (optional):</label>
        <input type="file" name="image" accept="image/*">

        <button class="btn-submit" type="submit">Update</button>
        <a class="btn-submit" href="admin.php" style="text-decoration:none;">Back to Admin</a>
    </form>
</div>
</body>
</html>
