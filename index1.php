<?php
$page = $_GET['page'] ?? 'home';

// whitelist pages to avoid loading unknown files
$allowed_pages = ['home', 'products', 'contact', 'aboutus']; // add 'about' here

if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// include the requested page
include $page . '.php';
?>
