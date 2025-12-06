<?php
include "connect.php";
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}
$fname = isset($_SESSION['fname']) ? $_SESSION['fname'] : "";
$lname = isset($_SESSION['lname']) ? $_SESSION['lname'] : "";


$category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

$category_name = "";
if ($category_id > 0) {
    $cat_result = mysqli_query($conn, "SELECT name FROM categories WHERE id = $category_id AND is_hidden = 0");
    $cat_row = mysqli_fetch_assoc($cat_result);
    $category_name = $cat_row['name'] ?? "Category";
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'Default';
if ($category_id > 0) {
    $sql = "SELECT products.id, products.name AS product_name, products.image, products.description, products.price, categories.name AS category_name
            FROM products
            JOIN categories ON products.category_id = categories.id
            WHERE products.category_id = $category_id";

    switch ($filter) {
        case 'LowToHigh':
            $sql .= " ORDER BY products.price ASC";
            break;
        case 'HighToLow':
            $sql .= " ORDER BY products.price DESC";
            break;
        case 'AtoZ':
            $sql .= " ORDER BY products.name ASC";
            break;
        case 'ZtoA':
            $sql .= " ORDER BY products.name DESC";
            break;
        default:
            $sql .= " ORDER BY products.id ASC";
    }

    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Images/logo-removebg-preview.png">
    <title>Smart X</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <script src="https://kit.fontawesome.com/eed1d22c4c.js" crossorigin="anonymous"></script>
</head>
<style>
#toast {
  position: fixed;
  top: 20px;             /* distance from top */
  left: 50%;             /* center horizontally */
  transform: translateX(-50%) translateY(-8px);
  max-width: 400px;
  padding: 12px 20px;
  border-radius: 8px;
  color: #fff;
  font-weight: 600;
  font-size: 15px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.15);
  opacity: 0;
  pointer-events: none;
  transition: opacity 260ms ease, transform 260ms ease;
  z-index: 9999;
}

#toast.show {
  opacity: 1;
  transform: translateX(-50%) translateY(0);
}

#toast.success { background: #2fa84f; }
#toast.error   { background: #e04545; }
#toast.info    { background: #2b7bdc; }
#toast.warn    { background: #f0a500; }


 </style>
<body>


    <header>
        <div class="header">
            <div class="header-Top">
                <div class="title">
                    <img src="Images/SmartX-logo-removebg-preview-crop.png"
                        alt="SmartX Logo"
                        style="height:70px; width:auto;">
                </div>

                <div class="icons">
                    <span style="font-weight:bold; margin-right:20px;">
                        Welcome, <?php echo htmlspecialchars($fname . ' ' . $lname); ?>
                    </span>
                    <a href="index.php"><i class="fa-solid fa-right-to-bracket fa-beat"></i></a>
                    <a href="https://twitter.com"><i class="fa-brands fa-x-twitter" style="color: black;"></i></a>
                    <a href="https://facebook.com"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://instagram.com"><i class="fa-brands fa-instagram" style="color: #da1bc0;"></i></a>
                </div>
            </div>

            <div class="header-bottom">
                <nav class="navbar">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="products.php" class="active">Products</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="aboutus.php">About Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>



    <main>
        <div class="cart-container">
    <header class="product-header">
        <h1 style="color: yellowgreen;">
            <?php echo $category_id > 0 ? $category_name : "Products Page"; ?>
        </h1>
        <div class="shopping cart-icon">
            <i class="fa-sharp fa-solid fa-cart-shopping fa-fade fa-2xl"></i>
            <span class="quantity">0</span>
        </div>
    </header>

    <div class="list"></div>
</div>

<div class="cart">
    <h1>My Cart</h1>
    <ul class="listCard"></ul>
    <div id="cartMessage" style="margin-top: 10px; font-weight: bold;"></div>
    <!-- Toast container (place once, near </body>) -->
    <div id="toast" role="status" aria-live="polite" aria-atomic="true"></div>
    <div class="checkOut">
        <div class="total">0</div>
        <div class="closeShopping">Close</div>
        <button class="buyButton">BUY</button>
    </div>
</div>


        <?php if ($category_id == 0) : ?>

            <div class="products-wrapper">
                <div class="gallary">
                    <?php
                    $categories = $conn->query("SELECT * FROM categories WHERE is_hidden = 0 ORDER BY id ASC");
                    while ($row = mysqli_fetch_assoc($categories)) {
                        echo "<div class='cont product-cont'>";
                        echo "<h3>" . $row['name'] . "</h3>";
                        echo "<img src='" . $row['image'] . "'> <br>";
                        echo "<p>Enter to see all products</p>";
                        echo "<a href='products.php?category=" . $row['id'] . "'>
                  <button class='product-cont-btn'>Click Here</button></a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>

        <?php else : ?>


            <div class="products-top-controls">
                <!-- Back Button -->
                <a href="products.php" class="back-btn" title="Back to categories">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>

                <!-- Filter Dropdown -->
                <div class="filter-condition">
                    <form method="get" action="products.php">
                        <input type="hidden" name="category" value="<?php echo $category_id; ?>">
                        <select name="filter" onchange="this.form.submit()">
                            <option value="Default" <?php if ($filter == 'Default') echo 'selected'; ?>>Default</option>
                            <option value="LowToHigh" <?php if ($filter == 'LowToHigh') echo 'selected'; ?>>Price: Low to High</option>
                            <option value="HighToLow" <?php if ($filter == 'HighToLow') echo 'selected'; ?>>Price: High to Low</option>
                            <option value="AtoZ" <?php if ($filter == 'AtoZ') echo 'selected'; ?>>Name: A to Z</option>
                            <option value="ZtoA" <?php if ($filter == 'ZtoA') echo 'selected'; ?>>Name: Z to A</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="products-wrapper">
                <div class="gallary products">
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='cont product-cont' data-product-id='" . $row['id'] . "'>";
                            echo "<h3>" . $row['product_name'] . "</h3><br>";
                            echo "<img src='" . $row['image'] . "'> <br>";
                            echo "<p>" . html_entity_decode($row['description']) . "</p>";
                            echo "<h6>" . $row['price'] . "$</h6>";
                            echo "<button class='product-cont-btn'>Add To Cart</button>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No products found in this category.</p>";
                    }
                    ?>
                </div>
            </div>

        <?php endif; ?>

    </main>

    <footer>
        <p>Copyright 2024 &copy; <b>SmartX Lebanon</b></p>
    </footer>

    <script src="addtoCart.js"></script>
</body>

</html>