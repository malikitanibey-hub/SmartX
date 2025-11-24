<?php
require 'connect.php';
session_start();

if (!isset($_GET['id'])) {
    die("No product ID specified.");
}
$id = intval($_GET['id']);

$sql = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    die("Product not found.");
}
$product = mysqli_fetch_assoc($result);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $category_id = intval($_POST['category']);

     $valid = true;

    $imagePath = $product['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $message = "<p style='color:red; text-align:center;'> Invalid image type. Only JPG and PNG are allowed.</p>";
            $valid = false; 
        } else {
            $imageNewName = uniqid('', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imagePath = "Images/" . $imageNewName;
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        }
    }

    if ($valid) {
    $updateSql = "UPDATE products 
                  SET name='$name', price='$price', description='$description', image='$imagePath', category_id='$category_id'
                  WHERE id=$id";
    if (mysqli_query($conn, $updateSql)) {
  $message = "<p style='color:green; text-align:center;'>Product updated successfully</p>";       
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
    font-family: "Poppins", Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: url(Images/a7adf41edf32a903205261917fb7d1e6.jpg) no-repeat center/cover fixed;
}

.header-logo {
    text-align: center;
    margin-top: 30px;
}

.header-logo img {
    width: 140px;
    border: none;
    box-shadow: none;
}

.form-container {
    max-width: 700px;
    margin: 40px auto;
    padding: 35px;
    border-radius: 20px;
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: 0 8px 35px rgba(0,0,0,0.3);
    animation: fadeIn .6s ease;
}

h2 {
    text-align: center;
    color: #fff;
    font-size: 30px;
    letter-spacing: 1px;
}

.form-container input,
.form-container textarea,
.form-container select {
    width: 100%;
    padding: 12px;
    margin-top: 6px;
    margin-bottom: 18px;
    border: none;
    border-radius: 12px;
    background: rgba(255,255,255,0.8);
    font-size: 16px;
}

.btn-submit {
    background: rgba(255, 255, 255, 0.25);
    border: 1px solid rgba(255,255,255,0.5);
    padding: 12px 28px;
    border-radius: 12px;
    cursor: pointer;
    backdrop-filter: blur(8px);
    color: #fff !important;
    transition: 0.3s;
}

.btn-submit:hover {
    background: rgba(255, 255, 255, 0.45);
}

img {
    border-radius: 8px;
    border: 1px solid #fff;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(25px); }
    to { opacity: 1; transform: translateY(0); }
}
.message {
    text-align: center;
    margin-bottom: 20px;
    font-size: 16px;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: fit-content;
    max-width: 100%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.message p[style*="color:green"] {
    background-color: #4CAF50; 
    color: #fff !important;
    border: 1px solid #3e8e41;
}


.message p[style*="color:red"] {
    background-color: #f44336;
    color: #fff !important;
    border: 1px solid #d32f2f;
}

.message p[style*="color:green"]::after {
    content: "✔";
    font-weight: bold;
}

.message p[style*="color:red"]::after {
    content: "❌";
    font-weight: bold;
}


    </style>
</head>
<body>
<div class="form-container">
    <div class="header-logo">
    <div class="logo-box"><img src="Images/SmartX-logo-removebg-preview.png" alt="Logo"></div>
</div>
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
