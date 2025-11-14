<?php
require 'connect.php';

$q = intval($_GET['q']);

// If -1 then all categories
if ($q == -1) {
    $sql = "SELECT * FROM products";
} else {
    $sql = "SELECT * FROM products WHERE category_id = $q";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='product'>";
        echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
        echo "<p>Price: " . htmlspecialchars($row['price']) . "$</p>";
        echo "<p>Description: " . htmlspecialchars($row['description']) . "</p>";
        echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Image'>";

        // Delete Button
        echo "<form action='admin.php' method='GET' style='display:inline-block'>
                <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                <button class='btn-submit' type='submit'>Delete</button>
              </form>";

        // Update Button
        echo "<form action='update.php' method='GET' style='display:inline-block'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <button class='btn-submit' type='submit'>Update</button>
              </form>";
        echo "</div>";
    }
} else {
    echo "<p>No products found.</p>";
}
