<?php
include "connect.php";
if(isset($_POST['add'])){
$pname=$_POST['name']; 
$description=$_POST['description'];
$price=$_POST['price'];
mysqli_query($con,"insert into `products` (name, 
description, price,) values ('$pname', '$description','$price')");
}
?>