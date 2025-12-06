<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
include "connect.php";

function respond($success, $message = "", $extra = []) {
    echo json_encode(array_merge(["success"=>$success,"message"=>$message], $extra));
    exit;
}

// Check login
if (!isset($_SESSION['email'])) {
    respond(false, "Not logged in");
}
$email = $_SESSION['email'];

// Read input
$raw = file_get_contents("php://input");
if (!$raw) respond(false, "No input received");

$data = json_decode($raw, true);
if ($data === null) respond(false, "Invalid JSON");

$cart = $data['cart'] ?? null;
$total = $data['total'] ?? null;

if (!is_array($cart) || empty($cart) || $total === null) {
    respond(false, "Invalid cart or total");
}

// Get user ID
$stmtUser = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmtUser->bind_param("s", $email);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();
if (!$user) respond(false, "User not found");
$user_id = intval($user['id']);

// Start transaction
$conn->begin_transaction();

try {
    // Insert cart
    $stmtCart = $conn->prepare("INSERT INTO cart (user_id, email, total) VALUES (?, ?, ?)");
    $stmtCart->bind_param("isd", $user_id, $email, $total);
    if (!$stmtCart->execute()) throw new Exception("Cart insert failed: ".$stmtCart->error);

    $cart_id = $stmtCart->insert_id;
    $stmtCart->close();

    // Insert items
    $stmtItem = $conn->prepare("INSERT INTO cart_items (cart_id, product_id, name, quantity, price) VALUES (?, ?, ?, ?, ?)");
    if (!$stmtItem) throw new Exception("Prepare failed: ".$conn->error);

    foreach ($cart as $item) {
        $pid = intval($item['id']);
        $name = $item['name'];
        $qty = intval($item['quantity']);
        $price = floatval($item['price']);

        if ($pid <= 0 || $qty <= 0 || $price <= 0) continue; // skip invalid

        $stmtItem->bind_param("iisid", $cart_id, $pid, $name, $qty, $price);
        if (!$stmtItem->execute()) throw new Exception("Item insert failed for product_id {$pid}: ".$stmtItem->error);
    }

    $stmtItem->close();
    $conn->commit();
    respond(true, "Cart and items saved successfully!");
} catch (Exception $e) {
    $conn->rollback();
    respond(false, "Transaction failed: ".$e->getMessage());
}
?>
