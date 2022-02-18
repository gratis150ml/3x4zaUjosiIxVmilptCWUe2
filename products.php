<?php
include "connect.php";
include "header.php";
global $conn;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
echo '<h4 style="padding: 10px;">All products</h4>';
$r = $conn->prepare('SELECT * FROM products');
$r->execute();
$all = $r->fetchAll();
$c = $r->rowCount();
if ($c>0) {
    foreach ($all as $i) {
        echo '<div style="padding: 10px;"><a href="product.php?id='.$i['id'].'" class="product">
        <img src="images/'.$i['img'].'" width="300" height="300" alt="'.$i['name'].'"><br>
        <span>
        Price: €'.$i['price'].'
        </span>
    </a><br><br></div>';
    }
} else {
    echo '<p style="padding: 10px;">Empty...</p>';
}
?>
