<?php
include "connect.php";
include "header.php";
global $conn;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
echo '<h4 style="padding: 10px;">Recently added products</h4>';
$r = $conn->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$r->execute();
$all = $r->fetchAll();
foreach ($all as $i) {
    echo '<div style="padding: 10px;"><a href="product.php?id='.$i['id'].'" class="product">
    <img src="images/'.$i['img'].'" width="300" height="300" alt="'.$i['name'].'"><br>
    <span>
    Price: €'.$i['price'].'
    </span>
</a><br><br></div>';
}
?>
