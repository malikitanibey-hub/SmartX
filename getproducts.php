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

echo "<p><strong>Price:</strong> " . htmlspecialchars($row['price']) . "$</p>";

echo "<p><strong>Description:</strong><br>" . html_entity_decode($row['description']) . "</p>";
                               
        echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Image'>";

        // BUTTON GROUP (side-by-side)
        echo "<div class='button-group'>
                <form action='admin.php' method='GET'>
                    <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                    <button class='delete-btn' type='submit'>Delete</button>
                </form>

                <form action='update.php' method='GET'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button class='update-btn' type='submit'>Update</button>
                </form>
              </div>";

        echo "</div>";
    }
} else {
    echo "<p>No products found.</p>";
}
?>
