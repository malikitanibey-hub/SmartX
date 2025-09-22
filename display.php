<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartX - Display</title>
</head>

<style>
    .form-container {
    max-width: 1000px;  /* Increased to accommodate the table */
    margin: 40px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.display {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: #fff;
}

.thh {
    background-color: #f4f4f4;
    padding: 12px;
    text-align: center;
    border: 1px solid #ccc;
    color: #333;
    font-weight: bold;
}

.tdd {
    padding: 10px;
    text-align: center;
    border: 1px solid #ccc;
    color: #333;
}

.display img {
    width: 50px;
    height: 50px;
    border-radius: 4px;
    object-fit: cover;
}

/* Style for both Delete and Update buttons */
.href {
    display: inline-block;
    padding: 8px 16px;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 4px;
    font-size: 14px;
    transition: background-color 0.3s;
    cursor: pointer;
}

/* Delete button */
.href[href*="admin.php"] {
    background-color: #d32f2f;
}

.href[href*="admin.php"]:hover {
    background-color: #b71c1c;
}

/* Update button */
.href[href*="update.php"] {
    background-color: rgb(25, 41, 218);
}

.href[href*="update.php"]:hover {
    background-color: rgb(200, 57, 157);
}

/* Category dropdown styling */
select[name="categories"] {
    width: 200px;
    padding: 10px;
    margin: 20px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}
</style>

<body>

    <?php
    include "connect.php";
    $q = intval($_GET['q']);
    if ($q == -1)
        $sql = "select * from products,categories where products.category_id = categories.id order by products.name ASC";
    else
        $sql = "select * from products,categories where products.category_id=categories.id and products.category_id = " . $q;
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table border=3 width=70% class='display'>
        <tr><th>Name </th class='thh'> <th class='thh'>Description </th> 
     <th class='thh'>Price </th> <th class='thh'>Category Type </th> <th class='thh'>Image </th> <th class='thh'>Delete </th> <th class='thh'>Update </th></tr> ";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td class='tdd'>" . $row['name'] . "</td>";
                echo "<td class='tdd'>" . $row['description'] . "</td>";
                echo "<td class='tdd'>" . $row['price'] . " $</td>";
                echo "<td class='tdd'>" . $row['name'] . "</td>";
                echo "<td class='tdd'> <img src='" . $row['image'] . "' width=50 height=50></td>";
                echo "<td class='tdd'><a href='admin.php?pid=" . $row['id'] . "' class='href'>Delete</a></td>";
                echo "<td class='tdd'><a href='update.php?pid=" . $row['id'] . "' class='href'>Update</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    ?>

    

</body>
</html>