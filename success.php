<?php
include "connect.php";
include "header.php";
global $conn;
$errors = array();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['cart'])) {
    echo '<h4 style="padding: 10px;">Your Order Has Been Placed</h4><p style="padding: 10px;">Thank you for ordering with us, we will contact you by email with your order details.</p>';
    session_start();
    session_destroy();
} else {
    echo '<p style="padding: 10px;">No items on cart</p>';
}
?>