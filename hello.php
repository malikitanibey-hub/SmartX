<!DOCTYPE html>
<?php 
include "config.php";

$pnameErr = $descriptionErr = $priceErr = $optionErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST["pname"])){
        $pnameErr = "Name is required";
    }
    else{
        $pname = test_input($_POST["pname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$pname)) {
            $pnameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["description"])) {
        $descriptionErr = "* Description is required.";
    } else {
        $description = test_input($_POST["description"]);
    }

    if(empty($_POST["price"])){
        $priceErr = "Price is required";
    }
    else{
        $price = test_input($_POST["price"]);
        if (!is_numeric($price)) {
            $priceErr = "Only numbers allowed";
      }
    }
    if($pnameErr == "" && $descriptionErr == "" && $priceErr == "" ){
        $sql = "insert into products values(Null, '$pname', '$description', $price)";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        echo '<script type="text/javascript">
         alert("New flight is added successfully")
          </script>';
    }
    
}

function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="admin-container">
        <h2>Product Management</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" class="admin-form">
            <label for="pname">Product Name</label>
            <input type="text" id="pname" name="pname" placeholder="Enter product name" required><br><br>
            
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter product description" required></textarea><br><br>
            
            <label for="price">Price ($)</label>
            <input type="number" id="price" name="price" placeholder="Enter product price" required><br><br>
          
            <button type="submit" id = "addnew">Add Product</button>

            <span style="color: #FF0000;">  </span>
        
        </form>
       
</body>
</html>